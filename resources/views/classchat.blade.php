<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Classroom') }}
        </h2>
    </x-slot>

    <div class="sm:fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 top-28 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        <div class="relative hidden md:block w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
                
             
        @livewire('class-box')
            
    </div>
</x-app-layout>
