<div class="fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
    <div class="relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
        @livewire('chat.chat-list')
    </div>
    <div class="hidden md:grid w-full border-l h-full relative overflow-y-auto" style="contain: content">
        <div class="m-auto text-center justify-content flex flex-col gap-3">
            <h4 class="font-medium text-lg">
                Choose a conversation to start chatting
            </h4>
        </div>
    </div>
</div>
