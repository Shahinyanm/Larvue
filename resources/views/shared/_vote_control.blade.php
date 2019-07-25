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
    </form>@can('accept',$model)
        <a title="Mark this answer as best Answer"
           class="{{$model->status}}  mt-2 text-center"
           onclick="event.preventDefault(); document.getElementById('accept-answer-{{$model->id}}').submit()">
            <i class="fas fa-check"></i>
        </a>
        <form id="accept-answer-{{$model->id}}"
              action="{{route('answers.accept',$model->id)}}" style="display:none"
              method="POST">
            @csrf
        </form>
    @else
        @if($model->is_best)
            <a title="The question owner accepted this answer as the best."
               class="{{$model->status}}  mt-2 text-center"
               onclick="event.preventDefault(); document.getElementById('accept-answer-{{$model->id}}').submit()">
                <i class="fas fa-check"></i>
            </a>
        @endif
    @endcan
</div>