@extends('layouts.app')
@section('title', 'GameXChange | Edit Developer Info')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh">
    <div class="shadow rounded-4 w-50 d-flex align-items-center justify-content-center mt-5" style="background-color: #1c1c1c; min-height: 350px;">
        <form method="POST" action="{{ route('developer.update', ['id' => $developer->id]) }}" enctype="multipart/form-data" class="profile-info ms-5 w-100 py-5 me-5">
            <div>
                @csrf
                @method('PATCH')
                <div class="input-group mb-3">
                    <span class="input-group-text bg-grayish border-2" id="basic-addon1">Developer Name</span>
                    <input type="text" class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" name="name" value="{{ old('title', $developer->name) }}" aria-label="Username" aria-describedby="basic-addon1" id="tbName">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-grayish border-2" id="basic-addon1">Developer Description</span>
                    <input type="text" class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" name="description" value="{{ old('title', $developer->description) }}" aria-label="Username" aria-describedby="basic-addon1" id="tbDesc">
                </div>
                <div class="input-group mb-3 d-flex flex-column">
                    <label for="fuImg">Upload game image file:</label>
                    <input type="file" id="fuImg" name="image" class="form-control rounded bg-darker w-100">
                </div>
                <div class="input-group mb-3">
                    <span id="lbError"></span>
                </div>
            </div>
            <div style="">
                <button id="btnSave" class="rounded btn btn-secondary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection