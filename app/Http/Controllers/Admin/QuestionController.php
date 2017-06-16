<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Pagination\Paginator;
use DB;
use Validator;
use App\Http\Requests;
use App\Models\Question;
use App\Models\Category;
use App\Http\Controllers\Controller;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $page = 'question';
        
        $questions = Question::select('questions.id', 'level', 'label', 'description', 'name')
                ->join('categories', 'questions.category_id', '=', 'categories.id')
                ->paginate($this->nbPaginate);

        //dump($questions); die;

        $categories = Category::all();

        $difficulties = array("1" => "Débutant", "2" => "Intermédiare", "3" => "Difficile");

        return view('admin.question', compact('page', 'questions', 'categories', 'difficulties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $page = 'question';
        $question = new Question;
        
        $cats = DB::table('categories')
                ->get();
        $difficulties = array("1" => "Débutant", "2" => "Intermédiare", "3" => "Difficile");
        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->name;
        }
        error_log(print_r($categories, true));
        return view('admin.questionAjout', compact('page', 'question', 'categories', 'difficulties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->isMethod('post')) {

            $idQuestion = DB::table('questions')->insertGetId(
                    ['level' => $request->input('difficulties'), 'label' => $request->input('question'), 'description' => $request->input('description'), 'category_id' => $request->input('categories'), 'user_id' => 1]);
        

            //insert answers
            $valide_1 = (null == $request->input('reponse_valide_1')  ? "0" : "1");
            $valide_2 = (null == $request->input('reponse_valide_2')  ? "0" : "1");
            
             DB::table('answers')->insert(
                    ['label' => $request->input('answer1'), 'verify' => $valide_1, 'question_id'=>$idQuestion]);
             DB::table('answers')->insert(
                    ['label' => $request->input('answer2'), 'verify' => $valide_2, 'question_id'=>$idQuestion]);
             if($request->input('answer3'))
             {
                $valide_3 = is_null($request->input('reponse_valide_3')  ? "0" : "1");
                 DB::table('answers')->insert(
                    ['label' => $request->input('answer3'), 'verify' => $valide_3 , 'question_id'=>$idQuestion]);
             }
             if($request->input('answer4'))
             {
                $valide_4 = is_null($request->input('reponse_valide_4')  ? "0" : "1");
                 DB::table('answers')->insert(
                    ['label' => $request->input('answer4'), 'verify' => $valide_4, 'question_id'=>$idQuestion]);
             }
             if($request->input('answer5'))
             {
                $valide_5 = is_null($request->input('reponse_valide_5')  ? "0" : "1");
                 DB::table('answers')->insert(
                    ['label' => $request->input('answer5'), 'verify' => $valide_5, 'question_id'=>$idQuestion]);
             }
                 
             if($request->input('answer6'))
             {
                 $valide_6 = is_null($request->input('reponse_valide_6')  ? "0" : "1");
                 DB::table('answers')->insert(
                    ['label' => $request->input('answer6'), 'verify' => $valide_6, 'question_id'=>$idQuestion]);
             }

        }
        return redirect(route('admin.question.index'))
            ->withSuccess('La question a bien été ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $page     = 'question';
        $question = Question::findOrFail($id);

        $categories = $question->categories;

        $cats = DB::table('categories')
                ->get();
        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->name;
        }


        $reponses = DB::table('answers')->where('question_id', '=',$id)->get();
        $i = 0;

        $aReponses = array_fill(0, 6, null);
        foreach ($reponses as $rep) {
            $aReponses[$i] = $rep;
            $i++;
        }

        $difficulties = array("1" => "Débutant", "2" => "Intermédiare", "3" => "Difficile");

        return view('admin.questionShow', compact('page', 'question','categories','difficulties','aReponses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $page     = 'question';
        $question = Question::findOrFail($id);

        $categories = $question->categories;

        $cats = DB::table('categories')
                ->get();
        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->name;
        }

        $reponses = DB::table('answers')->where('question_id', '=',$id)->get();
        
        $i = 0;

        $aReponses = array_fill(0, 6, null);
        foreach ($reponses as $rep) {
            $aReponses[$i] = $rep;
            $i++;
        }

        $difficulties = array("1" => "Débutant", "2" => "Intermédiare", "3" => "Difficile");

        return view('admin.questionAjout', compact('page', 'question','categories','difficulties','aReponses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $page     = 'question';

        $question = question::findOrFail($id);
        $question->category_id = $request->input('categories');
        $question->label = $request->input('description');
        $question->description = $request->input('question');
        $question->level = $request->input('difficulties');
        
        //we save
        $question->save();

       
        //reinsert all answers
        if($request->input('reponse_1_id')){
            
            $valide = (null == $request->input('reponse_valide_1')  ? "0" : "1");

            DB::table('answers')
            ->where('id', $request->input('reponse_1_id') )
            ->update(array('label' => $request->input('answer1'), 'verify' => $valide));
        }elseif ($request->input('answer1')) {
            $valide_1 = is_null($request->input('reponse_valide_1')  ? "0" : "1");
            DB::table('answers')->insert(
                    ['label' => $request->input('answer1'), 'verify' => $valide_1 , 'question_id'=>$id]);
        }

        if($request->input('reponse_2_id')){
            
            $valide = (null == $request->input('reponse_valide_2')  ? "0" : "1");

            DB::table('answers')
            ->where('id', $request->input('reponse_2_id') )
            ->update(array('label' => $request->input('answer2'), 'verify' => $valide));
        }elseif ($request->input('answer2')) {
            $valide_2 = is_null($request->input('reponse_valide_2')  ? "0" : "1");
            DB::table('answers')->insert(
                    ['label' => $request->input('answer2'), 'verify' => $valide_2 , 'question_id'=>$id]);
        }

        if($request->input('reponse_3_id')){
            $valide = (null == $request->input('reponse_valide_3')  ? "0" : "1");
            DB::table('answers')
            ->where('id', $request->input('reponse_3_id') )
            ->update(array('label' => $request->input('answer3'), 'verify' => $valide));
        }
        elseif ($request->input('answer3')) {
            $valide_3 = is_null($request->input('reponse_valide_3')  ? "0" : "1");
            DB::table('answers')->insert(
                    ['label' => $request->input('answer3'), 'verify' => $valide_3 , 'question_id'=>$id]);
        }

        if($request->input('reponse_4_id')){
            $valide = (null == $request->input('reponse_valide_4')  ? "0" : "1");
            DB::table('answers')
            ->where('id', $request->input('reponse_4_id') )
            ->update(array('label' => $request->input('answer4'), 'verify' => $valide));
        }
        elseif ($request->input('answer4')) {
            $valide_4 = is_null($request->input('reponse_valide_4')  ? "0" : "1");
            DB::table('answers')->insert(
                    ['label' => $request->input('answer4'), 'verify' => $valide_4 , 'question_id'=>$id]);
        }

        if($request->input('reponse_5_id')){
            $valide = (null == $request->input('reponse_valide_5')  ? "0" : "1");
            DB::table('answers')
            ->where('id', $request->input('reponse_5_id') )
            ->update(array('label' => $request->input('answer5'), 'verify' => $valide));
        }
        elseif ($request->input('answer5')) {
            $valide_5 = is_null($request->input('reponse_valide_5')  ? "0" : "1");
            DB::table('answers')->insert(
                    ['label' => $request->input('answer5'), 'verify' => $valide_5 , 'question_id'=>$id]);
        }

        if($request->input('reponse_6_id')){
            $valide = (null == $request->input('reponse_valide_6')  ? "0" : "1");
            DB::table('answers')
            ->where('id', $request->input('reponse_6_id') )
            ->update(array('label' => $request->input('answer6'), 'verify' => $valide));
        }
        elseif ($request->input('answer6')) {

            $valide_6 = (null == $request->input('reponse_valide_6')  ? "0" : "1");
          
            DB::table('answers')->insert(
                    ['label' => $request->input('answer6'), 'verify' => $valide_6 , 'question_id'=>$id]);
        }

         return redirect()
                ->route('admin.question.index')
                ->withSuccess('La question a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
       $answers = DB::table('answers')->where('question_id', '=', $id)->delete();
       
       $questionnaire = DB::table('question_questionnaire')->where('question_id', '=', $id)->delete();

       $question =  DB::table('questions')->where('id', '=', $id)->delete();
       

        return redirect(route('admin.question.index'))
            ->withSuccess('La question a bien été suprimée.');
    }

    /**
     * Test si la question est utilisée dans un QCM
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function testQuestion(Request $request, $id) {
        if ($request->ajax()) {
            $questionnaire = DB::table('questionnaire_has_question')
                    ->where('question_id', '=', $id)
                    ->get();
            if (empty($questionnaire)) {
                $reponse = array(
                    'success' => true,
                    'data' => true
                );
            } else {
                $reponse = array(
                    'success' => true,
                    'data' => false
                );
            }
            return json_encode($reponse);
        }
    }*/

}
