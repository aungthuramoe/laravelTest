<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

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
                'password' => bcrypt('123456'),
                'profile' => '',
                'type' => '1',
                'phone' => '1',
                'address' => '1',
                'dob' => Carbon::create('2000', '01', '01'),     
                'create_user_id' => '1',  
                'updated_user_id' => '1', 
                'deleted_user_id' =>   '1'                    
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
