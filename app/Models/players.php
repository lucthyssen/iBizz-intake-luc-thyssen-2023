<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class players extends Model
{
    use HasFactory;
    protected $table = 'players';
    public $timestamps = false;

    // set properties for the players class
    protected $fillable = [
        'name',
        'name',
        'handicap'
    ];
    
    // function to get the name of the player
    public function getName()
    {
        return $this->name;
    }

    // function to get the handicap of the player
    public function getHandicap()
    {
        return $this->handicap;
    }

    // function to set the handicap of the player
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;
    }    

    // function to get all the players
    public function getAllPlayers()
    {
        $players = players::all();
        return $players;
    }
}
