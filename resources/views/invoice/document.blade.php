@extends('layouts.invoice')
@section('content')
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Document</th>
                <th>Mutation</th>
                <th>Owner</th>
                <th>Amount</th>
                <th>Remaining</th>
            </tr>
            @forelse($documents as $document)
                <tr>
                    <td>{{$documents->firstItem()+$loop->index}}</td>
                    <td>{{str($document->no)->before('_')}}</td>
                    <td>{{str($document->no)->after('_')}}</td>
                    <td>{{$document->owner}}</td>
                    <td>{{$document->amount}}</td>
                    <td>{{$document->remaining}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
