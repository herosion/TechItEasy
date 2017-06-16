<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = DB::table('categories')->insert(
        	array('name' => 'CSS3')
        );

        $category2 = DB::table('categories')->insert(
        	array('name' => 'Front-End')
        );
   
        $category3 = DB::table('categories')->insert(
        	array('name' => 'Back-End')
        );
     
    }
}
