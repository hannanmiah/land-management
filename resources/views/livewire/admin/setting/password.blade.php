<div class="container px-6 mx-auto grid">
    <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Change Password
    </h2>
    <div>
        <form wire:submit.prevent="submit" class="flex flex-col space-y-4 md:space-y-8">
            <div class="form-group">
                <label for="password" class="dark:text-white">New Password</label>
                <input wire:model="password" id="password" type="password" class="form-control">
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="dark:text-white">Confirm Password</label>
                <input wire:model="password_confirmation" id="password" type="password" class="form-control">
                @error('password_confirmation')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 p-2 rounded-md text-white">Submit</button>
        </form>
    </div>
</div>

