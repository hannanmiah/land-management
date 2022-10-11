<div class="container px-6 mx-auto mb-6 grid">
    <div class="my-6 flex justify-between items-center">
        <h2
            class="text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Create Document
        </h2>

        <a
            href="{{route('documents.index')}}"
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            aria-label="Edit"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </a>
    </div>
    <form class="flex flex-col space-y-2 md:space-y-4" enctype="multipart/form-data" wire:submit.prevent="submit">
        <div class="form-group">
            <label class="block text-sm" for="no">
                <span class="text-gray-700 dark:text-gray-400">No.</span>
            </label>
            <input
                id="no"
                wire:model="no"
                class="form-control"
                placeholder="Enter Document Number"
            />
            @error('no') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="amount">
                <span class="text-gray-700 dark:text-gray-400">Amount</span>
            </label>
            <input
                id="amount"
                wire:model="amount"
                class="form-control"
                placeholder="Enter amount"
            />
            @error('amount') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="owner">
                <span class="text-gray-700 dark:text-gray-400">Owner</span>
            </label>
            <input
                id="owner"
                wire:model="owner"
                class="form-control"
                placeholder="Enter Owner name"
            />
            @error('owner') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="additional">
                <span class="text-gray-700 dark:text-gray-400">Addition Information</span>
            </label>
            <textarea
                id="additional"
                wire:model="additional"
                class="form-control"
                rows="3"
                placeholder="Enter some long form content."
            ></textarea>
        </div>
        <div class="form-group">
            <label class="block text-sm" for="files">
                <span class="text-gray-700 dark:text-gray-400">Files:</span>
            </label>
            <input wire:model="files" id="files" type="file"
                   class="block w-full text-sm text-slate-500 dark:file:text-white dark:file:bg-purple-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
                   multiple/>
            @error('files.*') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="active" class="inline-flex relative items-center cursor-pointer">
                <input wire:model="active" type="checkbox" value="1" id="active" class="sr-only peer">
                <div
                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Activate</span>
            </label>
        </div>
        <button
            type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            Submit
        </button>
    </form>
</div>
