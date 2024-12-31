<div>
    <!-- Trigger Button -->
    {{-- <x-secondary-button wire:click="$set('isOpen', true)">
        Create Class
    </x-secondary-button> --}}
    <x-secondary-button 
    class="hover:shadow-lg "
    x-on:click.prevent="$dispatch('open-modal', 'create-classroom')"
    >Create Class</x-secondary-button>

    <x-modal name="create-classroom" focusable>
        <form class="p-6">
          

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create ClassRoom') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you create a classroom here it will be accessible by everybody in your department and level') }}
            </p>

            <div class="mt-4">
                <x-input-label for="course_title" value="{{ __('Course Title') }}" class="sr-only" />

                <x-text-input
                    id="course_title"
                    wire:model="course_title"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Course Title') }}"
                />

                <x-input-error :messages="$errors->get('course_title')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="course_code" value="{{ __('Course Code') }}" class="sr-only" />

                <x-text-input
                    id="course_code"
                    wire:model="course_code"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Course Code') }}"
                />

                <x-input-error :messages="$errors->get('course_code')" class="mt-2" />
                </div>

            <div class="mt-4">
                {{-- <x-input-label for="category" value="{{ __('Category') }}" class="sr-only" /> --}}

        
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-indigo-700 hover:bg-indigo-600 focus:bg-indigo-800 active:bg-indigo-700 dark:focus:ring-indigo-500" wire:click.prevent="createClassroom">
                    Save
                    <span wire:loading class="w-8 h-8  border-4 border-dashed rounded-full animate-spin border-white"></span>
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <!-- Modal -->
 
</div>
