@extends('layouts.app')

@section('content')
<div class="container">
    <h1>購入確認</h1>
    @if(count($cartItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price']) }}円</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity']) }}円</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <p><strong>合計金額: {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems))) }}円</strong></p>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">購入を確定する</button>
            </form>
        </div>
    @else
        <p>カートが空です。</p>
    @endif
</div>
@endsection