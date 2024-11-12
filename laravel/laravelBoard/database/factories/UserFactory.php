<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    // factory : 만들 대량 더미 데이터 retrun[] 한개당 하나의 레코드
    // seeder에서 실행 시킨다.
    {
        // 오늘날짜부터 1년전 날짜 중 랜덤한 날짜를 가져옴
        $date = $this->faker->dateTimeBetween('-1 years');

        return [
            'u_email' => $this->faker->unique()->safeEmail()
            ,'u_password' => Hash::make('qwer1234')
            ,'u_name' => $this->faker->name()
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
        //  > UserSeeder로 가서 데이터 만들러
    }
}
