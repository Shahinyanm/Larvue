<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use VotableTrait;

    public $timestamps = false;
    protected $fillable = ['title', 'body'];
    protected $appends = ['created_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

//    public function setBodyAttribute($value)
//    {
//        $this->attributes['body'] = clean($value);
//    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->id);
    }

    public function getCreatedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered_accept";
            }
            return "answered";
        } else {
            return "unanswered";
        }

    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count','DESC')->with('user');
    }

    public function getBodyHtmlAttribute()
    {
        return clean($this->bodyHtml());
    }

    public function acceptBestAnswer($answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'question_id', 'user_id')->withTimestamps();
    }

    public function isFavorite()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorite();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }


    public function getExcerptAttribute(){
       return $this->excerpt(250);
    }

    private function bodyHtml(){
        return \Parsedown::instance()->text($this->body);
    }

    public function excerpt($length){
        return str_limit(strip_tags($this->bodyHtml()),$length);
    }
}
