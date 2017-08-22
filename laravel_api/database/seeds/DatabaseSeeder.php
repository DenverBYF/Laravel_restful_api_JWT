<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) { 
        	DB::table('tests')->insert([
        			'title'=>'title'.$i,
        			'content'=>'content'.$i.str_random(20),
        			'tag'=>'tag'.$i
        		]);
        }
    }
}
