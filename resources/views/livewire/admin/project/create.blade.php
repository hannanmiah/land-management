<div class="container px-6 mx-auto mb-6 grid">
    <div class="my-6 flex justify-between items-center">
        <h2
            class="text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Create Project
        </h2>

        <a
            href="{{route('projects.index')}}"
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
                <span class="text-gray-700 dark:text-gray-400">Name</span>
            </label>
            <input
                id="name"
                wire:model="name"
                class="form-control"
                placeholder="Enter Project Name"
            />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm" for="location">
                <span class="text-gray-700 dark:text-gray-400">Location</span>
            </label>
            <input
                id="location"
                wire:model="location"
                class="form-control"
                placeholder="Enter Project Location"
            />
        </div>
        <div class="form-group">
            <label class="block text-sm" for="photo">
                <span class="text-gray-700 dark:text-gray-400">Photo:</span>
            </label>
            <input id="photo" type="file"
                   wire:model="photo"
                   class="block w-full text-sm text-slate-500 dark:file:text-white dark:file:bg-purple-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
            @error('photo') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button
            type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            Submit
        </button>
    </form>
</div>

