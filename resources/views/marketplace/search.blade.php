<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('MarketplaceDashboard') }}
        </h2>
    </x-slot>

    <div class="sm:fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 top-28 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        <div class="relative hidden md:block w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
        <div class="w-full border-l h-full relative overflow-y-auto" style="contain: content">
            <div class="m-auto text-center justify-content flex flex-col gap-3">

                <!-- Search Bar -->
                <header class="px-3 z-10 bg-white sticky top-0 w-full py-2">
                    <form action="{{ route('search.page') }}" method="GET">
                    <div class="border-b justify-between flex items-center pb-2">
                        <div class="flex items-center gap-2 w-full">
                            <input
                                type="text"
                                name="search"
                                placeholder="Search for a book, assignment, note, or project..."
                                class="w-full border rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-700"
                            />
                        </div>
                    </div>
                </form>
                <!-- Horizontal Sliding Categories -->
                <div class="flex overflow-x-auto gap-2 sticky py-3 px-4 border-b bg-gray-100">
                    @forelse($categories as $category)
                    {{-- <button class="bg-blue-500 text-white px-1 py-2 rounded-md shadow hover:bg-blue-600"> --}}
                        <form action="{{ route('search.page') }}" method="GET">
                            <input
                            type="text"
                            hidden
                            value="{{$category->title}}"
                            name="search"
                            placeholder="Search for a book, assignment, note, or project..."
                            />
                            {{-- <button class="bg-blue-500 text-white px-1 py-2 rounded-md shadow hover:bg-blue-600">
                                        {{$category->title}}
                                    </button> --}}
                                    <x-primary-button>                                  
                                              {{$category->title}}
                                    </x-primary-button>
                        </form>
                    @empty
                    @endforelse
                    @forelse($courses as $course)
                    <form action="{{ route('search.page') }}" method="GET">
                        <input
                        type="text"
                        hidden
                        value="{{$course->course_code}}"
                        name="search"
                        placeholder="Search for a book, assignment, note, or project..."
                        />
                        {{-- <button class="bg-blue-500 text-white px-1 py-2 rounded-md shadow hover:bg-blue-600">
                            {{$course->course_code}}
                                </button> --}}
                                <x-primary-button>
                                    {{$course->course_code}}
                                </x-primary-button>
                    </form>
                    @empty
                    @endforelse
                </div>
                </header>


                <!-- Cards Section -->
                <div class="p-4 space-y-8 relative">
                    <a href="{{route('marketplace.shop')}}" class="">
                        <x-secondary-button class="absolute left-4">Back</x-secondary-button>
                    </a>
            

                    <!-- Notes -->
                    <div>
                        <h3 class=" font-extrabold text-2xl text-center mb-4">STORE</h3>
                        <h5 class="font-bold">Results on : {{ $search }}</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 relative gap-4">
                            @forelse($books as $book)
                                <div class="border rounded-lg p-4 shado hover:shadow-lg">
                                    <h4 class="text-md font-semibold">{{$book->title}} </h4>
                                    <p class="text-sm text-gray-600">{{$book->description}}</p>
                                    <p class="text-sm text-gray-500 mt-2">{{$book->price}} Naira</p>
                                    <div class="flex justify-around mt-4">
                                        {{-- <button class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
                                            Buy
                                        </button> --}}
                                        <x-primary-button>Buy</x-primary-button>
                                        <a href="{{route('watch')}}" class="">
                                            <x-secondary-button>Watch Ads</x-secondary-button>
                                        </a>
                                    </div>
                                </div>
                            @empty
                            <div class=" md:w-[820px] mt-10 ">
                                <img src="{{ asset('images/Binary code.gif') }}" alt="" width="180" height="" class="m-auto">
                            <p class="text-red-800 font-serif text-lg ">
                            Not Found.
                            </p>                               
                            </div>
                            @endforelse
                        </div>
                        <div class="col-12 text-left block mt-2">
                            {!! $books->links('pagination::tailwind') !!}    
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
