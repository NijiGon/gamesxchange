@extends('layouts.app')
@section('title', 'GameXChange | Transaction History')
@section('content')
    <div class="container w-50 d-flex justify-content-center fs-4" style="min-height: 100vh;">
        <div class="d-flex flex-column justify-content-center align-content-center" style="margin: 14vh 14vh;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Transaction Date</th>
                        <th scope="col">Platform</th>
                        <th scope="col">Method</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($headers as $th)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>
                                <a style="text-decoration: underline !important;" href="{{ route('detail', ['id' => $th->id]) }}">
                                    {{ $th->transaction_date }}
                                </a>
                            </td>
                            <td>{{ $th->platform->name }}</td>
                            <td>{{ $th->method->name }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
