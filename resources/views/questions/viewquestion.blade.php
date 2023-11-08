@extends('layouts.admin')

@section('content')


    <style>
        
        body {
            background: #ecf0f1 !important;
            position: relative;
            color: #34495e;
        }

        #answers-list {
            /* background-color: rgb(32, 39, 63, 1); */
            background-color: #fff;
            border-radius: 10px !important;
            /* border: 1px solid rgb(14, 181, 22); */
            color: black;
            cursor: pointer;
        }

        /* #answers-list:hover {
                        background-color: rgb(63, 81, 146);
                        transition: 0.9s;
                    } */

        #space-title {
            text-indent: 1px;
            letter-spacing: 0.5px;
            padding: 1px;
            line-height: 1.9;
            font-family: 'Roboto Slab', serif;
            font-size: 17px !important;
            margin: 0 0 1em 0;

        }

        #question {
            color: black;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }

        .qa-main-heading {
            position: relative;
            margin: 0 0 5px;
            padding: 8px 52px 8px 20px;
            background: #3498db;
            color: #fff;
        }

        .a_list_title {
            padding: 10px 20px;
            margin-bottom: 5px;
            background: #2ecc71;
            color: #fff;
            margin-top: 0;
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
            /* text-indent: -9999px; */
            /* background: transparent url('images/vote-buttons-3.png') no-repeat; */
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
        .list-group{
            padding: 10px;
            margin-bottom: 5px;
            background: #fff;
        }
    </style>
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6 ">
                <h5 id="question" class="qa-main-heading">{{ $questions->question_title }}</h5>
                <div class="form-group">
                    <p>{{ $questions->description }}</p>
                </div>
                <hr>
                <h5 class="a_list_title"><span itemprop="answerCount">Answer</span></h5>

                @foreach ($answers as $answer)
                    <div class="list-group">
                        <div class="qa-q-item-stats">
                            <div class="qa-voting qa-voting-net" id="voting_111145" style="display:none">
                                <div class="qa-vote-buttons qa-vote-buttons-net" id="qa-btn">
                                    <!-- Up Vote -->
                                    <form action="{{url('/up-vote',[$questions->id,$answer->id])}}" method="POST" >
                                        @csrf
                                        <input type="hidden" id="question" value="{{ $questions->id }}">
                                        <input type="hidden" id="answer" value="{{ $answer->id }}">
                                        <input type="submit" value="+"  title="Click to vote up" class="qa-vote-first-button qa-vote-up-button btn btn-primary" style="font-size: 8px">
                                    </form>
                                    <!-- /End Up Vote -->
                                    <!-- Donw Vote -->
                                    <form method="POST" id="down-vote-form">
                                        @csrf
                                        <input type="hidden" id="question" value="{{ $questions->id }}">
                                        <input type="hidden" id="answer" value="{{ $answer->id }}">
                                        <input type="submit" value="–" title="Click to vote down" class="qa-vote-second-button qa-vote-down-button btn btn-danger"  style="font-size: 8px">
                                    </form>
                                    <!-- /End Donw Vote -->
                                </div>
                                <div class="qa-vote-count qa-vote-count-net">
                                    <span class="qa-netvote-count">
                                        <span class="qa-netvote-count-data" id="totalClicks" >{{ getCountVote($questions->id, $answer->id) }}</span><span class="qa-netvote-count-pad">
                                            votes</span>
                                    </span>
                                </div>
                                <div class="qa-vote-clear">
                                </div>
                            </div>

                        </div>
                    
                        <li class="list-group-item list-group-item-action m-2" aria-current="true" id="answers-list"
                            style="height: auto">
                            <div class="d-flex justify-content-between" style="width:auto">
                                <h6 class="mb-5" id="space-title"><span> {!! $answer->title_answer !!}</span></h6>
                            </div>
                            <div class="user">
                                <small style="margin-left: 74% ; margin-top:20px">Answered
                                    {{ date('d-M-Y', strtotime($answer->created_at)) }}</small>
                                <p style="float:right">Answer by <span style="margin-leflt"> {{ $answer->user->name }}</span></p>
                            </div>

                        </li>

                        @if ($answer->image)
                            <img src="{{ asset('images/' . $answer->image) }}" style="height:250px;"
                                alt="enter image description here">
                        @else
                            <span style="display: none">No image found!</span>
                        @endif
                    </div>
                @endforeach
                <form action="{{ route('question.answer', $questions->id) }}" method="POST" enctype="multipart/form-data"
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
                    {{-- <div class="mb-3">
                            <label class="form-label" for="inputImage">Image:</label>
                            <input type="file" name="image" class="form-control" multiple >
                          
                        </div>
                        <div class="mb-3">
                            <label class="video" for="video">Upload Video:</label>
                            <input type="file" name="video" id="video" class="form-control">
                        </div> --}}
                    {{-- <textarea class="form-control" name="title_answer" id="editor" placeholder="Answer..............">
                              
                        </textarea> --}}

                    <button type="submit" class="btn mt-3 btn-primary">Post Your Answer</button>
                </form>


            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        // ClassicEditor
        //     .create(document.querySelector('#editor'), {
        //         ckfinder: {
        //             uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        //             // uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',

        //         }
        //     })
        //     .then(editor => {
        //         console.log( 'Editor is ready to use!' );
        //     })

        //     .catch(error => {
        //         console.error(error);
        //     });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });

        // Up Vote without refreshing
        $('#up-vote-form').submit(function (e) {
            e.preventDefault();
            
            var question_id = $('input#question').val();
            var answer_id = $('input#answer').val();

            var url = "{{ route('vote', [":question_id", ":answer_id"]) }}";
            url = url.replace(':question_id', question_id).replace(':answer_id', answer_id);
            
            $.ajax({
                type: "POST",
                url: url,
                success: function(response) {
                    if (response.statusCode !== 200) {
                        alert(response.message);
                       // document.getElementById('span#totalClicks').style.backgroundColor = 'red';
                    }
                    $('span#totalClicks').html(response.vote_count);
                },
            });
        });
        
        // // Down Vote without refreshing
        // $('#down-vote-form').submit(function (e) {
        //     e.preventDefault();
            
        //     var question_id = $('input#question').val();
        //     var answer_id = $('input#answer').val();

        //     var url = "{{ route('down.vote', [":question_id", ":answer_id"]) }}";
        //     url = url.replace(':question_id', question_id).replace(':answer_id', answer_id);
            
        //     $.ajax({
        //         type: "POST",
        //         url: url,
        //         success: function(response) {
        //             if (response.statusCode !== 200) {
        //                 alert(response.message);
        //             }
        //             $('span#totalClicks').html(response.vote_count);
        //         },
        //     });
        // });
        
    </script>
@endsection
