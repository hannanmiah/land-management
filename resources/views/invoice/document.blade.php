@extends('layouts.invoice')
@section('content')
    <h2>Documents</h2>
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Document</th>
                <th>Mutation</th>
                <th>Owner</th>
                <th>Amount</th>
                <th>Remaining</th>
                <th>Additional</th>
            </tr>
            @forelse($documents as $document)
                <tr>
                    <td>{{$documents->firstItem()+$loop->index}}</td>
                    <td>{{str($document->no)->before('_')}}</td>
                    <td>{{str($document->no)->after('_')}}</td>
                    <td>{{$document->owner}}</td>
                    <td>{{$document->amount}}</td>
                    <td>{{$document->remaining}}</td>
                    <td class="bangla">{{$document->additional}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
