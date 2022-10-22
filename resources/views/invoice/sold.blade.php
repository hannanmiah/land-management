@extends('layouts.invoice')
@section('content')
    <h2>Sold Lands</h2>
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Document</th>
                <th>Amount</th>
                <th>Plot</th>
                <th>Statement No.</th>
                <th>Issue Date</th>
            </tr>
            @forelse($solds as $sold)
                <tr>
                    <td>{{$solds->firstItem()+$loop->index}}</td>
                    <td>{{$sold->plot->document->no}} - {{$sold->plot->document->owner}}</td>
                    <td>{{$sold->amount}}</td>
                    <td>{{$sold->plot->name}}</td>
                    <td>{{$sold->statement_no}}</td>
                    <td>{{$sold->issued_at}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
