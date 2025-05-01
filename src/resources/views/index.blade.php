@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品一覧</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>説明</th>
                <th>在庫数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100px;">
                    </a>
                    @else
                    <span>画像なし</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }}円</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach ($products as $product)
<!-- モーダルウィンドウ -->
<div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3">
                <p>{{ $product->description }}</p>
                <p>価格: {{ $product->price }}円</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">カートに追加</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
