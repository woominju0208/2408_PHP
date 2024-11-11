<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 마이그레이션 파일 생성 : php artisan make:migration 파일명
    // 마이그레이션 실행 : php artisan migrate
    // 마이그레이션 롤백(직전의 마이그레이션 작업 되돌리기) : php artisan migrate:rollback
    // 마이그레이션 롤백(모든 마이그레이션 작업 되돌리기) : php artisan migrate:reset

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Board로 model을 만들었지만 자동으로 복수형 boards로 만들어줌
        // up, down 둘다 정의해줘야 한다.(둘이 반대되는 처리)
        // heidisql없이 여기서 만들수도 있다.
        Schema::create('boards_test', function (Blueprint $table) {      // boards 테이블명 빼고 고정으로 씀 Schema ~
            $table->id('b_id');
            // $table->bigInteger('u_id', false, true);
            $table->bigInteger('u_id')->unsigned();         // 두번째가 false라면 이런식으로 사용 가능
            $table->char('bc_type', 1);
            $table->string('b_title', 50);
            $table->string('b_content', 200);
            $table->string('b_img', 100);
            // $table->timestamps();       // timestamps는 자동으로 created_at, updated_at 둘다 들어가 있다. (null값 들어갈수 있음)
            $table->timestamp('created_at')->default(DB::raw('current_timestamp'));
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp'));
            $table->timestamp('deleted_at')->nullable();
        });
        // powershell 에서 php artisan migrate를 하면 가진 모든 migrate가 실행되면서 한번도 실행안된것만 실행된다.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards_test');
    }
};
