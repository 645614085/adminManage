<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->comment("名称");
            $table->string('icon_class',64)->comment("图标");
            $table->string('url',64)->comment("地址");
            $table->integer('pid')->unsigned()->default(0);
            $table->integer('flag')->default(0);
            $table->integer('sort')->unsigned()->default(0)->comment("排序");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
