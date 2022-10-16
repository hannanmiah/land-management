<div class="container px-6 mx-auto grid">
    <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Change Photo
    </h2>
    <div
        class="mx-auto w-1/2 border p-2 md:p-4 rounded-md flex flex-col justify-center items-center space-y-2 md:space-y-4 lg:space-y-8">
        @if($photo)
            <img class="w-48 h-48" src="{{ $photo->temporaryUrl() }}" alt="photo">
        @elseif($user->photo)
            <img class="w-48 h-48" src="{{ \Illuminate\Support\Facades\Storage::disk('photos')->url($user->photo) }}"
                 alt="photo">
        @else
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-48 h-48 fill-gray-200" viewBox="0 0 16 16">
                <path
                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            </svg>
        @endif
        <form wire:submit.prevent="submit" class="flex flex-col space-y-4 md:space-y-8">
            <div class="form-group">
                <label class="block text-sm" for="photo">
                    <span class="text-gray-700 dark:text-gray-400">Photo:</span>
                </label>
                <input id="photo" type="file"
                       wire:model="photo"
                       accept="image/jpeg"
                       class="block w-full text-sm text-slate-500 dark:file:text-white dark:file:bg-purple-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 p-2 rounded-md text-white">Upload</button>
        </form>
    </div>
</div>

