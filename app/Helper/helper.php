<?php

use App\Models\User;
use App\Models\vote;
use Illuminate\Support\Facades\Auth;

/**
 *
 * @return Auth::user()
 */
function getAuthUser() {
    return Auth::user();
}

/**
 *
 * @return User Id
 */
function getAuthUserId() {
    return Auth::user()->id;
}

/**
 *
 * @param $question_id
 * @param $answer_id
 * @return number of vote count
 */
function getCountVote($question_id, $answer_id) {
    $count = vote::where('question_id', $question_id)->where('answer_id', $answer_id)->count();
    return $count;
}
