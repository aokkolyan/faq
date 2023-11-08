<?php

use App\Models\Question;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnswerController;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[QuestionController::class,'index'])->name('question');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route Questions//
Route::get('/question',[QuestionController::class,'index'])->name('question');
// Route::post('/question/create',[QuestionController::class,'create'])->name('create');
Route::post('/question/store',[QuestionController::class,'store'])->name('addquestion');
//Route::get('/question',[QuestionController::class,'show']);
Route::get('/question/viewquestion/{id}/',[QuestionController::class,'viewquestion'])->name('viewquestion');
//Route::get('/question/viewanswer/{id}',[QuestionController::class,'viewanswer']);
Route::post('/question/viewquestion/{id}/',[QuestionController::class,'answerstore'])->name('question.answer');
Route::post('/upload',[QuestionController::class,'upload'])->name('ckeditor.upload');
Route::get('/question/search',[QuestionController::class,'search']);


//Votes URL Route//
//  Route::resource('/vote',VoteController::class);
//  Route::post('/up-vote/{question_id}/{id}/',[VoteController::class,'up_vote'])->name('vote');
 Route::post('/down-vote/{question_id}/{id}/',[VoteController::class,'down_vote'])->name('down.vote');
 Route::post('/up-vote/{question_id}/{id}/',[VoteController::class, 'upVote'])->name('vote');
 //Route::post('/down-vote',[VoteController::class,'down-vote'])->name('vote');

 //Import User
 //Route::post('users-import', 'import')->name('users.import');

//Post test//
Route::get('/posts',[PostController::class,'index']);
Route::get('posts/create',[PostController::class,'create']);
Route::post('posts/store',[PostController::class,'store'])->name('posts.store');

Route::resource('/answer',AnswerController::class);
require __DIR__.'/auth.php';
