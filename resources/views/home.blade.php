@extends('layouts.app')
@section('title', 'GameXChange | Home')
@section('content')
    <div class="container d-flex flex-column px-2 py-1 mb-5" style="margin-top:10vh;">
        <div class="">
            <h1>Top Rated Games</h1>
            <div class="row border-top border-white border-2 pt-3">
                @php $i = 0 @endphp
                @foreach($games as $g)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card my-3 text-white shadow hover-effect" style="width: 18rem; background-color: #2e2e2e">
                        <img src="../Asset/games/{{ $g->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $g->name }}</h5>
                                <div class="d-flex" style="min-width: 3rem">
                                    {{-- <i class="bi bi-star-fill"> {{ $ratings[$g->Id] }}</i> --}}
                                    @php
                                        // Assuming you have a Game model instance called $game
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
                @php $i++ @endphp
                @if ($i >= 8) @break @endif
                @endforeach
            </div>
        </div>

        <div class="">
            <h1>Top Developers</h1>
            <div class="row border-top border-white border-2 pt-3">
                @php $j = 0 @endphp
                @foreach($developers as $d)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card my-3 text-white shadow hover-effect" style="width: 18rem; background-color: #2e2e2e">
                        <img src="../Asset/developers/{{ $d->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $d->name }}</h5>
                            <a href="{{ route('developer.show', ['id' => $d->id]) }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>
                </div>
                @php $j++ @endphp
                @if ($j >= 8) @break @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
