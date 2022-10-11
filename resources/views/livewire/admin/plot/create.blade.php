<div class="container px-6 mx-auto mb-6 grid">
    <div class="my-6 flex justify-between items-center">
        <h2
            class="text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Create Plot
        </h2>

        <a
            href="{{route('plots.index')}}"
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            aria-label="Edit"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </a>
    </div>
    <form wire:submit.prevent="submit" class="flex flex-col space-y-2 md:space-y-4" enctype="multipart/form-data">
        <div class="form-group">
            <label class="block text-sm" for="no">
                <span class="text-gray-700 dark:text-gray-400">No.</span>
            </label>
            <input
                id="no"
                wire:model="no"
                class="form-control"
                placeholder="Enter Plot Number"
            />
            @error('no') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="name">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
            </label>
            <input
                id="name"
                wire:model="name"
                class="form-control"
                placeholder="Enter Plot Name"
            />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="amount">
                <span class="text-gray-700 dark:text-gray-400">Amount</span>
            </label>
            <input
                id="amount"
                wire:model="amount"
                class="form-control"
                placeholder="Enter land amount"
            />
            @error('amount') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="project">
                <span class="text-gray-700 dark:text-gray-400">Project</span>
            </label>
            <select
                id="project"
                wire:model="project"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            >
                <option value="">Select a project</option>
                @forelse($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                @empty
                    <option value="">No projects</option>
                @endforelse
            </select>
            @error('project') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="document">
                <span class="text-gray-700 dark:text-gray-400">Document</span>
            </label>
            <select
                id="document"
                wire:model="document"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            >
                <option value="">Select document</option>
                @forelse($documents as $document)
                    <option value="{{$document->id}}">{{$document->no}} : {{$document->owner}}</option>
                @empty
                    <option value="">No document</option>
                @endforelse
            </select>
            @error('document') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button
            type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            Submit
        </button>
    </form>
</div>

