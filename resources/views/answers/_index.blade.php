@if($answersCount >0)
<div class="row mt-4" v-cloak>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount.' '. Str::plural('answer',$answersCount) }}</h2>
                </div>
                <hr>
                @include('_partials.message')
                @foreach($answers as $answer)
                    @include('answers._answer')
                @endforeach
            </div>
        </div>
    </div>
</div>
    @endif