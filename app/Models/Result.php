<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id', 'question_id', 'user_id', 'quiz_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * Get user results
     * @param $userId
     * @param $quizId
     * @return mixed
     */
    public function getResult($userId, $quizId)
    {
      return Result::where('user_id', $userId)
            ->where('quiz_id', $quizId)->get();
    }
}
