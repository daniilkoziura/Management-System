<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meeting extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'title', 'date', 'description', 'manager_id', 'user_id', 'risk_status'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function addComment($request)
    {
        return $this->comments()->create([
            'text' => $request->text,
            'creator_id' => $request->user()->id,
        ]);
    }


}
