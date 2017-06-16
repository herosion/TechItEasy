<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert(array(
            array('label' => 'Une fonction qui sert à isoler du code, contrairement aux fonctions classiques qui servent pour de nombreuses autres utilisations', 'verify' => 1, 'question_id' => 1),
            array('label' => 'Une fonction qui est plus rapide à l\'exécution', 'verify' => 0, 'question_id' => 1),
            array('label' => 'Une fonction sans nom', 'verify' => 0, 'question_id' => 1),
            array('label' => 'Une fonction réutilisable facilement à plusieurs endroits', 'verify' => 0, 'question_id' => 1)
        ));

        DB::table('answers')->insert(array(
            array('label' => 'Une fonction qui sert à isoler du code, contrairement aux fonctions classiques qui servent pour de nombreuses autres utilisations', 'verify' => 1, 'question_id' => 2),
            array('label' => 'Une fonction qui est plus rapide à l\'exécution', 'verify' => 0, 'question_id' => 2),
            array('label' => 'Une fonction sans nom', 'verify' => 0, 'question_id' => 2),
            array('label' => 'Une fonction réutilisable facilement à plusieurs endroits', 'verify' => 0, 'question_id' => 2)
        ));

        DB::table('answers')->insert(array(
            array('label' => 'Une fonction qui sert à isoler du code, contrairement aux fonctions classiques qui servent pour de nombreuses autres utilisations', 'verify' => 1, 'question_id' => 3),
            array('label' => 'Une fonction qui est plus rapide à l\'exécution', 'verify' => 0, 'question_id' => 3),
            array('label' => 'Une fonction sans nom', 'verify' => 0, 'question_id' => 3),
            array('label' => 'Une fonction réutilisable facilement à plusieurs endroits', 'verify' => 0, 'question_id' => 3)
        ));
    }
}
