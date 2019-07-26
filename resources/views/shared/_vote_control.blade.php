<div class="d-flex flex-column vote-controls mr-4">
    <a title="This answer is useful " class="vote-up {{Auth::guest()? 'off':''}} text-center"
       onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{$answer->id}}').submit();"
    >

        <i class="fas fa-caret-up"></i>
    </a>
    <form id="vote-up-answer-{{$model->id}}"
          action="/answers/{{$model->id}}/vote" style="display:none"
          method="POST">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count text-center">{{$model->votes_count}}</span>
    <a title="This Answer is not useful" class="vote-down {{Auth::guest()? 'off':''}} text-center"
       onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{$model->id}}').submit();"
    >
        <i class="fas fa-caret-down"></i>
    </a>
    <form id="vote-down-answer-{{$model->id}}"
          action="/answers/{{$model->id}}/vote" style="display:none"
          method="POST">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
 <accept :answer="{{$model}}"></accept>
</div>