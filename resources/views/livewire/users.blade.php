<div class="max-w-6xl mx-auto my-16">
    @if (Auth::user()->role == "student")
    <h1 class="text-center text-5xl font-bold dark:text-white text-black mb-8">CourseMates</h1>        
    @else
    <h1 class="text-center text-5xl font-bold dark:text-white text-black mb-8">Colleague</h1>        
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 px-2">
        @forelse ($users as $user)
        <div class="w-full bg-white border rounded-lg  border-gray-200  shadow">
            <div class="flex flex-col items-center pb-10">
                {{-- <x-avatar class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('profile_pic/' . $user->profilePic ) }}" /> --}}
                    @if ($user->profilePic == "")
                    <x-avatar class="w-24 h-24 mb-3 rounded-full shadow-lg"/>
                    @else
                    <x-avatar class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('profile_pic/' . $user->profilePic ) }}" />
                    @endif
                <h5 class="mb-1 text-xl font-medium text-gray-900">
                    {{$user->name}}
                </h5>
                <span class="text-sm text-gray-500">{{ $user->university_id_number }}</span>
                <div class="flex mt-4 space-x-3 mb-3 md:mt-6">
                    <x-primary-button>
                        Add Friend
                    </x-primary-button>
                    <x-secondary-button wire:click="message({{ $user->id }})">
                        MESSAGE
                    </x-secondary-button>
                </div>
            </div>
        </div>
        @empty
        @if (Auth::user()->role == "student")
        <h2 class="col-span-6 mt-24 text-center font-mono text-white">Your Course Mates Will be Displayed Here!</h2>              
        @else
        <h2 class="col-span-6 mt-24 text-center font-mono text-white">Your Colleague Will be Displayed Here!</h2>              
            
        @endif
          
        @endforelse
    </div>
</div>
