<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'minutes'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user');
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function assignExam($data)
    {
        $quizId = $data['quiz_id'];
        $quiz = Quiz::findOrFail($quizId);
        $userId = $data['user_id'];
        return $quiz->users()->syncWithoutDetaching($userId);
    }

    /**
     * @return array
     */
    public function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = auth()->id();
        $user = Result::where('user_id', $authUser)->get();
        foreach ($user as $data) {
            array_push($attemptQuiz, $data->quiz_id);
        }
        return $attemptQuiz;
    }

    /**
     * Vsetky kvizy prihlaseneho usera
     * @param $authUser
     * @return \Illuminate\Support\Collection
     */
    public function getUsersQuizzes($authUser)
    {
      return  DB::table('quiz_user')
            ->where('user_id', $authUser)
            ->get();
}

    /**
     * @param $authUser
     * @return array
     */
    public function checkUser($authUser)
    {
        return DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();
    }

    /**
     * @param $authUser
     * @return mixed
     */
    public function checkUserResult($authUser)
    {
        return Result::where('user_id', $authUser)->whereIn('quiz_id', $this->hasQuizAttempted())
            ->pluck('quiz_id')->toArray();
    }

    /**
     * Kontrola ci su v poli $assignedQuizId kvizy
     * @param $assignedQuizId
     * @return mixed
     */
    public function areQuizzesAssigned($assignedQuizId)
    {
        //whereIn - porovna viac id naraz, where - porovna konkretne id
        return Quiz::whereIn('id', $assignedQuizId)->get();
    }

    /**
     * Kontrola ci ma user pridelene nejake kvizy
     * @param $authUser
     * @return bool
     */
    public function isQuizAssigned($authUser)
    {
        return DB::table('quiz_user')
            ->where('user_id', $authUser)
            ->exists();
    }

    /**
     * Kontrola ci bol kviz dokonceny
     * @param $authUser
     * @return mixed
     */
    public function wasQuizCompleted($authUser)
    {
        return Result::where('user_id', $authUser)
            ->whereIn('quiz_id', $this->hasQuizAttempted() )->pluck('quiz_id')
            ->toArray();
    }




}
