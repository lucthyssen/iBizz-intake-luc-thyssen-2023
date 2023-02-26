<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\players;
use App\Models\flights;

class flightController extends Controller
{
    public function index()
    {
        // check amount of players in database
        $players = players::getAllPlayers();

        // get all flights from database
        $flights = flights::getAllFlights();

        return view('home', [
            'spelers' => $players,
            'flights' => $flights,
        ]);
    }

    // make new players in database
    public function addPlayer(Request $request)
    {
        $player = new players();
        $player->name = $request->name;
        $player->handicap = $request->handicap;
        $player->gender = $request->gender;
        $player->save();
        return redirect()->route('home');
    }

    // delete players using model
    public function delete($id)
    {
        $player = players::find($id);
        $player->delete();
        return redirect()->route('home');
    }

    // generate flights
    public function generate()
    {
        // truncate all old flights
        flights::truncate();

        // get all players from database
        $players = players::getAllPlayers();

        // place players in array
        $playerArray = [];
        foreach ($players as $player) {
            $playerArray[] = $player;
        }

        // send array to model function
        $flights = flights::getFlights($playerArray);

        // back to home page
        return redirect()->route('home');
    }

    // reset database to default
    public function reset()
    {
        // empty all tables
        players::truncate();
        flights::truncate();

        $people = [['name' => 'Arno', 'geslacht' => 'man', 'handicap' => 22.8], ['name' => 'George', 'geslacht' => 'man', 'handicap' => 25.5], ['name' => 'Michiel', 'geslacht' => 'man', 'handicap' => 24.6], ['name' => 'Peter', 'geslacht' => 'man', 'handicap' => 23.8], ['name' => 'Sylvia', 'geslacht' => 'vrouw', 'handicap' => 29.2], ['name' => 'Jan', 'geslacht' => 'man', 'handicap' => 26.5], ['name' => 'Bram', 'geslacht' => 'man', 'handicap' => 23.2], ['name' => 'Ruud', 'geslacht' => 'man', 'handicap' => 44.0], ['name' => 'Leon', 'geslacht' => 'man', 'handicap' => 18.4], ['name' => 'Bart', 'geslacht' => 'man', 'handicap' => 24.9], ['name' => 'Ornella', 'geslacht' => 'vrouw', 'handicap' => 39.0]];

        // loop through array and make new players
        foreach ($people as $player) {
            $newPlayer = new players();
            $newPlayer->name = $player['name'];
            $newPlayer->gender = $player['geslacht'];
            $newPlayer->handicap = $player['handicap'];
            $newPlayer->save();
        }

        return redirect()->route('home');
    }
}
