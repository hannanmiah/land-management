@extends('layouts.invoice')
@section('content')
    <h2>Projects</h2>
    <div class="table-container">
        <table class="table-rwd">
            <tr>
                <th>SI</th>
                <th>Name</th>
                <th>Location</th>
                <th>Plots</th>
                <th>Total</th>
            </tr>
            @forelse($projects as $project)
                <tr>
                    <td>{{$projects->firstItem()+$loop->index}}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->location}}</td>
                    <td>
                        <ul class="inline-flex flex-col space-y-1 md:space-y-2">
                            @forelse($project->plots as $plot)
                                <li>
                                    {{$plot->name}} ({{$plot->amount}})
                                </li>
                            @empty
                                <li>Empty!</li>
                            @endforelse
                        </ul>
                    </td>
                    <td>{{$project->plots->sum('amount')}}</td>
                </tr>
            @empty
                <tr>
                    <td>Empty!</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
