@extends('layouts.invoice')
@section('content')
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Number</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Project</th>
                <th>Document</th>
            </tr>
            @forelse($plots as $plot)
                <tr>
                    <td>{{$plots->firstItem()+$loop->index}}</td>
                    <td>{{$plot->no}}</td>
                    <td>{{$plot->name}}</td>
                    <td>{{$plot->amount}}</td>
                    <td>{{$plot->project->name}}</td>
                    <td>{{$plot->document->no}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
