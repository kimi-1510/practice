@extends('layouts.app')

@section('content')
    <h2>注文履歴</h2>
    <table>
        <thead>
            <tr>
                <th>注文ID</th>
                <th>合計金額</th>
                <th>ステータス</th>
                <th>注文日時</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->total_price) }}円</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>