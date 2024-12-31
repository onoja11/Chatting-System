<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Classroom') }}
        </h2>
    </x-slot>

    <div
        class="fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 top-28 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        {{-- sidebar --}}
        <div class="relative hidden md:block  w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
        <div class=" w-full border-l h-full relative overflow-y-auto" style="contain: content">
            <div class="m-auto text-center justify-content flex flex-col gap-3">

                <header class="px-3 z-10 bg-white sticky top-0 w-full py-2">
                    <div class="border-b justify-between flex items-center pb-2">
                        <div class="flex items-center gap-2 ">
                        </div>
                        <div class="flex items-center ">
                            @if (Auth::user()->role == 'staff')
                                <livewire:join-class />
                            @else
                            @endif
                            @if (Auth::user()->profilePic == '')
                                <x-avatar />
                            @else
                                <x-avatar src="{{ asset('profile_pic/' . Auth::user()->profilePic) }}" />
                            @endif
                        </div>
                    </div>

                </header>
                <div class="font-medium flex text-lg">
                    {{-- boxes --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full max-w-3xl mx-auto">
                        <!-- Chat with Coursemates Card -->

                        @forelse ($classrooms as $classroom)
                            {{-- @if (Auth::user()->department == $classroom->department) --}}
                            @if (Auth::user()->role == 'staff')
                                @if (Auth::user()->id == $classroom->lecturer_id)
                                    <div
                                        class="bg-gradient-to-br from-purple-500 to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer h-64  w-96 mx-auto">
                                        <a href="{{ route('classchat', $classroom->id) }}" class="block h-full p-6">
                                            <div class="flex flex-col justify-center items-center h-full">
                                                <div class="bg-white text-blue-500 p-3 rounded-full">
                                                    <i class="fa-solid fa-comments fa-2x"></i>
                                                </div>
                                                <h2 class="text-xl font-semibold mt-4">{{ $classroom->course_code }}
                                                </h2>
                                                <p class="mt-2 text-sm text-blue-200 text-center">
                                                    {{ $classroom->course_title }}
                                                </p>
                                                <p class="mt-2 text-sm text-blue-200 text-center">
                                                    {{ $classroom->department }}
                                                </p>
                                                <p class="mt-2 text-sm text-blue-200 text-center">
                                                    {{ $classroom->level }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div
                                    class="bg-gradient-to-br from-purple-500 to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer h-64  w-96 mx-auto">
                                    <a href="{{ route('classchat', $classroom->id) }}" class="block h-full p-6">
                                        <div class="flex flex-col justify-center items-center h-full">
                                            <div class="bg-white text-blue-500 p-3 rounded-full">
                                                <i class="fa-solid fa-comments fa-2x"></i>
                                            </div>
                                            <h2 class="text-xl font-semibold mt-4">{{ $classroom->course_code }}</h2>
                                            <p class="mt-2 text-sm text-blue-200 text-center">
                                                {{ $classroom->course_title }}
                                            </p>
                                            <p class="mt-2 text-sm text-blue-200 text-center">
                                                {{ $classroom->department }}
                                            </p>
                                            <p class="mt-2 text-sm text-blue-200 text-center">
                                                {{ $classroom->level }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            {{-- @endif --}}
                        @empty
                            <div class=" md:w-[800px] mt-10    ">
                                <img src="{{ asset('images/Empty.gif') }}" alt="" width="300" height=""
                                    class="m-auto">
                                <p class="text-red-800 font-serif text-xl mt-3">
                                    No Classrooms Yet
                                </p>
                            </div>
                        @endforelse


                    </div>
                    {{-- end of boxes --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
