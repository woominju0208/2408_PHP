<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::factory(100)->create();
        // factory() ()안에 숫자로만 넣으면 굉장히 많은 메모리 과다로 터질수 있어 반복문으로 5000으로 잡고 메모리올리고 그걸 반복하게 만든다.  
        // for($i= 0; $i < 60; $i++) {
        //     Board::factory(5000)->create();
        // }

        // $total = 100000;
        // $interval = 5000;
        // for($i = 0; $i < $total; $i += $interval) {
        //     Board::factory($interval)->create();
        // }

    }
}
