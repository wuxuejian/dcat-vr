<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVrsTable extends Migration
{
    public $withinTransaction = false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('vrs')) {
            Schema::create('vrs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->index()->default('')->comment('VR标题');
                $table->string('description')->default('')->comment('描述');
                $table->string('link')->default('')->comment('链接');
                $table->string('cover')->default('')->comment('封面');
                $table->tinyInteger('is_gyro')->comment('是否开启陀螺仪，1，开启，不开启');
                $table->tinyInteger('full_screen')->comment('是否全屏，1，全屏，2，非全屏');
                $table->tinyInteger('status')->comment('状态，1，正常，2，下架');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vrs');
    }

}
