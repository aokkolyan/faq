<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

  public function index()
  {

    // $questions = Question::all();
    $questions = Question::paginate(10);
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
  public function search(Request $request)
  {
      // Get the search value from the request
    $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $questions = Question::query()
        ->where('question_title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->paginate(10);
        // dd($questions);
         return view('questions.index', compact('questions'));
    }
}
