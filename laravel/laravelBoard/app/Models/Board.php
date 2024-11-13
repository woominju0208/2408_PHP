<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'b_id';

    // 화이트 리스트    화이트 적으면 블랙 적을 필요 x
    protected $fillable = [
        'u_id'
        ,'bc_type'
        ,'b_title'
        ,'b_content'
        ,'b_img'
    ];

    // utc 시간 > 한국시간으로 바꾸기 (이 형태 그대로 외우기)
    // 모델에 있는 시간을 시리얼라이징 해서 사용
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    // protected $casts = [
    //     'created_at' => 'Y-m-d H:i:s'
    // ];

    // 포멧 기능(날짜포멧)은 모델에 제시해주면 된다.
}
