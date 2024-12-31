<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('MarketplaceDashboard') }}
        </h2>
    </x-slot>

    <div class="sm:fixed  h-full flex border  bg-white lg:shadow-lg overflow-hidden inset-0 top-28  lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        <div class="relative hidden md:block w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
        <div class="w-full border-l  h-full  overflow-y-auto  bg-white" style="contain: content">
            <div class="flex justify-between sticky top-0 bg-white mb-4 shadow-lg p-3">
                <h3 class="text-lg font-semibold">Books/Files</h3>
                <!-- Add button triggers modal -->
                <div class="flex gap-2">
                    <livewire:marketplace-upload/>                                
                </div>
                
            </div>
            <livewire:add-category />                             

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mx-4">
                @forelse ($books as $book) {{-- Static loop for 5 cards --}}
                <div class="border rounded-lg p-4 shadow hover:shadow-lg">
                    <h4 class="font-semibold text-gray-800"> {{ $book->title }}</h4>
                    <p class="text-sm text-gray-600 mt-2">
                        Description: {{ $book->description }}
                    </p>
                    <p class="text-sm text-gray-600">Price: {{ $book->price }} Naira</p>
                    <p class="text-sm text-gray-600">Updated: {{ $book->updated_at->format('d M, Y H:i') }}</p>
                    <p class="text-sm text-gray-600">Purchased: {{ $book->number_purchased }}</p>
                    <div class="flex justify-end gap-2 mt-4">
                        <a wire:click="$set('isOpen', true)" href="{{route("books.edit", $book->id) }}" >
                        <x-success-button>
                                Edit
                        </x-success-button>                           
                    </a>   

                        {{-- <form action="{{ route('books.destroy', $book->id) }} " method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                Delete
                            </button>
                        </form> --}}
                        <a href="{{ route('books.destroy', $book->id) }}"  data-confirm-delete="true">
                            <x-danger-button>
                                Delete
                            </x-danger-button>                            
                        </a>
                    </div>
                </div>
                @empty
                <div class=" lg:w-[800px] mt-10    ">
                    <img src="{{ asset('images/Empty.gif') }}" alt="" width="300" height=""
                        class="m-auto">
                    <p class="text-red-800 font-serif text-xl mt-3 col-span-3 text-center">
                        No files available.
                    </p>
                </div>
                {{-- <p class="col-span-3 text-center text-gray-500">No files available.</p> --}}
                @endforelse
            </div>
            <div class="col-12 text-left mt-4 mx-4">
                {!! $books->links('pagination::tailwind') !!}    
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    {{-- <div 
        x-data="{ openAddModal: false }"
        x-show="openAddModal" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        x-cloak
    >
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold text-gray-800">Add Book/File</h2>
                <button @click="openAddModal = false" class="text-gray-500 hover:text-gray-800">
                    &#x2715;
                </button>
            </div>
            <form class="mt-4">
                <div class="mb-4">
                    <label for="file-name" class="block text-sm font-medium text-gray-700">File Name</label>
                    <input type="text" id="file-name" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" rows="3" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                    <input type="file" id="file" class="w-full border-gray-300 rounded-lg mt-1">
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" @click="openAddModal = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div> --}}


    

    <!-- Include Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
