<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait;
    protected $fillable = ['body', 'user_id'];
    protected $appends =['created_date'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($answer) {
            $answer->question->increment('answers_count');
//            $answer->question->save();
        });

        static::deleted(function ($answer) {
            $question = $answer->question;
            $question->decrement('answers_count');
            if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }

//            $answer->question->save();
        });

    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function getCreatedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest(){
        return $this->id === $this->question->best_answer_id ;
    }


}
