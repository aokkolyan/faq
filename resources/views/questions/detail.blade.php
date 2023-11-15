@extends('layouts.admin')
<title>WEG_Viewquestion</title>
@section('content')

    <style>
        html {
            font-size: 16px;
            line-height: 1.5;
        }

        body {
            background: #ecf0f1 !important;
            position: relative;
            font-family: "Ubuntu", "Helvetica", "Arial", "FreeSans", sans-serif;
            color: #34495e;
        }

        .question-list {

            padding: 10px;
            margin-bottom: 5px;
            background: #fff;
        }

        ol {

            padding-inline-start: 0px;
        }

        ol.q {

            padding: 5px;
        }

        ol>li {
            list-style-type: none;
        }

        div {
            display: block;
        }

        .qa-main-heading {
            position: relative;
            margin: 0 0 5px;
            margin-top: 30px;
            padding: 8px 52px 8px 20px;
            background: #3498db;
            color: #fff;
        }

        .qa-q-item-stats {
            float: left;
        }

        .qa-a-count-data {
            font-size: 24px;
            line-height: 40px;
            display: block;
        }

        @media (min-width: 800px) {
            .qa-a-count {
                width: 65px;
                height: 60px;
                line-height: 0.5;
                float: left;
            }
        }

        .qa-a-count-zero {
            background-color: #e74c3c;
        }

        @media (min-width: 800px) {
            .qa-voting {
                width: 68px;
                height: 60px;
                line-height: 0.5;
                float: left;
            }
        }

        .qa-voting {
            background-color: #ecf0f1;
            color: #445f7a;
        }

        .qa-view-count {
            font-size: 12px;
            text-align: center;
            clear: both;
            float: left;
            width: 100%;
            height: auto;
            margin: 6px 0 -4px;
            word-break: break-word;
            margin-top: 21px;
        }

        .qa-netvote-count-data,
        .qa-a-count-data {
            font-size: 24px;
            line-height: 40px;
            display: block;

        }

        .qa-netvote-count-pad,
        .qa-a-count-pad {
            font-size: 12px;
        }

        .qa-a-count {
            background-color: #3498db;
            color: #fff;
            text-align: center;
        }

        .qa-a-count-zero {
            background-color: #e74c3c;
        }

        .qa-netvote-count {
            display: block;
            text-align: center;
        }

        .qa-vote-up-button {
            background-position: 0 0;
            top: 12px;
        }

        .qa-vote-down-button {
            background-position: -16px 0;
            bottom: 12px;
        }

        input[type="submit"],
        button {
            cursor: pointer;
            text-align: center;
        }

        .qa-vote-buttons {
            float: left;
            height: 60px;
            width: 20px;
            position: relative;
        }

        .qa-vote-up-button,
        .qa-vote-down-button,
        .qa-voted-down-button,
        .qa-vote-down-disabled {
            text-indent: -9999px;
            background: transparent url(images/vote-buttons-3.png) no-repeat;
            width: 16px;
            height: 10px;
            border: none;
            margin: 0;
            padding: 0;
            position: absolute;
            left: 4px;
        }

        .qa-vote-down-button {
            background-position: -16px 0;
            bottom: 12px;
        }
        #a_list_title {
        padding: 10px 20px;
        margin-bottom: 5px;
        background: #2ecc71;
        color: #fff;
        margin-top: 0;
        }
        h2 {
            font-size: 1.25em;
        }
        .qa-part-a-form {
        padding: 20px;
        background: #fff;
        margin-bottom: 5px;
      }
    </style>
    <div class="row">
        <div class="col-md-1 p-3  text-black">
        </div>
        <div class="col-md-8 p-3  text-black">
            @if (Route::has('login'))
                @auth
                    <a class="float-end btn btn-primary" href="{{ route('question') }} " data-bs-toggle="modal"
                        data-bs-target="#myModal" aria-disabled="true" style="display: none">Ask question</a>
                @else
                    <div class="alert alert-danger">
                        <p>Please login to ask question!!</p>
                    </div>
                @endauth
            @endif

            {{-- Import users form --}}
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" style="display: none">
                @csrf
                <input type="file" name="file" class="form-control col-md-5">
                @if ($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <br>
                <button class="btn btn-success">Import User Data</button>
            </form>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            </p>
            <div class="question-list">
                <div class="qa-q-item-stats" style="display:none">
                    <div class="qa-voting qa-voting-net" id="voting_111145">
                        <div class="qa-vote-buttons qa-vote-buttons-net" id="qa-btn">
                            <input title="Click to vote up" name="vote_up" type="submit" id="up_voes" value="+"
                                class="qa-vote-first-button qa-vote-up-button">
                            <input title="Click to vote down" name="vote_down" id="down_votes" type="submit" value="–"
                                class="qa-vote-second-button qa-vote-down-button">
                        </div>
                        <div class="qa-vote-count qa-vote-count-net">
                            <span class="qa-netvote-count">
                                <span class="qa-netvote-count-data">0</span><span class="qa-netvote-count-pad">
                                    votes</span>
                            </span>
                        </div>
                        <div class="qa-vote-clear">
                        </div>
                    </div>
                </div>
                <ol class="q" style="padding:10px;">
                    <li>
                        <h5 class="s-post-summary--content-title" style=" font-weight: bold;">
                            <a href="/question/viewquestion/{{ $question->id }}" class="s-link" target="blink">{{ $question->question_title }}</a>
                        </h5>
                    </li>
                    <p style="font-size: 13px;font-family:sans-serif">{{ $question->description }}</p>
                    <p style="float:right;font-size:10px;cursor: pointer;">Q2A by <span
                            style="color:rgba(10,114,170,255);font-weight:bold">{{ $question->question->name }}</span></p>
                </ol>
            </div>
            <div class="qa-part-a-form">
                <div class="qa-a-form" id="anew" style="display:none;">
                <h2>Please <a>log in</a> or <a>register</a> to answer this question.</h2>
                </div> <!-- END qa-a-form -->
                </div>
            <h2 id="a_list_title"><span itemprop="answerCount">{{ $answers->count()}}</span> Answer</h2>
            @foreach ($answers as $answer)
                <div class="list-group">
                    <div class="qa-q-item-stats">
                    </div>
                    <li class="list-group-item list-group-item-action m-2" aria-current="true" id="answers-list"
                        style="height: auto">
                        <div class="d-flex justify-content-between" style="width:auto">
                            <h6 class="mb-5" id="space-title"><span> {!! $answer->title_answer !!}</span></h6>
                        </div>
                        <div class="user">
                            <small style="margin-left: 84% ; margin-top:20px;font-size:12px">Answered
                                {{ date('d-M-Y', strtotime($answer->created_at)) }}</small>
                            <p style="float:right;font-size:12px;color: #3498db;text-decoration: underline;
                        }">Answer by <span style="margin-leflt"> {{ $answer->user->name }}</span>
                            </p>
                        </div>
                        @if (Route::has('login'))
                            @auth
                                <form action="{{ url('/question/updateanswer/' . $answer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/question/editanswer/' . $answer->id) }}">
                                        <i class="fa-solid fa-pen-to-square pointer" title="edit"
                                            style="cursor: pointer;"></i></a>
                                    {{-- <a  href="{{route('question.delete',$item->id)}}" type="submit" data-toggle="tooltip" title='Delete' class="show_confirm"><i class="fa-sharp fa-solid fa-trash" style="color: red; cursor: pointer;"></i></a>  --}}
                                </form>
                                <form action="{{ url('/question/deleteanswer/' . $answer->id) }}" method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a type="submit" data-toggle="tooltip" title='Delete' class="show_confirm"><i
                                            class="fa-sharp fa-solid fa-trash" style="color: red; cursor: pointer;"></i></a>
                                </form>
                            @endauth
                        @endif

                    </li>

                </div>
            @endforeach
            @if (Route::has('login'))
                @auth
                    <form action="{{ route('question.answer', $question->id) }}" method="POST" enctype="multipart/form-data"
                        multiple>
                        @csrf
                        <div class="form-group">
                            <label for="">Your Answer</label>
                            <div class="form-group">
                                <textarea id="summernote" name="title_answer" placeholder="Answer.........."></textarea>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="btn mt-3 btn-primary">Post Your Answer</button>
                    </form>
                @else
                @endauth
            @endif
        </div>
        <div class="col-md-3 p-3  text-black" id="productlist">
            <form action="{{ url('/question/search') }}" method="GET" class="d-flex" role="search">
                @csrf
                <input class="form-control me-2" name="search" type="text" placeholder="Search"
                    value="{{ request()->get('search') }}" autocomplete="off" aria-label="Search">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form><br>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $('.show_confirm').click(function(event) {

            var form = $(this).closest("form");
            var name = $(this).data("name");

            event.preventDefault();

            swal({

                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    form.submit();
                }
            });
        });
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>
@endsection
