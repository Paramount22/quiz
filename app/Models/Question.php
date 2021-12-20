<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'quiz_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeQuestion($data)
    {
        $data['quiz_id'] = $data['quiz']; // quiz_id je v tabulke db a quiz je vo formulari, preto ich pridadime k sebe
        return Question::create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateQuestion($id, $data)
    {
       $question = Question::findOrFail($id);
       $question->question = $data->question;
       $question->quiz_id = $data->quiz;
       $question->save();
       return $question;
    }
}
