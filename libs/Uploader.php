<?php 
namespace libs;

class Uploader
{
    private function __construct(){}
    private function __clone(){}
    private static $_obj = null;

    public static function make()
    {
        if(self::$_obj === null)
        {
            self::$_obj = new self;
        }
        return self::$_obj;
    }

    private $_root = ROOT.'public/uploads/';
    private $_ext = ['image/jpg','image/jpeg','image/png','image/gif'];
    private $_maxSize = 1024*1024*1.8;
    private $_file;
    private $_subDir;

    public function upload($name,$subdir)
    {
        $this->_file = $_FILES[$name];
        $this->_subDir = $subdir;
        if(!$this->_checkType())
        {
            die('图片类型不正确');
        }
        if(!$this->_checkSize())
        {
            die('图片尺寸不正确');
        }
        $dir = $this->_makeDir();
        $name = $this->_makeName();
        move_uploaded_file($this->_file['tmp_name'],$this->_root.$dir.$name);
        return $dir.$name;
    }
    
    private function _makeDir()
    {
        $dir = $this->_subDir.'/'.date('Ymd');
        if(!is_dir($this->_root.$dir))
            mkdir($this->_root.$dir,0777,true);
            return $dir.'/';
    }
    private function _makeName()
    {
        $name = md5(time().rand(1,9999));
        $ext = strrchr($this->_file['name'],'.');
        return $name.$ext;
    }
    private function _checkType()
    {
        return in_array($this->_file['type'],$this->_ext);
    }
    private function _checkSize()
    {
        return $this->_file['size']<$this->_maxSize;
    }
}
?>