<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function up_vote(Request $request, $question_id, $id )
    {   
        try {
           // Check if already vote on answer with $answer_id
           $vote = Vote::where('answer_id', $id)
                        ->where('question_id', $question_id)
                        ->where('user_id', getAuthUserId())
                        ->first();
           if ($vote) {
               // Exist
               return response()
                   ->json(['message' => 'You already voted on this answer', 'statusCode' => 419])
                   ->setStatusCode(200);
           } else {
               // Not Exist
               $vote             = new Vote();
               $vote->answer_id  = $id;
               $vote->question_id= $question_id;
               $vote->user_id    = getAuthUserId();
               $vote->vote       = 0; // consider delete
               $vote->created_at = Carbon::now();
               $vote->updated_at = Carbon::now();
               $vote->save();

               return response()   
                   ->json(['vote_count' => getCountVote($question_id, $id), 'message' => 'Success', 'statusCode' => 200])
                   ->setStatusCode(200);
           }
        } catch (\Exception $ex) {
            Log::debug('UP_VOTE_EXCEPTION'. $ex->getMessage());
            return response()   
                    ->json(['message' => 'There was an error occured!', 'statusCode' => 419])
                    ->setStatusCode(200);
        }
    }

    public function down_vote(Request $request, $question_id, $id) {
        
        try {
            Vote::where('answer_id', $id)
                        ->where('question_id', $question_id)
                        ->where('user_id', getAuthUserId())
                        ->delete();
            return response()   
                ->json(['vote_count' => getCountVote($question_id, $id), 'message' => 'Success', 'statusCode' => 200])
                ->setStatusCode(200);
        } catch (\Exception $ex) {
            Log::debug('DOWN_VOTE_EXCEPTION'. $ex->getMessage());
            return response()   
                    ->json(['message' => 'There was an error occured!', 'statusCode' => 419])
                    ->setStatusCode(200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(vote $vote)
    {
        //
    }
}
