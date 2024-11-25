<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'board_id';

    protected $fillable = [
        'user_id',
        'content',
        'img',
        'like',
    ];

    // \DateTimeInterface \넣으면 위에 use 안적어도 됌
    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
        // 다중인곳은 belongsTo
    }
}
