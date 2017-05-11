<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xcord', function (Blueprint $table) {
            $table->increments('id');
        });
        Schema::create('ycord', function (Blueprint $table) {
            $table->increments('id');
        });
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('x');
            $table->integer('y');
            $table->integer('val');
        });
        for ($i = 1; $i <= 100; $i++) {
            DB::table('xcord')->insert(['id' => $i]);
            DB::table('ycord')->insert(['id' => $i]);
        }

        $usedX = [];
        $usedY = [];
        $randomCount = 0;

        while ($randomCount < 100) {
            $tmpX = rand(1,100);
            $tmpY = rand(1,100);
            $tmpVal = rand(1,99999);
            if (array_search($tmpX, $usedX) === false && array_search($tmpY, $usedY) === false) {
                DB::table('content')->insert([
                    'x' => $tmpX,
                    'y' => $tmpY,
                    'val' => $tmpVal
                ]);
                $randomCount++;
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xCord');
        Schema::dropIfExists('yCord');
        Schema::dropIfExists('content');
    }
}
