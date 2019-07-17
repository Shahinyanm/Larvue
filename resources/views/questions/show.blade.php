@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3>{{$question->title}}</h3>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all
                                    Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls mr-4">
                            <a title="This question is useful " class="vote-up text-center">
                                <i class="fas fa-caret-up"></i>
                            </a>
                            <span class="votes-count text-center">1230</span>
                            <a title="This question is not useful" class="vote=down off text-center">
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <a title="Click to mark as Favorite(Click again to undo" class="favorites">
                                <i class="fas fa-star"></i>
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                        <div class="media-body">
                            <h5>{!!  $question->body_html !!}</h5>
                            <div class="float-right">
                                <span class="text-muted">Answered {{$question->created_date}}</span>
                                <div class="media">
                                    <a href="{{$question->user->url}}" class="pr-2">
                                        <img src="{{$question->user->avatar}}" alt="{{$question->user->name}}">
                                    </a>
                                    <div class="media-body mt-2">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{ $question->answers_count.' '. Str::plural('answer',$question->answers_count) }}</h2>
                        </div>
                        <hr>
                        @foreach($question->answers as $answer)
                            <div class="media">

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
    </div>
@endsection
