<div class="max-w-6xl mx-auto my-16">
    <h1 class="text-center text-5xl font-bold dark:text-white text-black py-3 ">Users</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 px-2">
        @foreach ($users as $user)
        <div class="w-full bg-white border rounded-lg  border-gray-200  shadow">
            <div class="flex flex-col items-center pb-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="">
                <h5 class="mb-1 text-xl font-medium text-gray-900">
                    {{$user->name}}
                </h5>
                <span class="text-sm text-gray-500">{{ $user->email }}</span>
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
            
        @endforeach
    </div>
</div>
