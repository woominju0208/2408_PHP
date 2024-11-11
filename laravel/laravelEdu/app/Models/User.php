<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // trait(트레이트) : 우리가 필요한것들을 주머니와 같이 만들어서 사용할 곳에 상속하듯이 가져다 씀 
    // SoftDeletes 트레이트 : 해당 모델에 소프트딜리트를 적용하고 싶을 때 추가(삭제된 DB빼고 가져와줌)
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;   // trait 종류

    // 테이블명 정의하는 프로퍼티 (디폴트는 모델명의 복수형)
    protected $table = 'users';

    // protected $primaryKey : PK를 지정하는 프로퍼티($primaryKey 변수명 고정)
    // primarykey를 따로 지정해주지 않으면 'id'를 pk로 인식한다.
    protected $primaryKey = 'u_id';

    // 테이블명, pk 는 따로 정의해주는게 좋다.

    // DB 컬럼명이 다를시 프로퍼티 세팅(원래 자동으로 created_at, updated_at, deleted_at이 세팅)
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
    
    // 화이트리스트 , 블랙리스트 하나만 실행시키면 된다.
    /**
    * upsert시 변경을 허용할 컬럼들을 설정하는 프로퍼티(화이트리스트)
    */
    protected $fillable = [
        'u_email'
        ,'u_password'
        ,'u_name'
        ,'created_at'
        ,'updated_at'
        ,'deleted_at'
    ];
    /**
    * upsert시 변경을 불허할 컬럼들을 설정하는 프로퍼티(블랙리스트)
    */
    // protected $guarded = [
    //     'id'
    // ];
}
