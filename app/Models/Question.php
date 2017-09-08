<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';
    public $timestamps = false;
    protected $dates = ['update_at', 'created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level', 'label', 'description', 'category_id', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
