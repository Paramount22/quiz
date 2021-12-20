<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer', 'question_id', 'is_correct'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @param $data
     * @param $question
     */
    public function storeAnswer($data, $question)
    {
        foreach ($data['options'] as $key => $option) {
            $is_correct = false;
            if($key == $data['correct_answer']) {
                $is_correct = true;
            }
            Answer::create([
               'question_id' => $question->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
    }

    /**
     * @param $data
     * @param $question
     */
    public function updateAnswer($data, $question)
    {
        $this->deleteAnswer($question->id);
        $this->storeAnswer($data, $question);

    }

    /**
     * @param $questionId
     */
    public function deleteAnswer($questionId)
    {
        Answer::where('question_id', $questionId)->delete();
    }

}
