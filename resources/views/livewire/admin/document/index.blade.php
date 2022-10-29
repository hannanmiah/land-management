<div class="container px-6 mx-auto grid">
    @if (session()->has('message'))
        <div class="mt-6 relative print:hidden" x-data="{show: true}" x-show="show">
            <div class="p-2 md:p-4 bg-green-500 text-gray-500 text-center rounded-md border-gray-500">
                {{ session('message') }}
            </div>
            <button x-on:click="show = false" class="absolute -top-2 -right-2 hover:border rounded-full duration-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 fill-red-500 hover:fill-red-600" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </button>
        </div>
    @endif
    <div class="my-6 flex justify-between items-center">
        <h2
            class="text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Documents
        </h2>

        <section class="print:hidden inline-flex space-x-2">
            <a
                href="{{route('invoices.document',['page' => $documents->currentPage()])}}"
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                aria-label="pdf"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-200 dark:fill-white"
                     viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
            <a
                href="{{route('documents.create')}}"
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
                    <th class="px-4 py-3">S.I</th>
                    <th class="px-4 py-3">Document</th>
                    <th class="px-4 py-3">Mutation</th>
                    <th class="px-4 py-3">Owner</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Remaining</th>
                    <th class="px-4 py-3 print:hidden">Status</th>
                    <th class="px-4 py-3">Additional</th>
                    <th class="px-4 py-3 print:hidden">Files</th>
                    <th class="px-4 py-3 print:hidden">Actions</th>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @forelse($documents as $document)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 print:border">
                            {{$documents->firstItem()+$loop->index}}
                        </td>
                        <td class="px-4 py-3 print:border">
                            {{str($document->no)->before('_')}}
                        </td>
                        <td class="px-4 py-3 print:border">
                            {{str($document->no)->after('_')}}
                        </td>
                        <td class="px-4 py-3 text-sm print:border">
                            {{$document->owner}}
                        </td>
                        <td class="px-4 py-3 text-xs print:border">
                            {{$document->amount}}
                        </td>
                        <td class="px-4 py-3 text-xs print:border">
                            {{$this->remaining($document->id)}}
                        </td>
                        <td class="px-4 py-3 text-xs print:hidden">
                            @if($document->active == 1)
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                >
                            Active
                            </span>
                            @else
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700"
                                >
                          Inactive
                        </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm bangla print:border">
                            {{$document->additional}}
                        </td>
                        <td class="px-4 py-3 text-sm print:hidden">
                            <ul class="flex flex-col space-y-2">
                                @forelse(json_decode($document->files) as $file)
                                    <li>
                                        <button class="text-blue-500 hover:text-blue-600"
                                                wire:click="export('{{$file->url}}')">{{$file->name}}</button>
                                    </li>
                                @empty
                                    <li>No file</li>
                                @endforelse
                            </ul>
                        </td>
                        <td class="px-4 py-3 print:hidden">
                            <div class="flex items-center space-x-4 text-sm">
                                <a
                                    href="{{route('documents.edit',['document' => $document->id])}}"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                        ></path>
                                    </svg>
                                </a>
                                <button
                                    x-on:click="destroy('{{$document->id}}')"
                                    class="hidden flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <div>Empty!</div>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $documents->links() }}

    @push('scripts')
        <script>
            function destroy(id) {
                Swal.fire({
                    title: 'Are you sure to delete?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    denyButtonText: `Don't delete`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Livewire.emit('destroyed', id)
                        Swal.fire('Deleted successfully', '', 'success')
                        Livewire.emit('$refresh')
                    } else if (result.isDenied) {
                        Swal.fire('Not deleted!', '', 'info')
                    }
                })
            }
        </script>
    @endpush
</div>
