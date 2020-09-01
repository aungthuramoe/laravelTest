<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'profile' => '07-01.jpg',
                'type' => '0',
                'phone' => '09776655443',
                'address' => 'Yangon',
                'dob' => Carbon::create('2000', '01', '01'),     
                'create_user_id' => '1',  
                'updated_user_id' => '1',                 
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
