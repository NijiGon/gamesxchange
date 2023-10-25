@extends('layouts.app')
@section('title', 'GameXChange | Insert New Developer')
@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="fs-4" style="width: 40%">
        <h1 class="text-center">Add Developer</h1>

        <form method="POST" action="{{ route('developer.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="d-flex flex-column py-1 my-3">
                <label for="tbName">Developer Name</label>
                <input type="text" id="tbName" name="name" placeholder="" class="p-2 rounded-3 form-control bg-dark border-white text-white gray-placeholder">
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="tbDesc">Developer Description</label>
                <input type="text" id="tbDesc" name="description" placeholder="" class="p-2 rounded-3 form-control bg-dark border-white text-white gray-placeholder">
            </div>
            <div class="d-flex flex-column py-1 my-3">
                <label for="fuImg">Developer Image</label>
                <input type="file" id="fuImg" name="image" class="rounded-3 bg-darker">
            </div>
            <div class="text-center text-danger my-3 fw-bold">
                <label id="lbError"></label>
            </div>
            <div class="d-flex flex-column py-1">
                <button id="btnInsert" class="rounded-3 border-0 w-25 m-auto py-2 bg-body-tertiary" type="submit">Insert</button>
            </div>
        </form>
    </div>
</div>
@endsection
