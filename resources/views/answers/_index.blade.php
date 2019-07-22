<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount.' '. Str::plural('answer',$answersCount) }}</h2>
                </div>
                <hr>
                @include('_partials.message')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls mr-4">
                            <a title="This answer is useful " class="vote-up {{Auth::guest()? 'off':''}} text-center"
                               onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{$answer->id}}').submit();"
                            >

                                <i class="fas fa-caret-up"></i>
                            </a>
                            <form id="vote-up-answer-{{$answer->id}}"
                                  action="/answers/{{$answer->id}}/vote" style="display:none"
                                  method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count text-center">{{$answer->votes_count}}</span>
                            <a title="This Answer is not useful" class="vote-down {{Auth::guest()? 'off':''}} text-center"
                               onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <form id="vote-down-answer-{{$answer->id}}"
                                  action="/answers/{{$answer->id}}/vote" style="display:none"
                                  method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>@can('accept',$answer)
                                <a title="Mark this answer as best Answer"
                                   class="{{$answer->status}}  mt-2 text-center"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()">
                                    <i class="fas fa-check"></i>
                                </a>
                                <form id="accept-answer-{{$answer->id}}"
                                      action="{{route('answers.accept',$answer->id)}}" style="display:none"
                                      method="POST">
                                    @csrf
                                </form>
                                @else
                                @if($answer->is_best)
                                    <a title="The question owner accepted this answer as the best."
                                       class="{{$answer->status}}  mt-2 text-center"
                                       onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer)
                                            <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}"
                                               class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete',$answer)
                                            <form action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}"
                                                  method="POST" class="form-delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>

                                <div class="col-4">
                                   @include('shared._author',[
                                   'model'=>$answer,
                                   'label'=>'answered'])
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>