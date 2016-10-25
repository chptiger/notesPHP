<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'note','user_id'
    ];

    public function user() {
        return $this->belongsToMany('App\User');
    }
}
