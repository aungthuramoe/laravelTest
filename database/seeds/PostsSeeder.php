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
        for ($i=10; $i < 31; $i++) { 
            DB::table('posts')->insert([
                'title' => 'Title '.$i,
                'description' => 'Description '.$i,
                'status' => true,
            ]);
    	}
    }
}
