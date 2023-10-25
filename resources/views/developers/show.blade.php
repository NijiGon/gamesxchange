@extends('layouts.app')
@section('title', 'GameXChange | ' . $developer->name)
@section('content')
    <div class="container bg-darker d-flex py-5 px-5" style="margin-top:8vh; min-height:100vh;">
        {{-- Image Container --}}
        <div class="me-5" style="max-width:25%; min-width:25%">
            {{-- Image --}}
            <img src="{{ asset('Asset/developers/' . $developer->image) }}" class="w-100 rounded-3" alt="Alternate Text" />

            <div class="d-flex justify-content-center flex-column align-items-center mt-3">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('developer.edit', $developer->id) }}" class="mb-3 fs-4 hover-effect rounded-3 border-0 w-100 text-center m-auto py-2 bg-warning w-100">Edit</a>
                        <form method="post" action="{{ route('developer.delete', $developer->id) }}" class="w-100">
                            @csrf
                            @method('delete')
                            <button type="submit" class="mb-3 fs-4 hover-effect rounded-3 border-0 w-25 m-auto py-2 bg-danger w-100">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Info Container --}}
        <div class="d-flex flex-column justify-content-between">
            <div>
                {{-- Developer Name --}}
                <h1>{{ $developer->name }}</h1>

                {{-- Developer Description --}}
                <p>{{ $developer->description }}</p>

                {{-- Games List by Developer --}}
                <h2>Games by {{ $developer->name }}</h2>

                <div class="row">
                    @foreach($games as $g)
                        <div class="col-4">
                            <div class="card my-3 text-white shadow hover-effect" style="width: 16rem; background-color: #2e2e2e">
                                <img src="{{ asset('Asset/games/' . $g->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">{{ $g->name }}</h5>
                                        <div class="d-flex" style="min-width: 3rem">
                                            @php
                                                $averageRating = optional($g->ratings->first())->average_rating ?? 0;
                                            @endphp
                                            <i class="bi bi-star-fill" style="">{{ number_format($averageRating, 2) }}</i>
                                        </div>
                                    </div>
                                    <p class="card-text">Rp.{{ number_format($g->price, 0, '.', ',') }}</p>
                                    <a href="{{ route('game.show', ['id' => $g->id]) }}" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
