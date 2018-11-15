<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->comment('标题');
            $table->longText('content')->comment('内容');
            $table->unsignedInteger('is_show')->default(1)->comment('是否公开');
            $table->unsignedInteger('display')->nullable()->comment('访问量');
            $table->unsignedInteger('type_id')->comment('类型ID');
            $table->unsignedInteger('top')->default(0)->comment('是否置顶');
            $table->string('img')->nullable()->comment('图片');
            $table->engine='innodb';
            $table->comment='文章表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
