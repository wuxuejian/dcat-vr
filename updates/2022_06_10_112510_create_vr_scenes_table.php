<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVrVideosTable extends Migration
{
    public $withinTransaction = false;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('vr_scenes')) {
            Schema::create('vr_scenes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('vr_id')->index()->comment('vr活动外键');
                $table->string('name')->index()->default('')->comment('场景标题');
                $table->string('description')->default('')->comment('描述');
                $table->string('scene_file')->default('')->comment('场景文件');
                $table->string('cover')->default('')->comment('场景封面');
                $table->string('scene_type',10)->default('video')->comment('场景类型');
                $table->integer('init_tilt')->default(20)->comment('初始tilt');
                $table->integer('init_pan')->default(180)->comment('初始pan');
                $table->integer('init_fov')->default(100)->comment('初始fov');
                $table->integer('scene_format')->default(2)->comment('场景格式');
                $table->tinyInteger('is_loop')->comment('是否循环，1，开启，2,不开启');
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
        Schema::dropIfExists('vr_scenes');
    }
}
