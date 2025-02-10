<div>
    <x-secondary-button 
    class="hover:shadow-lg"
    x-on:click.prevent="$dispatch('open-modal', 'upload-book')"
    >Upload</x-secondary-button>

    <x-modal name="upload-book" focusable>
        <form class="p-6">
          

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Upload') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you upload a file here it will be accessible by everybody in our shop') }}
            </p>

            <div class="mt-4">
                <x-input-label for="title" value="{{ __('Title') }}" class="sr-only" />

                <x-text-input
                    id="title"
                    wire:model="title"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Title') }}"
                />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

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

                <select id="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-3/4" wire:model="category"  required >
                    <option value="" class="text-gray-400">Category</option>
                    @foreach ($categories as $category) 
                    <option value="{{ $category->id }}"> {{ $category->title }} </option>
                 @endforeach
                </select>

                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="file" value="{{ __('File') }}" class="sr-only" />

                <x-text-input
                    id="file"
                    wire:model="file"
                    type="file"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('File') }}"
                />

                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>

            <div class="mt-4">
                <x-input-label for="price" value="{{ __('Price') }}" class="sr-only" />

                <x-text-input
                    id="price"
                    wire:model="price"
                    type="number"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Price') }}"
                />

                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-success-button class="ms-3 bg-indigo-700 hover:bg-indigo-600 focus:bg-indigo-800 active:bg-indigo-700 dark:focus:ring-indigo-500" wire:click.prevent="createUpload">
                    Save
                    <span wire:loading class="w-8 h-8  border-4 border-dashed rounded-full animate-spin border-white"></span>
                </x-success-button>
            </div>
        </form>
    </x-modal>
</div>
