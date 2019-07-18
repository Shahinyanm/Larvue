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
                            <a title="Mark this answer as best Answer" class="vote-accepted mt-2 text-center">
                                <i class="fas fa-check"></i>

                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="float-right">
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
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>