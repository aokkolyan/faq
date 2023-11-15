
    {{-- <div class="col-md-6 p-3  text-black">
        @if (Route::has('login'))
          @auth
          <a class="float-end btn btn-primary" href="{{ route('question') }} "  data-bs-toggle="modal"
          data-bs-target="#myModal" aria-disabled="true">Ask question</a>
          @else
            <p>Please login first to ask question!!</p>
          @endauth
        @endif
        <h3>All Questions</h3>
            <p><strong>234</strong> questions
            </p>
            @foreach ($questions as $item)
            /question/viewquestion/{{$item->id}}
                <h5 class="s-post-summary--content-title"> 
                 <a href="/question/viewquestion/{{$item->id}}" class="s-link">-{{ $item->question_title }}</a></h5>
                <p style="font-size: 13px;font-family:sans-serif">{{$item->description}}</p>
             <hr style="2px solid balck; border-radius: 5px; ">
            @endforeach     
    </div> --}}
 