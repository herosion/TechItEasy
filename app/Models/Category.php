<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Disable the table timestamps
     */
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class);
    }
}
