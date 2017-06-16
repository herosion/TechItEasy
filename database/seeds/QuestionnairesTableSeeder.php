<?php

use Illuminate\Database\Seeder;

class QuestionnairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Questionnaire::class, 10)->create()->each(function ($questionnaire){

            $cat = [1, 2, 3];
            $rand = array_rand($cat, 2); //[1, 2]

            $questionnaire->categories()->attach([$cat[$rand[0]], $cat[$rand[1]]]);

            
            $ques = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
            $rand2 = array_rand($ques, 5);
            $count = count($rand2);

            for ($i=0; $i < $count; $i++) { 
                $questionnaire->questions()->attach([$ques[$rand2[$i]]]);
            }
            
        });

        DB::table('questionnaires')->insert([
            'title' => 'Q1 - Test débutant',
            'user_id' => 1
        ]);
      

 		DB::table('questionnaires')->insert([
            'title' => 'Q2 - intermédiaire PHP',
            'user_id' => 1
        ]);
       
    }
}
