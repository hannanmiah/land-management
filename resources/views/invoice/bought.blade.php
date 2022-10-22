@extends('layouts.invoice')
@section('content')
    <h2>Bought Lands</h2>
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Document</th>
                <th>Amount</th>
                <th>Remaining Amount</th>
                <th>Issue Date</th>
            </tr>
            @forelse($boughts as $bought)
                <tr>
                    <td>{{$boughts->firstItem()+$loop->index}}</td>
                    <td>{{$bought->document->owner}}</td>
                    <td>{{$bought->amount}}</td>
                    <td>{{$bought->remaining}}</td>
                    <td>{{$bought->issued_at}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
