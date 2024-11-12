<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent Model로 실행 > insert,update로는 created_at, updated_at 이 나오지 않는다.
        // $user = new User();
        // $user->u_email = 'admin@admin.com';
        // $user->u_password = Hash::make('qwer1234');
        // $user->u_name = '관리자';
        // $user->save();

        // user에서 factory를 이용해 30개의 더미 데이터를 만들겠다.
        User::factory(30)->create();

    }
}
