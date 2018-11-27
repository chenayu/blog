<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('cat_name')->comment('类型名称');
            $table->unsignedInteger('is_show')->default(1)->comment('是否公开');
            $table->engine="innodb";
            $table->comment="图片类型";

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_categories');
    }
}
