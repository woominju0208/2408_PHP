<?php

namespace App\Models;

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
}
