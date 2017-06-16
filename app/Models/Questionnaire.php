<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questionnaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Disable the table timestamps
     */
    protected $dates = ['update_at', 'created_at'];
   /* public $timestamps = true;*/
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function saveCats($categories)
    {
        if( !empty($categories) )
        $this->categories()->attach($categories);
        
    }

    public function isCat(int $catId)
    {
      
      foreach($this->categories as $category)
      {
          
        if(count($this->categories) > 0){
          
          foreach ($this->categories as $category) {
          
            if($category->id == $catId) return true;
          }
        } 

        return false;
        
      }
    
    }

    public function isQuestion(int $questionId)
    {
      
      foreach($this->questions as $questions)
      {
          
        if(count($this->questions) > 0){
          
          foreach ($this->questions as $question) {
          
            if($question->id == $questionId) return true;
          }
        } 

        return false;
        
      }
    
    }

}
