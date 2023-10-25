@extends('layouts.app')
@section('title', 'GameXChange | Edit Game Info')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh">
    <div class="shadow rounded-4 w-50 d-flex align-items-center justify-content-center mt-5" style="background-color:#1c1c1c; min-height: 350px;">
        <form method="POST" action="{{ route('game.update', ['id' => $game->id]) }}" enctype="multipart/form-data" class="profile-info ms-5 w-100 py-5 me-5">
            <div>
                @csrf
                @method('PATCH')
                <div class="input-group mb-3 d-flex flex-column">
                    <label for="ddlDev" class="text-white">Choose developer:</label>
                    <select name='dev_id' id="ddlDev" class="form-select rounded-3 bg-dark p-2 text-white w-100">
                        @foreach($developers as $dev)
                            <option name='dev_id' value="{{ $dev->id }}">{{ $dev->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-grayish border-2" id="basic-addon1">Game Title</span>
                    <input type="text" name='name' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="" value='{{ old('title', $game->name) }}' aria-label="Username" aria-describedby="basic-addon1" id="tbName">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-grayish border-2" id="basic-addon1">Game Description</span>
                    <input type="text" name='description' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="" value='{{ old('description', $game->description) }}' aria-label="Username" aria-describedby="basic-addon1" id="tbDesc">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-grayish border-2" id="basic-addon1">Game Price</span>
                    <input type="text" name='price' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="" value='{{ old('price', $game->price) }}' aria-label="Username" aria-describedby="basic-addon1" id="tbPrice">
                </div>
                <div class="input-group mb-3 d-flex flex-column">
                    <label for="fuImg"  class="text-white">Upload game image file:</label>
                    <input type="file" name='image' id="fuImg" class="form-control bg-darker rounded w-100" value='{{ old('image', $game->image) }}'>
                </div>
                <div class="input-group mb-3">
                    <label id="lbError" class="text-white"></label>
                </div>
            </div>
            @error('dev_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div>
                <button id="btnSave" class="btn btn-secondary rounded" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
