@extends('layouts.app')
@section('title', 'GameXChange | @' . auth()->user()->name)
@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh; margin-top:5vh">
        <div class="shadow rounded-4 w-50 d-flex align-items-center justify-content-center mt-5" style="background-color:#1c1c1c; min-height: 350px;">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-info ms-5 w-100 py-5 me-5">
                <div>
                    @csrf
                    @method('PATCH')
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-grayish border-2" id="basic-addon1" for='tbName'>Username</span>
                        <input id='tbName' type="text" name='name' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="{{ $user->name }}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-grayish border-2" id="basic-addon1" for='tbEmail'>Email</span>
                        <input id='tbEmail' type="text" name='email' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="{{ $user->email }}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-grayish border-2" id="basic-addon1" for='tbPassword'>Password</span>
                        <input id='tbPassword' type="password" name='password' class="form-control bg-grayeesh border-2 gray-placeholder text-primary text-white" placeholder="{{ str_repeat('*', 8) }}" >
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div style="">
                    <button id="btnSave" class="rounded btn btn-secondary" style="" type="submit" >Update Profile</button>
                    <button id="btnLogout" class="rounded btn btn-danger" onclick="logout()">Logout</button>
                </div>
            </form>
        </div>
        <div class="mt-4 w-50">
            <h3 class="border-bottom border-2 py-3">Your Reviews</h3>
            @foreach ($reviews as $r)
                <div class="px-3 shadow py-3 d-flex flex-column justify-content-between my-3 bg-darkish rounded-3">
                    <div>
                        <h4 class="mb-0">{{ $r->user->username }}</h4>
                        <p class="mt-0 fs-6">Commenting on <a href="{{ route('game.show', ['id' => $r->game_id]) }}">{{ $r->game->name }}</a></p>
                        <div>
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $r->rating)
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p style="margin: 0;" class="fs-4">{{ $r->comment }}</p>
                </div>
            @endforeach
            @if ($reviews->isEmpty())
                <div class="d-flex justify-content-center align-items-center" style="min-height:300px;">
                    <p>Nothing to see here...</p>
                </div>
            @endif
        </div>
    </div>
    <script>

        function logout() {
            // Redirect to the logout route
            window.location.href = "{{ route('logout') }}";
        }
    </script>
@endsection
