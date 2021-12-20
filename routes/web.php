<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false, 'reset' => false]);

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    // User section
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('quiz/{quiz}', [ExamController::class, 'getQuizQuestions'])->name('quiz.questions');
    Route::post('result/store', [ExamController::class, 'storeResult'])->name('result.store');
    Route::get('result/user/{user}/quiz/{quiz}', [ExamController::class, 'viewResult'])
        ->name('view.result');
    // Admin section
    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::view('/', 'admin.dashboard.index');
        Route::get('quiz/{quiz}/questions', [QuizController::class, 'question'])->name('quiz.question');
        Route::resources([
            'quizzes' => QuizController::class,
            'questions' => QuestionController::class,
            'users' => UserController::class
        ]);
        Route::get('result', [ExamController::class, 'result'])->name('result');
        Route::get('result/{userId}/quiz/{quiz}', [ExamController::class, 'usersResults'])
            ->name('view.users.results');
        /*Exam*/
        Route::get('exam/assign', [ExamController::class, 'create'])->name('assign.exam');
        Route::post('exam/assign', [ExamController::class, 'store'])->name('assign.exam.store');
        Route::get('exam/user', [ExamController::class, 'userExam'])->name('view.exam');
        Route::post('exam/remove', [ExamController::class, 'removeExam'])->name('remove.exam');

    });
});




