<div class="container px-6 mx-auto grid">
    <div class="my-6 flex justify-between items-center">
        <h2
            class="text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Bought Lands
        </h2>

        <a
            href="{{route('boughtlands.index')}}"
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            aria-label="Edit"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </a>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">Document</th>
                    <th class="px-4 py-3">Plot</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Issue At</th>
                    <th class="px-4 py-3">Created At</th>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <a class="text-blue-500 hover:text-blue-600"
                           href="{{route('documents.show',['document' => $sold->document->id])}}">{{$sold->document->no}}
                            - {{$sold->document->owner}}</a>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a class="text-blue-500 hover:text-blue-600" href="{{route('plots.show',['plot' => $sold->plot->id])}}">{{$sold->plot->no}}
                            - {{$sold->plot->name}}</a>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{$sold->amount}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        {{$sold->issued_at}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        {{$sold->created_at->diffForHumans()}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

