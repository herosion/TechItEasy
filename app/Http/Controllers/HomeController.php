<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Http\Requests;

use Mail;
use Config;


class HomeController extends Controller
{
	/*
	 * The main application page 
	 */
    public function welcome()
    {
    	$data = [];
        return view('welcome', $data); // May use compact
    }

    /*
     * Display the login page for the admin backoffice
     */
    public function login()
    {
    	$data = [];
    	return view('login', $data); // May use compact
    }
    public function authenticate(Request $request){
        session(['email' => $request->input("email"), "firstName" => $request->input("firstName"), "lastName" => $request->input("lastName")]);
 
        return redirect()->route('index')->withSucess('Vous êtes bien connecté(e)');
    }
    public function index(){
         $questionnaires = Questionnaire::paginate(5);

        return view('index', compact('page', 'questionnaires')); // May use compact

        //display questionnaires list        
    }
    public function launch($id){

        $questionnaire = Questionnaire::findOrFail($id);
        $questions = $questionnaire->questions;

        dump($questions); die; 
        /*$aQuestionnaire = array();
    
        $questions = DB::table('questions as q')
                ->select('question_id', 'q.label as question_label' , 'q.description as description_label', 'a.label as answer_label', 'a.id as answer_id', 'a.verify as verify')
                ->join('questionnaire_has_category as qhc', 'qhc.category_id', '=', 'q.category_id')
                ->join('answer as a', 'a.question_id', '=', 'q.id')
                ->where('qhc.questionnaire_id', $id)
                ->get();*/

        $answers = [];
        foreach ($questions as $key => $value) {
            $aQuestionnaire[$value->question_id] = [
                "questionnaire_id" =>  $id,
                "id"=>$value->question_id,
                "label"=>$value->question_label ,
                "description"=>$value->description_label,
            ];

            if(!isset($answers[$value->question_id]))
                $answers[$value->question_id] = [];

            $answers[$value->question_id][] = ['label'=>$value->answer_label, 'id'=>$value->answer_id, "verify"=>$value->verify ];
            # code...
        }

         return view('launch', compact('aQuestionnaire', 'answers')); // May use compact
    }

    public function valider(Request $request){

         if($request->has("questionnaire_id"))
         {
             $answers = DB::table('answer')
                ->select('answer.*')
                ->join('question', 'answer.question_id', '=', 'question.id')
                ->join('questionnaire_has_category', 'questionnaire_has_category.category_id', '=', 'question.category_id')              
                ->where('questionnaire_has_category.questionnaire_id', $request->input("questionnaire_id"))
                ->get();
        

            $iCorrect= 0;
            $iKO=0;
            foreach ($answers as $key => $value) {

               if($request->has($value->id)){
                    if($request->get($value->id) == $value->verify)
                        $iCorrect++;
                    else{
                        $iKO++;
                    }
                }
            }

             $subject = "Résultat du questionnaire du candidat: ".session('lastName')." ".session('firstName');
             $message = $iCorrect. " réponses correctes, et ".$iKO." réponses incorrectes.";

             Mail::send('emails.mail', ['body' => $message], function ($m) use ($subject) {
                 $m->from(Config::get('mail.from'), 'teachiteasy');

                 $m->to(session('email'))->subject($subject);
             });

            return redirect()->route('welcome');
        }
        else
        {
            //probleme lors du traitment
            return redirect()->route('index');
        }       
    }

}
