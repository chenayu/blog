<?php
namespace models;
use PDO;

class Blog extends Base
{

    public function getNew()
    {
        $stmt = self::$pdo->query("SELECT * FROM blogs WHERE is_show=1 ORDER BY id DESC LIMIT 20");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
    }
    public function search()
    {

        $where = 'user_id='.$_SESSION['id'];
        $value = [];
        
        if(isset($_GET['keyword']) && $_GET['keyword'])
        {
            $where .= " AND (title LIKE ? OR content LIKE ?)";
            $value[] = '%'.$_GET['keyword'].'%';
            $value[] = '%'.$_GET['keyword'].'%';
        }

        if(isset($_GET['start_date']) && $_GET['start_date'])
        {
            $where .= " AND created_at >= ?";
            $value[] = $_GET['start_date'];
        }

        if(isset($_GET['end_date']) && $_GET['end_date'])
        {
            $where .= " AND created_at <= ?";
            $value[] = $_GET['end_date'];
        }

        if(isset($_GET['is_show']) && ($_GET['is_show']==1 || $_GET['is_show']==='0'))
        {
            $where .= " AND is_show = ?";
            $value[] = $_GET['is_show'];
        }


        /***************** 排序 ********************/
        // 默认排序
        $odby = 'created_at';
        $odway = 'desc';

        if(isset($_GET['odby']) && $_GET['odby'] == 'display')
        {
            $odby = 'display';
        }

        if(isset($_GET['odway']) && $_GET['odway'] == 'asc')
        {
            $odway = 'asc';
        }

        /****************** 翻页 ****************/
        $perpage = 15; // 每页15
        // 接收当前页码（大于等于1的整数）， max：最参数中大的值
        $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
        // 计算开始的下标
        // 页码  下标
        // 1 --> 0
        // 2 --> 15
        // 3 --> 30
        // 4 --> 45
        $offset = ($page-1)*$perpage;

        // 制作按钮
        // 取出总的记录数
        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM blogs WHERE $where");
        $stmt->execute($value);
        $count = $stmt->fetch( PDO::FETCH_COLUMN );
        // 计算总的页数（ceil：向上取整（天花板）， floor：向下取整（地板））
        $pageCount = ceil( $count / $perpage );

        $btns = '';
        for($i=1; $i<=$pageCount; $i++)
        {
            // 先获取之前的参数
            $params = getUrlParams(['page']);

            $class = $page==$i ? 'active' : '';
            $btns .= "<a class='$class' href='?{$params}page=$i'> $i </a>";
            
        }

        /*************** 执行 sqL */
        // 预处理 SQL
        $stmt = self::$pdo->prepare("SELECT * FROM blogs WHERE $where ORDER BY $odby $odway LIMIT $offset,$perpage");
        // 执行 SQL
        $stmt->execute($value);

        // 取数据
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'btns' => $btns,
            'data' => $data,
        ];
    }


    public function content2html()
    {
        $stmt = self::$pdo->query('SELECT * FROM blogs');
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 开启缓冲区
        ob_start();

        // 生成静态页
        foreach($blogs as $v)
        {
            // 加载视图
            view('blogs.content', [
                'blog' => $v,
            ]);
            // 取出缓冲区的内容
            $str = ob_get_contents();
            // 生成静态页
            file_put_contents(ROOT.'public/contents/'.$v['id'].'.html', $str);
            // 清空缓冲区
            ob_clean();
        }
    }

    public function index2html()
    {
        // 取 前20 条记录 数据 
        $stmt = self::$pdo->query("SELECT * FROM blogs WHERE is_show=1 ORDER BY id DESC LIMIT 20");
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        
        // 开启一个缓冲区
        ob_start();

        // 加载视图文件到缓冲区
        view('index.index', [
            'blogs' => $blogs,
        ]);

        // 从缓冲区中取出页面
        $str = ob_get_contents();

        // 把页面的内容生成到一个静态页中
        file_put_contents(ROOT.'public/index.html', $str);

    }

    // 获取日志的浏览量
    // 参数：日志ID
    public function getDisplay($id)
    {
        // 使用日志ID拼出键名
        $key = "blog-{$id}";

        $redis = \libs\Redis::getInstace();

        // 判断 hash 中是否有这个键，如果有就操作内存，如果没有就从数据库中取
        // hexists：判断有没有键
        if($redis->hexists('blog_displays', $key))
        {
            // 累加 并且 返回添加完之后的值
            // hincrby ：把值加1
            $newNum = $redis->hincrby('blog_displays', $key, 1);
            return $newNum;
        }
        else
        {
            // 从数据库中取出浏览量
            $stmt = self::$pdo->prepare('SELECT display FROM blogs WHERE id=?');
            $stmt->execute([$id]);
            $display = $stmt->fetch( PDO::FETCH_COLUMN );
            $display++;
            // 保存到 redis
            // hset：保存到  Redis
            $redis->hset('blog_displays', $key, $display);
            return $display;
        }
    }


    public function displayToDb()
    {
        // 1. 先取出内存中所有的浏览量
        // 连接 Redis
        $redis = \libs\Redis::getInstace();


        $data = $redis->hgetall('blog_displays');

        // 2. 更新回数据库
        foreach($data as $k => $v)
        {
            $id = str_replace('blog-', '', $k);
            $sql = "UPDATE blogs SET display={$v} WHERE id = {$id}";
            self::$pdo->exec($sql);
        }
    }

    public function del($id)
    {
        $stmt = self::$pdo->prepare('DELETE FROM blogs WHERE id = ? AND user_id=?');
        $stmt->execute([
            $id,
            $_SESSION['id'],
        ]);
    }

    public function find($id)
    {
        $stmt = self::$pdo->prepare('SELECT * FROM blogs where id = ?');
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch();
    }

    public function update($title,$content,$is_show,$id)
    {
        $stmt = self::$pdo->prepare("UPDATE blogs SET title=?,content=?,is_show=? WHERE id =?");
        $ret = $stmt->execute([
            $title,
            $content,
            $is_show,
            $id
        ]);
    }

    public function makeHtml($id)
    {
        $blog = $this->find($id);
        ob_start();
        view('blogs.content',['blog'=>$blog]);
        $str = ob_get_clean();
        file_put_contents(ROOT.'public/contents/'.$id.'.html',$str);
    }

    public function deleteHtml($id)
    {
        @unlink(ROOT.'public/contents/'.$id.'.html');
    }
    public function content()
    {
        $id = $_GET['id'];
        $model = new Blog;
        $blog = $model->find($id);
        if($_SESSION['id'] != $blog['user_id'])
        {
            die('无权访问');

            view('blogs.content',['blog'=>$blog]);
        }
    }

}