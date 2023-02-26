<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Monolog\Formatter\GoogleCloudLoggingFormatter;
use DB;

class flights extends Model
{
    use HasFactory;
    protected $table = 'flights';
    public $timestamps = false;

    // set properties for the players class
    protected $fillable = ['flight_id', 'user_id', 'handicap', 'average'];

    // function to generate a flight
    function getFlights(array $golfers): array
    {
        $flights = [];

        // sort golfers based on handicap
        usort($golfers, function ($a, $b) {
            return $a->handicap <=> $b->handicap;
        });

        // check amount of golfers (less than 4 is not possible)
        if (count($golfers) > 4) {
            
            // check if the amount of golfers is divisible by 4
            if (count($golfers) % 4 == 0 || count($golfers) % 4 == 2 || count($golfers) % 4 == 3) {

                // calculate amount of flights
                $aantalFlights = count($golfers) / 4;
                // ceil flights up
                $aantalFlights = ceil($aantalFlights);

                // make flights array
                for ($i = 0; $i < $aantalFlights; $i++) {
                    $flights[$i] = [];
                }

                // get count of golfers
                $aantalGolfers = count($golfers);

                // get count of flights
                $aantalFlights = count($flights);

                // while there are golfers left in the golfers array
                while ($aantalGolfers != 0) {

                    // loop thrgough each flight and add the best and worst golfer to the flight
                    for ($i = 0; $i < $aantalFlights; $i++) {

                        // add best golfer to flight
                        $flights[$i][] = array_shift($golfers);
                        $aantalGolfers = count($golfers);
                        if (count($golfers) == 0) {
                            break;
                        }

                        // add worst golfer to flight
                        $flights[$i][] = array_pop($golfers);
                        $aantalGolfers = count($golfers);
                        if (count($golfers) == 0) {
                            break;
                        }
                    }
                }

                // insert flights into database
                flights::insertFlightsIntoDB($flights);
                return $flights;

                // flights returnen
                return $flights;

            } elseif (count($golfers) % 3 == 0 || count($golfers) % 3 == 2) {

                // calculate amount of flights
                $aantalFlights = count($golfers) / 3;

                // ceil flights up
                $aantalFlights = ceil($aantalFlights);

                // make flights array
                for ($i = 0; $i < $aantalFlights; $i++) {
                    $flights[$i] = [];
                }

                // get count of golfers
                $aantalGolfers = count($golfers);

                // get count of flights
                $aantalFlights = count($flights);

                // while there are golfers left in the golfers array
                while ($aantalGolfers != 0) {

                    // loop thrgough each flight and add the best and worst golfer to the flight
                    for ($i = 0; $i < $aantalFlights; $i++) {

                        // add best golfer to flight
                        $flights[$i][] = array_shift($golfers);
                        $aantalGolfers = count($golfers);
                        if (count($golfers) == 0) {
                            break;
                        }
                        // add worst golfer to flight
                        $flights[$i][] = array_pop($golfers);
                        $aantalGolfers = count($golfers);
                        if (count($golfers) == 0) {
                            break;
                        }
                    }
                }

                // insert flights into database
                flights::insertFlightsIntoDB($flights);
                return $flights;
            } 
            else {
                // ongelukkig getal, zoals 13. Hiermee kan je (in dit stysteem) geen flights maken.
                return $flights;
            }
        } else {
            // verkeerd aantal spelers om een flight te maken op de manier welke hierboven word gebruikt (te weinig)
            return $flights;
        }
    }

    // function to insert flights into the database
    function insertFlightsIntoDB(array $flights)
    {
        // insert flights into database
        $flight_id = 1;
        foreach ($flights as $flight) {
            foreach ($flight as $golfer) {
                flights::create([
                    'flight_id' => $flight_id,
                    'user_id' => $golfer->id,
                    'handicap' => $golfer->handicap,
                ]);
            }
            $flight_id++;
        }

        // calculate average handicap for each flight
        $flight_id = 1;
        foreach ($flights as $flight) {
            $averageHandicap = DB::table('flights')
                ->select(DB::raw('AVG(handicap) as average_handicap'))
                ->where('flight_id', $flight_id)
                ->groupBy('flight_id')
                ->first();

            $averageHandicap = $averageHandicap->average_handicap;
            $averageHandicap = round($averageHandicap, 1);

            // update average handicap in flights table
            DB::table('flights')
                ->where('flight_id', $flight_id)
                ->update(['average' => $averageHandicap]);

            $flight_id++;
        }
    }

    // function to get all flights
    function getAllFlights()
    {
        // get all flights
        $flights = flights::leftJoin('players', 'flights.user_id', '=', 'players.id')
            ->select('flights.*', 'players.name')
            ->orderBy('flights.flight_id')
            ->get();

        // make array of flights
        $flightsArray = [];
        foreach ($flights as $flight) {
            $flightsArray[] = $flight;
        }

        return $flightsArray;
    }
}
