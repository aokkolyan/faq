<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class QuestionController extends Controller
{

  public function index()
  {

    $questions = Question::all();
    return view('questions.index', compact('questions'));
  }
  
  public function store(Request $request)
  {
   
    $request->validate([
      'question_title' => 'required',
    ]);
    $data = $request->all();
    $data['user_id'] = Auth::id();
    Question::create($data);
    return redirect()->route('question')->with($data);
  }

  public function viewquestion(Request $request, $id)
  {
    $questions = DB::table('questions')->where('id', $id)->get();

    // $answers = DB::table('answers')
    //   ->where('question_id', $id)
    //   ->get();

    $answers = Answer::with('user')
      ->where('question_id', $id)
      ->get();
    
    $questions = Question::find($id);
    return view('questions.viewquestion', compact('questions', 'answers'));
  }

  //  public function viewanswer($id){
  //   $answers = Answer::find($id);
  //   return view('answers.viewanswer',compact('answers'));
  //  }
  public function answerstore(Request $request, $id)
  {
    $request->validate([
      'title_answer' => 'required',
    ]);

    $answers = Answer::find($id);
    $answers = $request->all();
    $answers['user_id'] = Auth::id();
    $answers['question_id'] = $request->id;
    $answers['title_answer'] = $request->title_answer;
    Answer::create($answers);
    return redirect()->route('viewquestion', ['id' => $id]);
    
  }

  public function upload(Request $request)
  {
    if ($request->file('upload')) {
      $originalName   = $request->file('upload')->getClientOriginalName();
      $fileName       = pathinfo($originalName, PATHINFO_FILENAME);
      $extension      = $request->file('upload')->getClientOriginalExtension();
      $fileName       = $fileName . '_' . time() . '.' . $extension;

      $request->file('upload')->move(public_path('media'), $fileName);

      $url = asset('media/' . $fileName);
      return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }
  }
  // public function search(Request $request)
  // {
    

  //   $questions = Question::query()
  //     ->when(
  //       $request->q,
  //       function (Builder $builder) use ($request) {
  //         $builder->where('question_title', 'like', "%{$request->q}%")
  //           ->orWhere('description', 'like', "%{$request->q}%");
  //       }
  //     );
  //   return view('questions.index', compact('questions'));
  // }
}
