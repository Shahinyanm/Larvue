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
                            <a title="This question is useful " class="vote-up text-center">
                                <i class="fas fa-caret-up"></i>
                            </a>
                            <span class="votes-count text-center">1230</span>
                            <a title="This question is not useful" class="vote-down off text-center">
                                <i class="fas fa-caret-down"></i>
                            </a>
                            @can('accept',$answer)
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
                                    <span class="text-muted">Answered {{$answer->created_date}}</span>
                                    <div class="media">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{$answer->user->avatar}}" alt="{{$answer->user->name}}">
                                        </a>
                                        <div class="media-body mt-2">
                                            <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                    </div>
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