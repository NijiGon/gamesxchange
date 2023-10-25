@extends('layouts.app')
@section('title', 'GameXChange | View Games List')
@section('content')
<div class="container" style="min-height: 100vh; margin-top: 10vh">
    <h1>Game List</h1>
    <div class="d-flex">
        <div class="bg-darker rounded-3 shadow h-25 py-4 px-3 w-100" style="max-width: 15vw; min-width: 15vw;">
            <h3 class="text-center border-bottom border-2 pb-2">Filters</h3>
            <form method="get" action="{{ route('games') }}" class="mb-4">
                <div class="mt-4">
                    <h5>Enter Min. Price</h5>
                    <div class="input-group">
                        <input type="text" class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="e.g. 20000" name="min" value="{{ request('min') }}">
                        <span class="input-group-text bg-grayish border-2" id="basic-addon1">
                            <button type="submit" class="rounded-3 border-0 m-auto bg-grayish">Filter</button>
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <h5>Enter Max Price</h5>
                    <div class="input-group">
                        <input type="text" class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="e.g. 200000" name="max" value="{{ request('max') }}">
                        <span class="input-group-text bg-grayish border-2" id="basic-addon2">
                            <button type="submit" class="rounded-3 border-0 m-auto bg-grayish">Filter</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="ms-4">
            <div class="w-25">
                <div class="dropdown">
                    <button class="btn dropdown-toggle border-2 border-white text-center text-white w-50" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort By</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('games', ['min' => $min, 'max' => $max, 'type' => 'price', 'sort' => 'desc']) }}">Highest Price</a></li>
                        <li><a class="dropdown-item" href="{{ route('games', ['min' => $min, 'max' => $max, 'type' => 'price', 'sort' => 'asc']) }}">Lowest Price</a></li>
                        <li><a class="dropdown-item" href="{{ route('games', ['min' => $min, 'max' => $max, 'type' => 'ratings', 'sort' => 'desc']) }}">Highest Rated</a></li>
                        <li><a class="dropdown-item" href="{{ route('games', ['min' => $min, 'max' => $max, 'type' => 'name', 'sort' => 'asc']) }}">A - Z</a></li>
                        <li><a class="dropdown-item" href="{{ route('games', ['min' => $min, 'max' => $max, 'type' => 'name', 'sort' => 'desc']) }}">Z - A</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <div>
                    <div class="row my-3">
                        @foreach($games as $g)
                        <div class="col-3">
                            <div class="card my-3 text-white shadow hover-effect" style="width: 14rem; height: auto; background-color: #2e2e2e">
                                <img src="{{ asset('Asset/games/' . $g->image) }}" class="card-img top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $g->name }}</h5>
                                    <p class="card-text">Rp.{{ number_format($g->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('game.show', ['id' => $g->id]) }}" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Find the buttons and input fields
        const btnMin = document.getElementById('btnMin');
        const btnMax = document.getElementById('btnMax');
        const tbMin = document.getElementById('tbMin');
        const tbMax = document.getElementById('tbMax');

        // Initialize the Bootstrap dropdown
        new bootstrap.Dropdown(document.querySelector('.dropdown'));
        
        // Attach click event listeners to the buttons
        btnMin.addEventListener('click', function () {
            // Get the value from the Min Price input field
            const minPrice = tbMin.value;
            // You can use 'minPrice' here for filtering or send it to the server
            console.log('Min Price:', minPrice);
        });

        btnMax.addEventListener('click', function () {
            // Get the value from the Max Price input field
            const maxPrice = tbMax.value;
            // You can use 'maxPrice' here for filtering or send it to the server
            console.log('Max Price:', maxPrice);
        });
    });
</script>
@endsection