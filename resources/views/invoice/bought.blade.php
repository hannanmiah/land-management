@extends('layouts.invoice')
@section('content')
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
                <th class="px-4 py-3">Document</th>
                <th class="px-4 py-3">Amount</th>
                <th class="px-4 py-3">Remaining Amount</th>
                <th class="px-4 py-3">Issue At</th>
            </tr>
            </thead>
            <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
            >
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                    xx
                </td>
                <td class="px-4 py-3 text-sm">
                    xx
                </td>
                <td class="px-4 py-3 text-sm">
                    xxx
                <td class="px-4 py-3 text-xs">
                    xxxx
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
