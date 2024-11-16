<div class="fixed h-full flex border bg-white lg:shadow-lg overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

    <!-- Chat List Sidebar (Visible on Large Screens) -->
    <div class="hidden lg:flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
        <livewire:chat.chat-list :selected="$selectedConversation" :query="$query">

    </div>

    <!-- Chat Box Content Area -->
    <div class="grid w-full border-l h-full relative overflow-y-auto" style="contain: content">
       <livewire:chat.chat-box :selected="$selectedConversation">
    </div>

</div>
