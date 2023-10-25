@extends('layouts.app')
@section('title', 'GameXChange | Insert New Game')
@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="fs-4" style="width: 40%">
        <h1 class="text-center">Add Game</h1>
        <form method="POST" action="{{ route('game.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column py-1 my-3">
                <label for="ddlDev">Choose developer:</label>
                <select id="ddlDev" class="rounded-3 bg-dark p-2 text-white" name="dev_id">
                    @foreach ($developer as $dev)
                        <option name='dev_id' value="{{ $dev->id }}">{{ $dev->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="tbName">Game Name</label>
                <input type="text" id="tbName" name="name" placeholder="" class="p-2 rounded-3 form-control bg-dark border-white text-white gray-placeholder">
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="tbDesc">Game Description</label>
                <input type="text" id="tbDesc" name="description" placeholder="" class="p-2 rounded-3 form-control bg-dark border-white text-white gray-placeholder">
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="tbPrice">Game Price</label>
                <input type="text" id="tbPrice" name="price" placeholder="" class="p-2 rounded-3 form-control bg-dark border-white text-white gray-placeholder">
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="fuImg">Game Image</label>
                <input type="file" id="fuImg" class="rounded-3 bg-darker" name="image">
            </div>
            <div class="text-center text-danger my-3 fw-bold">
                <!-- Display validation errors or success messages here -->
                @error('')
                    
                @enderror
            </div>
            <div class="d-flex flex-column py-1">
                <button type="submit" class="rounded-3 border-0 w-25 m-auto py-2 bg-body-tertiary" type="submit">Insert</button>
            </div>
        </form>
    </div>
</div>
@endsection
