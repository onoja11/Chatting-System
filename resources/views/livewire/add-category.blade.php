<div>
  
    <x-primary-button 
    class="hover:shadow-lg m-4"
    x-on:click.prevent="$dispatch('open-modal', 'add-category')"
    >Add Category</x-primary-button>

    <x-modal name="add-category" focusable>
        <form class="p-6">
          

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Upload') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you upload a file here it will be accessible by everybody in our shop') }}
            </p>

            <div class="mt-4">
                <x-input-label for="name" value="{{ __('Category Name') }}" class="sr-only" />

                <x-text-input
                    id="name"
                    wire:model="name"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Category Name') }}"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="description" value="{{ __('Category Description') }}" class="sr-only" />

                <x-text-input
                    id="description"
                    wire:model="description"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Description') }}"
                />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="category" value="{{ __('Category') }}" class="sr-only" />

        
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-indigo-700 hover:bg-indigo-600 focus:bg-indigo-800 active:bg-indigo-700 dark:focus:ring-indigo-500" wire:click.prevent="createCategory">
                    Save
                    <span wire:loading class="w-8 h-8  border-4 border-dashed rounded-full animate-spin border-white"></span>
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    <!-- Modal -->
    
</div>
