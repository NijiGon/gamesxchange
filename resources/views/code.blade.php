@extends('layouts.app')
@section('title', 'GameXChange | Redeem Codes')
@section('content')

    <div class="container d-flex flex-column align-items-center justify-content-around" style="min-height: 100vh;">
        <div class="d-flex flex-column align-items-center justify-content-center">
            {{-- @php $j = 0 @endphp --}}
            @foreach($details as $td)
                @for ($i = 0; $i < $td->quantity; $i++)
                    <div class="d-flex flex-column py-4 px-2 rounded-3 mb-3 bg-darker text-center justify-content-center align-content-center" style="min-width: 25vw;">
                        <h5 class="mb-0">Code for {{ $td->Game->name }}</h5>
                        <p class="mb-0">{{ generateRandomString() }}</p>
                    </div>
                    {{-- @php $j++ @endphp --}}
                @endfor
            @endforeach
        </div>
    </div>
@endsection
