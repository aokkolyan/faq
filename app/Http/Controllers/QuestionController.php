<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    // $questions = DB::table('questions')->where('id', $id)->paginate(10);
    $question = Question::with(['question'])->where('id', $id)->first();

    // return response()->json($question);

    // $answers = DB::table('answers')
    //   ->where('question_id', $id)
    //   ->get();
  
    $answers = Answer::with('user')
      ->where('question_id', $id)
      ->get();
    return view('questions.detail', compact('question', 'answers'));
  }
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
   
    $search = $request->input('search');  
    $questions = Question::query()
        ->where('question_title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->paginate(10);
        // dd($questions);
         return view('questions.index', compact('questions'));
    }

    public function question_edit($id)
    {
      $questions = Question::find($id);
      // $questions = Question::paginate(10);
      return view('questions.edit',compact('questions'));
    }

    public function question_update(Request $request , $id)
    {
     
      $request->validate([
        'question_title'=> 'required'
      ]);
      $questions = Question::find($id);
      $questions->question_title = $request->input('question_title');
      $questions->description    = $request->input('description');
      $questions->update();
      // $questions->update($request->all());
      return redirect('/')->with('success','Update success');
      //  return redirect()->route('viewquestion', ['id'=>$id]);
                        // ->with('success','Product updated successfully');
    }

    public function delete($id)
    {
      Question::find($id)->delete();
      return back();
    }

    public function edit_answer($id)
    {
      $answer = Answer::find($id);
      return view ('answers.edit',compact('answer'));
    }
    public function update_answer(Request $request ,$id)
    {

      // try{
      //   $request->validate([
      //     'title_answer' => 'required'
      //   ]);
      //   $answer = Answer::find($id);
      //   $answer->title_answer = $request->input('title_answer');
      //   $answer->update();
      //   return response()->json(['data' => $answer]);

      // }catch (\Exception $ex) {
      //       Log::debug('UP_VOTE_EXCEPTION'. $ex->getMessage());
      //       return response()   
      //               ->json(['message' => 'There was an error occured!', 'statusCode' => 419])
      //               ->setStatusCode(200);
      //   }

     
      $request->validate([
        'title_answer' => 'required'
      ]);
      $answer = Answer::find($id);
      $answer->title_answer = $request->input('title_answer');
      $answer->save();
      $question = Question::find($answer->question_id);
      return redirect()->route('viewquestion', ['id' =>$answer->id,'id' => $question->id ]);
                     
    }
    
    public function delete_answer($id)
    {
      Answer::find($id)->delete();
      return back();
    }
}
