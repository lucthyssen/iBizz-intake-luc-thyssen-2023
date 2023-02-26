@php
    $public = 'http://127.0.0.1:8000/';
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>//iBizz</title>

    {{-- front-end stack --}}
    <link rel="stylesheet" href="{{ $public }}css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    {{-- buttons to reset DB and generate flights --}}
    <div class="buttons">
        
        {{-- form to reset the database --}}
        <form action="{{ route('reset') }}" method="POST" class="reset-form">
            @csrf
            <button type="submit" class="btn btn-primary">Reset database</button>
        </form>
        <br>
        {{-- form to generate flights --}}
        <form action="{{ route('generateFlights') }}" method="POST" class="generate-btn">
            @csrf
            <button type="submit" class="btn btn-primary">Maak flights</button>
        </form>
    </div>

    <div class="container">
        <div class="spelers">
            <h2>Alle spelers:</h2>
            <ul class="list-group player-list">
                {{-- loop through all players --}}
                @foreach ($spelers as $speler)
                    <li class="list-group-item">
                        <span>{{ $speler->name }}</span> -
                        <span>{{ $speler->handicap }}</span> -
                        <span>{{ $speler->gender }}</span>

                        {{-- form to delete player --}}
                        <form action="{{ route('deleteSpeler', $speler->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            {{-- form to add a new player --}}
            <div class="new-player">
                <h2>Voeg spelers toe:</h2>
                <form action="{{ route('addSpeler') }}" class="new-player-form" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Naam">
                    <input type="number" name="handicap" placeholder="Handicap" step="0.1" min="18.4"
                        max="44">
                    <select name="gender" id="gender">
                        <option value="man" selected>man</option>
                        <option value="vrouw">vrouw</option>
                    </select>
                    <button type="submit">Toevoegen</button>
                </form>
            </div>
        </div>
        <div class="flights">
            <h2>Alle flights:</h2>
            {{-- table for all flights --}}
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Flight</th>
                        <th scope="col">Gebruiker</th>
                        <th scope="col">Handicap</th>
                        <th scope="col">Flight gemiddelde</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flights as $flight)
                        <tr>
                            <td>{{ $flight->flight_id }}</td>
                            <td>{{ $flight->name }}</td>
                            <td>{{ $flight->handicap }}</td>
                            <td>{{ $flight->average }}</td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
</body>

</html>
