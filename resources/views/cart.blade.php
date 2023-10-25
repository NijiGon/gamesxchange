@extends('layouts.app')
@section('title', 'GameXChange | View Cart Items')
@section('content')
<div class="container w-50 d-flex align-items-center justify-content-center fs-4" style="min-height:100vh">
    <div class="d-flex flex-column justify-content-center align-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Game</th>
                    <th scope="col">Developer</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($carts as $c)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $c->Game->name }}</td>
                    <td>{{ $c->Game->Developer->name }}</td>
                    <td>{{ $c->quantity }}</td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
        @if (count($carts) > 0)
        <div class="d-flex flex-column align-items-end">
            <form action="{{ route('carts.delete') }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="rounded-3 border-0 fs-5 ms-auto py-1 bg-danger" id="btnRemove">Empty</button>
            </form>
        </div>
        @endif
        <div class="d-flex justify-content-between" class="">
            @if ($carts != null)
            <form class="w-100 align-items-center" action="{{ route('transaction.store', ['carts' => $carts]) }}" method="post">
                @csrf
                <div class="d-flex flex-column mt-3 me-3 fs-5 align-items-center">
                    <label for="ddlPlatform">Choose a platform</label>
                    <select id="ddlPlatform" name="platform_id" class="rounded-2 bg-dark text-white w-100" name="ddlPlatform">
                        @foreach ($platforms as $p)
                            <option name='platform_id' value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column mt-3 me-3 fs-5 align-items-center">
                    <label for="ddlMethod">Choose a payment method</label>
                    <select id="ddlMethod" name="method_id" class="rounded-2 bg-dark text-white w-100" name="ddlMethod">
                        @foreach ($methods as $m)
                            <option name='method_id' value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-end mt-4 fs-5">
                    <div class="ms-auto d-flex flex-column">
                        <button type="submit" class="rounded-3 border-0 py-2 px-3 bg-body-tertiary" id="btnCheckout">Checkout</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
