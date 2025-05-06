@extends('layouts.app')

@section('content')
<div class="container">
    <h1>カート一覧</h1>
    @if (count($cartItems) > 0)
        <table class="table table-striped">
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
            <p>合計金額: {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems))) }}円</p>
        </div>
        <div class="text-end mt-4">
            <a href="{{ route('checkout') }}" class="btn btn-success">購入へ進む</a>
        </div>

    @else
        <p>カートに商品がありません。</p>
    @endif
</div>
@endsection