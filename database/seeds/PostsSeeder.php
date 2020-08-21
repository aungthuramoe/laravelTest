<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 31; $i++) { 
            DB::table('posts')->insert([
                'title' => 'Title '.$i,
                'description' => 'Description '.$i,
                'status' => '1',
                'create_user_id' => '1',
                'updated_user_id' => '1',
            ]);
    	}
    }
}
