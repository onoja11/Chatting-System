<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- @livewire('chat.chat-list') --}}

    <div class="sm:fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 top-28 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        <div class="relative hidden md:block w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
        <div class=" w-full border-l h-full relative overflow-y-auto" style="contain: content">
            <div class="m-auto text-center justify-content flex flex-col gap-3">
                
                <header class="px-3 z-10 bg-white sticky top-0 w-full py-2">
                    <div class="border-b justify-between flex items-center pb-2">
                        <div class="flex items-center gap-2">
                        </div>
                        <div class="flex items-center gap-2">
                            @if (Auth::user()->profilePic == "")
                            <x-avatar/>
                            @else
                            <x-avatar  src="{{ asset('profile_pic/' .  Auth::user()->profilePic) }}" />
                            @endif                            {{-- <x-avatar/> --}}
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-7 h-7" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg> --}}
                        </div>
                    </div>
                    
                </header>
                <div class="font-medium flex text-lg">
                    {{-- boxes --}}
                    
                    <div class=" max-w-sm w-full mx-auto  shadow-lg bg-white rounded-xl p-8 ">
                        <h1 class="text-4xl font-bold  mb-8 text-center">Edit: <span class="font-semibold text-xl">{{$books->title}}</span></h1>
                        
                       
                        <form class="space-y-6" method="post" action="{{route('books.update',$books->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            
                            <div class="mb-2">
                                <label for="title" class="block mb-2 text-sm font-medium">Title</label>
                                <input type="text" name="title" id="title" class="bg-gray-300 border border-gray-300 text-sm rounded-lg block w-full text-black p-2.5 focus:ring-2  " required value="{{$books->title}}" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />

                            </div>
                            
                            <div class="mb-10">
                                <label for="description" class="block mb-2 text-sm font-medium ">Description</label>
                                <input type="text" name="description" id="description" class="bg-gray-300 border border-gray-300  text-sm rounded-lg block w-full p-2.5"  required value="{{$books->description}}" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />

                            </div>
                            
                            <div class="mb-10">
                                <label for="category" class="block mb-2 text-sm font-medium ">Category</label>
                                <select type="text" name="category" id="category" class="bg-gray-300 border border-gray-300  text-sm rounded-lg block w-full p-2.5"  >
                                    <option value="" hidden></option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }} "> {{ $category->title }} </option>
                            @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                            
                            <div class="mb-10">
                                <label for="file" class="block mb-2 text-sm font-medium ">File</label>
                                <input type="file" accept=".pdf" name="file" id="file" class="bg-gray-300 border border-gray-300  text-sm rounded-lg block w-full p-2.5"   >
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>
                            
                            <div class="mb-10">
                                <label for="price" class="block mb-2 text-sm font-medium ">Price</label>
                                <input type="number" name="price" id="price" class="bg-gray-300 border border-gray-300  text-sm rounded-lg block w-full p-2.5"  required value="{{$books->price}}">
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            <button type="submit" class=" text-white  bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200">
                                Submit
                            </button>
                        </div>
                        </form>
                        
                    </div>
                    
                    {{-- end of boxes --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
