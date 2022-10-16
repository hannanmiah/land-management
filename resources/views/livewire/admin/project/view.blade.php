<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            {{$project->name}}
        </h2>
        <section class="print:hidden inline-flex space-x-2">
            <button
                x-on:click="printPage"
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                aria-label="pdf"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-200 dark:fill-white"
                     viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
            <a
                href="{{route('projects.create')}}"
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                aria-label="Edit"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
        </section>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap print:border">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Plots</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Location</th>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 print:border">
                        {{$project->name}}
                    </td>
                    <td class="px-4 py-3 text-sm print:border">
                        <ul class="inline-flex flex-col space-y-2">
                            @forelse($project->plots as $plot)
                                <li class=""><a class="text-blue-500 hover:text-blue-600"
                                                              href="{{route('plots.show',['plot' => $plot->id])}}">{{$plot->name}}
                                        ({{$plot->amount}})</a></li>
                            @empty
                                <li>No plots</li>
                            @endforelse
                        </ul>
                    </td>
                    <td class="px-4 py-3 text-xs print:border">
                        {{$project->plots->pluck('amount')->reduce(fn($c,$i) => $c+$i,0)}}
                    </td>
                    <td class="px-4 py-3 text-sm print:border">
                        {{$project->location}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
