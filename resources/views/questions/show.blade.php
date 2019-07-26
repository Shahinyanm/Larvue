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
                    <div class="media m-2">

                        <div class="d-flex flex-column vote-controls mr-4">
                            <a title="This question is useful " class="vote-up {{Auth::guest()? 'off':''}} text-center"
                                onclick="event.preventDefault(); document.getElementById('vote-up-question-{{$question->id}}').submit();"
                            >

                                <i class="fas fa-caret-up"></i>
                            </a>
                            <form id="vote-up-question-{{$question->id}}"
                                  action="/questions/{{$question->id}}/vote" style="display:none"
                                  method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count text-center">{{$question->votes_count}}</span>
                            <a title="This question is not useful" class="vote-down {{Auth::guest()? 'off':''}} text-center"
                               onclick="event.preventDefault(); document.getElementById('vote-down-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <form id="vote-down-question-{{$question->id}}"
                                  action="/questions/{{$question->id}}/vote" style="display:none"
                                  method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                        <favorite :question="{{$question}}"></favorite>
                        </div>
                        <div class="media-body">
                            <h5>{!!  $question->body_html !!}</h5>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="{{$question}}" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('answers._index',[
        'answersCount'=>$question->answers_count,
        'answers' => $question->answers
        ])
        @include('answers._create')
    </div>
@endsection
