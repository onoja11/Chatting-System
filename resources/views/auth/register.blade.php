<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="department" :value="__('Department')" />
            
            <select type="text" name="department" id="department" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"  >
                <option value="" hidden></option>
            @foreach ($departments as $department)
            <option value="{{ $department }} "> {{ $department }} </option>
        @endforeach
            </select>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>

        <!-- University id -->
        <div class="mt-4">
            <x-input-label for="university_id" :value="__('University Id Number')" />
            
            <x-text-input id="university_id" class="block mt-1 w-full"
            type="text"
            name="university_id" />
            <x-input-error :messages="$errors->get('university_id')" class="mt-2" />
            </div>

             <!-- level -->
        <div class="mt-4">
            <x-input-label for="level" :value="__('Level')" />
            
            <select type="text" name="level" id="level" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"  >
                <option value="" hidden></option>
            @foreach ($levels as $level)
            <option value="{{ $level }} "> {{ $level }} </option>
        @endforeach
            </select>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>

            <!-- Profile pic -->
            <div class="mt-4">
                <x-input-label for="profile_pic" :value="__('Profile pic')" />
    
                <x-text-input id="profile_pic" class="block mt-1 w-full"
                                type="file"
                                name="profile_pic"
                                 accept="image/*"  />
    
                <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
            </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
                
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
