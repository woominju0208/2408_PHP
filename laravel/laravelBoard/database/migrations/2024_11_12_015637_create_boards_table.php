<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // boards로 모델명의 복수형으로 설정됨 바꾸고 싶으면 바꿔도 됨
        Schema::create('boards', function (Blueprint $table) {
            $table->id('b_id');
            // fk로 사용하는것들은 모든 조건이 같아야 한다. ('컬럼명', autoincre사항, unsign사항)
            $table->bigInteger('u_id', false, true);
            $table->char('bc_type', 1);
            $table->string('b_title', 50);
            $table->string('b_content', 200);
            $table->string('b_img', 100);
            $table->timestamps();       // php laravel은 자동으로 작성,수정일자를 넣어줘서 current_timestamp를 적을필요는 없음
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
};
