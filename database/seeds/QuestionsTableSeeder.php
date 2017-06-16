<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        factory(App\Models\Question::class, 10)->create()->each(function ($question){

            $cat = [1, 2, 3];

            $question->category()->associate($cat[array_rand($cat, 1)]);
        });

        DB::table('questions')->insert(
                ['level' => 1, 
                 'label' => 'Qu\'est ce qu\'une fonction anonyme ?', 
                 'description' => 'Question basique concernant le JavaScript',
                 'user_id' => 1,
                 'category_id' => rand(1, 3)
                ]
        );

        DB::table('questions')->insert(
                ['level' => 1, 
                 'label' => 'Quelle version d\'ecmascript est sorti en juin 2015 ?', 
                 'description' => 'Question basique concernant le JavaScript',
                 'user_id' => 1,
                 'category_id' => rand(1, 3)
                ]
        );

       
        DB::table('questions')->insert(
                ['level' => 2, 
                 'label' => 'Quelle fonction permet de lire le résultat d\'une ressources MySQL renvoyée par mysql_query() ?', 
                 'description' => 'Question basique concernant du back-end au niveau SQL',
                 'user_id' => 1,
                 'category_id' => rand(1, 3)
                ]
        );

    }

}
