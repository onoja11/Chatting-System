<div x-data="{ isSidebarOpen: false }" class="h-full  flex flex-col">
    <!-- Header with Hamburger Button -->
    {{-- <header class="px-3 z-10 bg-white sticky top-0 w-full py-2 lg:hidden">
        <div class="border-b justify-between flex items-center pb-2">
            <div class="flex items-center gap-2">
                <h5 class="font-extrabold text-2xl">Classmeet</h5>
            </div>
            <!-- Hamburger Button -->
            <button 
                @click="isSidebarOpen = !isSidebarOpen" 
                class="p-2 focus:outline-none text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-7 h-7" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
    </header> --}}

    <!-- Sidebar -->
    <div class="">       
        <!-- Sidebar content -->
        <header class="px-3 z-10 bg-white sticky top-0 w-full py-2">
            <div class="border-b justify-between flex items-center pb-2">
                <div class="flex items-center gap-2">
                    <h5 class="font-extrabold text-2xl">Classmeet</h5>
                </div>
            </div>
        </header>

        <main class="overflow-y-scroll  grow h-full relative" style="contain:content">
            <ul class="p-2 grid w-full space-y-2">
                <!-- Home List Item -->
                <li class="py-3 {{ request()->is('dashboard') ? 'bg-gray-600/70' : '' }} rounded-2xl transition-colors duration-150 flex gap-4 relative w-full cursor-pointer px-2">
                    <a href="{{ route('dashboard') }}" class="shrink-0">
                    </a>
                    <aside class="grid grid-cols-12 w-full">
                        <a href="{{ route('dashboard') }}" class="col-span-11 border-b pb-2 border-gray-200 overflow-hidden truncate leading-5 w-full p-1">
                            <div class="flex justify-between w-full items-center">
                                <h6 class="truncate font-medium text-gray-900 flex gap-6"> 
                                    <i class="fa-solid fa-house"></i> 
                                    <strong>Home</strong> 
                                </h6>
                            </div>
                        </a>
                    </aside>
                </li>

                <!-- Courses Dropdown -->
                <li x-data="{ isOpen: false }" class="py-3 rounded-2xl transition-colors duration-150 flex flex-col relative w-full cursor-pointer px-2">
                    <div class="flex items-center justify-between px-2" @click="isOpen = !isOpen">
                        <h6 class="font-medium text-gray-900 flex gap-6">
                            <i class="fa-solid fa-book"></i>
                            <strong>Courses</strong>
                        </h6>
                        <i :class="isOpen ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'"></i>
                    </div>
                    
                    <!-- Dropdown List -->
                    <ul x-show="isOpen" x-cloak class="mt-2 bg-white shadow-md rounded-lg p-2 space-y-2 border border-gray-200">
                        @forelse ($courses as $course)
                        @if (Auth::user()->role == 'staff')
                        @if(Auth::user()->id == $course->lecturer_id)
                        <a href="{{ route('classchat', $course->id) }}" class="text-gray-800">
                            <li class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition">
                                    {{ $course->course_code }}
                                </li>
                            </a>
                            @endif
                            @else
                            <a href="{{ route('classchat', $course->id) }}" class="text-gray-800">
                                <li class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition">
                                        {{ $course->course_code }}
                                    </li>
                                </a>
                            @endif
                            @empty
                            <li class="px-3 py-2 bg-gray-100 text-indigo-500 hover:bg-gray-200 rounded transition">
                                Your courses will be displayed here
                            </li>
                        @endforelse
                    </ul>
                </li>
                {{-- market place --}}
                <li x-data="{ isOpen: false }" class="py-3 rounded-2xl transition-colors duration-150 flex flex-col relative w-full cursor-pointer px-2">
                    <div class="flex items-center justify-between px-2" @click="isOpen = !isOpen">
                        <h6 class="font-medium text-gray-900 flex gap-6">
                            <i class="fa fa-shopping-cart"></i>
                            <strong>Marketplace</strong>
                        </h6>
                        <i :class="isOpen ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'"></i>
                    </div>
                    
                    <!-- Dropdown List -->
                    <ul x-show="isOpen" x-cloak class="mt-2 bg-white shadow-md rounded-lg p-2 space-y-2 border border-gray-200">
                        <a href="{{ route('marketplace.dashboard') }}" class="text-gray-800">
                            <li class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition">
                                  <i class="fa fa-chart-line pr-2"></i> Dashboard  
                                </li>
                            </a>
                        
                            <a href="{{ route('marketplace.shop') }}" class="text-gray-800">
                                <li class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition">
                                    <i class="fa fa-store pr-2"></i>Shop
                                    </li>
                                </a>

                            {{-- <a href="{{ route('marketplace.shop') }}" class="text-gray-800">
                                <li class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded transition">
                                    <i class="fa fa-store pr-2"></i>
                                    </li>
                                </a> --}}
                           
                    </ul>
                </li>
            </ul>
        </main>
    </div>
</div>
