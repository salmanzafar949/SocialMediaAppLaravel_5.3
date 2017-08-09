<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = ['location','about','user_id'];

    // Setting up a RelationShip with User table
    // As user can have only one profile

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
