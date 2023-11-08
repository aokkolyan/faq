@extends('layouts.admin')
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
    </style>
    <div class="row">
        <div class="col-md-1 p-3  text-black">
            <dl>
                
                <dt>Home</dt><br>
                <dt>Public</dt>
            </dl>

        </div>
        <div class="col-md-8 p-3  text-black">
            @if (Route::has('login'))
                @auth
                    <a class="float-end btn btn-primary" href="{{ route('question') }} " data-bs-toggle="modal"
                        data-bs-target="#myModal" aria-disabled="true">Ask question</a>
                @else
                    <div class="alert alert-danger">
                        <p>Please login first to ask question!!</p>
                    </div>
                @endauth
            @endif

            {{-- Import users form --}}
            <form action="{{route('users.import')}}" method="POST" enctype="multipart/form-data"  style="display: none">
                @csrf
                <input type="file" name="file" class="form-control" >
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
            <p><strong>{{ $questions->count() }}</strong> questions
            <h5 class="qa-main-heading">All Questions</h5>
            </p>


            @foreach ($questions as $item)
                {{-- @dd($item) --}}

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
                                    <span class="qa-netvote-count-data" >0</span><span class="qa-netvote-count-pad">
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
                                <a href="/question/viewquestion/{{ $item->id }}" class="s-link"
                                    target="blink">-{{ $item->question_title }}</a>

                            </h5>
                        </li>
                        <p style="font-size: 13px;font-family:sans-serif">{{ $item->description }}</p>
                        <p style="float:right;font-size:12px;cursor: pointer;">Q2A by <span
                                style="color:rgba(10,114,170,255);font-weight:bold">{{ $item->question->name }}</span></p>
                        {{-- <hr style="2px solid balck; border-radius: 5px; "> --}}
                    </ol>

                </div>
            @endforeach
            {{-- {!! $questions->appends(Request::all())->links() !!} --}}
            {{-- {{ $questions->withQueryString()->links() }} --}}
            <div class="d-flex">
                {!! $questions->links() !!}
            </div>
        </div>
        <div class="col-md-3 p-3  text-black" id="productlist">
            <form action="{{ url('/question/search') }}" method="GET" class="d-flex" role="search" >
                @csrf
                <input class="form-control me-2" name="search" type="text" placeholder="Search" value="{{request()->get('search')}}"
                 autocomplete="off"   aria-label="Search">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form><br>
            <a class="product inherits-color block flex-1" id="product">
                <div class="panel relative transition-colors duration-300 dark  text-white bg-panel-800 hover:bg-panel-700 rounded-xl mx-auto px-px py-px text-center"
                    style="height: 210px; background: linear-gradient(148deg, rgb(33, 200, 246) -11%, rgba(33, 200, 246, 0) 42%); max-width: 450px;">
                    <div class="flex h-full flex-col justify-between gap-y-4 rounded-2xl px-5 py-4 items-center"
                        style="background-image: radial-gradient(circle at 0% 2%, rgb(0, 117, 255), rgb(31, 64, 106) 100%);">
                        <div class="flex flex-col items-center">
                            <div class="flex-1"><img loading="lazy" class="lazy absolute left-0 lazyloaded"
                                    aria-hidden=""><img loading="lazy" class="lazy absolute top-0 right-0 lazyloaded">
                                <h5
                                    class="-mt-1 text-left font-semibold leading-tight tracking-normal text-white w-[65%] text-sm xl:text-xl">
                                    Welcome to the Q&A site for <span class="text-blue-light">Question2Answer.</span></h5>
                                <p class="mt-7 text-white text-2xs"> If you have a question about Q2A, please</p>
                                <h5
                                    class="-mt-1 text-left font-semibold leading-tight tracking-normal text-white w-[65%] text-sm xl:text-xl">
                                    If you just want to try Q2A, please use the demo site <span
                                        class="text-blue-light">Laracasts</span></h5>
                                <p class="mt-7 text-white text-2xs"> To report a bug, please create a new issue on Github or
                                    ask a question here with the bug tag</p>
                                <h5
                                    class="-mt-1 text-left font-semibold leading-tight tracking-normal text-white w-[65%] text-sm xl:text-xl">
                                    Level Up Your Programming with <span class="text-blue-light">Laracasts</span></h5>
                                <p class="mt-7 text-white text-2xs"> a month for everything we know about programming.
                                    Everything!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="qa-activity-count">
                <p class="qa-activity-count-item">
                <span class="qa-activity-count-data">16.2k</span> questions
                </p>
                <p class="qa-activity-count-item">
                <span class="qa-activity-count-data">16.1k</span> answers
                </p>
                <p class="qa-activity-count-item">
                <span class="qa-activity-count-data">33.9k</span> comments
                </p>
                <p class="qa-activity-count-item">
                <span class="qa-activity-count-data">767k</span> users
                </p>
                </div>
        </div>


    </div>
@endsection
@section('script')
    <script>
      $(document).ready(function (){
        $("#up_voes").click(function (e){
           alert (" Hello World");
        });
      });
    </script>
@endsection
