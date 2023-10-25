@extends('layouts.app')
@section('title', 'GameXChange | Transaction Details')
@section('content')
<div class="container w-50 d-flex align-items-center justify-content-center fs-4" style="min-height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Game</th>
                    <th scope="col">Developer</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($details as $td)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td><a href="{{ route('game.show', ['id' => $td->game_id]) }}">{{ $td->game->name }}</a></td>
                    <td><a href="{{ route('developer.show', ['id' => $td->game->dev_id]) }}">{{ $td->game->developer->name }}</a></td>
                    <td>{{ $td->quantity }}</td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection