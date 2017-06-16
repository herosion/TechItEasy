<?php

namespace App\Http\Controllers\Admin;

use DB;
use Date;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Answer;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'questionnaire';

        $questionnaires = Questionnaire::latest('updated_at')->paginate($this->nbPaginate);

        return view('admin.questionnaire', compact('page', 'questionnaires', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $page     = 'questionnaire';
        
        $questionnaire = questionnaire::findOrFail($id);

        $categories = Category::all();

        $questions = $questionnaire->questions;
        //$categoriesQ = $questionnaire->categories;

        return view('admin.questionnaireShow', compact('page', 'questionnaire', 'categories', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page     = 'questionnaire';
        $questionnaire = new Questionnaire;
        $categories = Category::all();

        $questions = $questionnaire->questions()->paginate($this->nbPaginate);

        $questionsAll = Question::all();

        /*$questionsAll = DB::table('questions')
                ->select('questions.id', 'level', 'label', 'description', 'name')
                ->join('categories', 'questions.category_id', '=', 'categories.id')
                ->orderBy('categories.id')
                ->get();*/

        return view('admin.questionnaire-create-update', compact('page', 'categories', 'questionnaire', 'questions', 'questionsAll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $page     = 'questionnaire';
        
        $questionnaire = questionnaire::findOrFail($id);
        
        $catsQuestionnaire = $questionnaire->categories;
        
        //$questionsAll = Question::with('category')->paginate($this->nbPaginate);
        $questionsAll = Question::all(); //paginate($this->nbPaginate);
        /*dump($questionsAll); 
        foreach ($questionsAll as $q) {

            foreach ($catsQuestionnaire as $cat) {
                
                if ($q->category_id == $cat->id) {
                    
                    $test[] = $q; 
                }
            }
           
        }

        dump($test); die;*/

        $categories = Category::paginate(8);

        $questions = $questionnaire->questions()->paginate($this->nbPaginate);

        return view('admin.questionnaire-create-update', compact('page', 'questionnaire','categories', 'questions', 'questionsAll', 'catsQuestionnaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        

        $page = 'questionnaire';
        $date = Date::now();

        $questionnaire = questionnaire::findOrFail($id);

        $questionnaire->updated_at = $date;

        $questionnaire->title = $request->input('title');
        
        $categories = $request->categories? $request->categories : [];
        $questionnaire->categories()->sync($categories);

        $questions = $request->questions? $request->questions : [];
        $questionnaire->questions()->sync($questions);

        $questionnaire->save();

        return redirect()
                ->route('admin.questionnaire.index')
                ->withSuccess('Le questionnaire a bien été modifiée.');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $page     = 'questionnaire';
        $date = Date::now();

        if ($request->isMethod('post')) {

            $idQuestionnaire = DB::table('questionnaires')->insertGetId(
                    [
                     'title' => $request->input('title'), 
                     'user_id' => 1
                    ]);
            
            $questionnaire = Questionnaire::find($idQuestionnaire);

            $questionnaire->updated_at = $date;
            $questionnaire->created_at = $date;
           
            $categories = $request->categories? $request->categories : [];
            $questionnaire->categories()->attach($categories);

            $questions = $request->questions? $request->questions : [];
            $questionnaire->questions()->attach($questions);

            $questionnaire->save();
                    
        }

        return redirect(route('admin.questionnaire.index'))
            ->withSuccess('Le questionnaire a bien été crée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $questionnaire = Questionnaire::find($id);
        $questionsQuestionnaire = $questionnaire->questions;
        $categoriesQuestionnaire = $questionnaire->categories;

        foreach ($questionsQuestionnaire as $question) {
         
            DB::table('question_questionnaire')
            ->where('questionnaire_id', '=', $id)
            ->where('question_id', '=', $question->id)
            ->delete();
        }

        foreach ($categoriesQuestionnaire as $category) {
         
            DB::table('category_questionnaire')
            ->where('questionnaire_id', '=', $id)
            ->where('category_id', '=', $category->id)
            ->delete();
        }
       
        $questionnaire->delete();
            //Questionnaire::destroy($id);

        return redirect(route('admin.questionnaire.index'))
            ->withSuccess('Le questionnaire a bien été supprimé.');
    }

    protected function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        }
        else $new = $obj;

        return $new;       
    }

}
