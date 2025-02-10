<div
    x-data="{
        height: 0,
        conversationElement: null,
        openFileModal: false,
        openImageModal: false,
        init() {
            this.conversationElement = document.getElementById('conversation');
            this.scrollToBottom();
            $watch('loadedMessages', () => {
                this.scrollToBottom();
            });
        },
        scrollToBottom() {
            if (this.conversationElement) {
                this.height = this.conversationElement.scrollHeight;
                this.conversationElement.scrollTop = this.height;
            }
        }
    }"
    class="w-full overflow-hidden"
>
    <div class="border-b flex flex-col overflow-y-scroll grow h-full">
        {{-- header --}}
        <header class="w-full sticky inset-x-0 flex pb-[5px] pt-[5px] top-0 z-10 bg-white border-b ">
            <div class="flex w-full item-center px-2 lg:px-4 gap-2 md:gap-5">
                <a class="shrink-0 lg:hidden" href="{{ route('classroom') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </a>

                {{-- avatar --}}
                <div class="shrink-0"></div>
                <div class="flex gap-5">
                    <h6 class="font-bold truncate mt-3">
                        {{ Str::upper($selectedConversation->course_title) }}
                    </h6>
                    <div class="absolute right-0 mr-2">
                        @if (Auth::user()->role == 'staff')
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-secondary-button>
                                    Upload <i class="fas fa-download ml-3"></i>
                                </x-secondary-button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- File Upload Trigger -->
                                <x-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'upload-file')">
                                    <i class="fas fa-file mr-3"></i> upload file
                                </x-dropdown-link>

                                <!-- Image Upload Trigger -->
                                <x-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'upload-image')">
                                    <i class="fas fa-image mr-3"></i> upload image
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>                            
                        @endif
                    </div>
                </div>
            </div>
        </header>
        {{-- <button @click="openFileModal = true" class="bg-blue-500 text-white px-4 py-2">Test Open Modal</button> --}}

        {{-- body --}}
        <main
            id="conversation"
            class="flex flex-col gap-3 p-2.5 overflow-y-auto flex-grow overscroll-contain overflow-x-hidden w-full my-auto"
        >
            @if ($loadedMessages)
                @foreach ($loadedMessages as $message)
                @if(str_contains($message->body, 'uploads/' ) || str_contains($message->body, 'images/' ))
                {{--starts  --}}
                <div @class([
                    'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
                    'ml-auto' => $message->sender_id === auth()->id(),
                    ])>

                    <x-dropdown align="right" width="48" >
                        <x-slot name="trigger">
                            <i class="fas fa-caret-down mt-5   {{ $message->sender_id === Auth::user()->id ? "block" : "hidden" }}"></i>
                        </x-slot>
                        <x-slot name="content">
                            {{-- <x-dropdown-link >
                                <i class="fas fa-edit"></i></i> Edit
                            </x-dropdown-link> --}}
                            <x-dropdown-link wire:click="destroy({{ $message->id }})">
                               <i class="fas fa-trash text-red-600"></i><span class="text-red-600"> Delete</span>
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                        <div
                            @class([
                                'flex flex-wrap text-[15px]  rounded-xl p-2.5 flex flex-col text-black bg-[#f6f6f8fb]',
                                'rounded-bl-none border border-gray-200/40' => !($message->sender_id === auth()->id()),
                                'rounded-br-none bg-blue-500/80  text-white ' => $message->sender_id === auth()->id(),
                            ])
                        >
                        @if ($message->file_name  == "ochigbosharp")
                        <div class="w-25 h-25" style="width: 200px; overflow:hidden; height:190px">
                            <img src="{{asset('storage/' . $message->body)}}"   alt="" class="w-100 h-50 ">
                        </div>
                        @else
                        <p @class(["whitespace-normal  p-3 rounded-md truncate text-sm md:text-base tracking-wide lg:tracking-normal",'bg-blue-300'=> $message->sender_id === auth()->id(), 'bg-gray-200/40'=> !($message->sender_id === auth()->id())  ])>
                            {{ $message->file_name }}
                        </p>
                            
                        @endif
                            <div class="flex mt-4 space-x-3 m-auto mb-3 md:mt-6">

                                {{-- <x-primary-button href="{{ $message->body }}" target="_blank">
                                    Open
                                </x-primary-button> --}}
                            
                                <a href="{{ asset('storage/' . $message->body) }}" target="_blank"  class="">
                                    <x-primary-button>
                                        View
                                    </x-primary-button>
                                </a>
                                <a href="{{ asset('storage/' . $message->body) }}" download="{{ $message->file_name }}"  class="">
                                    <x-primary-button >
                                        Download
                                    </x-primary-button>
                                </a>
                            </div>
                            <div class="ml-auto flex gap-2">
                                <p @class([
                                    'text-xs',
                                    'text-gray-500' => !($message->sender_id === auth()->id()),
                                    'text-white' => $message->sender_id === auth()->id(),
                                ])>
                                    {{ $message->created_at->format('g:i a') }}
                                </p>
                            </div>
                        </div>
                    </div>   
                    {{--ends  --}}
                @else
                <div @class([
                    'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
                    'ml-auto' => $message->sender_id === auth()->id(),
                ])>
                    <x-dropdown align="right" width="48" >
                        <x-slot name="trigger">
                            <i class="fas fa-caret-down mt-5   {{ $message->sender_id === Auth::user()->id ? "block" : "hidden" }}"></i>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link >
                                <i class="fas fa-edit"></i> Edit
                            </x-dropdown-link>

                            <x-dropdown-link wire:click="destroy({{ $message->id }})">
                            <i class="fas fa-trash text-red-600"></i><span class="text-red-600"> Delete</span>
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <div
                        @class([
                            'flex flex-wrap text-[15px] rounded-xl p-2.5 flex flex-col text-black bg-[#f6f6f8fb]',
                            'rounded-bl-none border border-gray-200/40' => !($message->sender_id === auth()->id()),
                            'rounded-br-none bg-blue-500/80 text-white ' => $message->sender_id === auth()->id(),
                        ])
                    >
                        <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal">
                            {{ $message->body }}
                        </p>
                        <div class="ml-auto flex gap-2">
                            <p @class([
                                'text-xs',
                                'text-gray-500' => !($message->sender_id === auth()->id()),
                                'text-white' => $message->sender_id === auth()->id(),
                            ])>
                                {{ $message->created_at->format('g:i a') }}
                            </p>
                        </div>
                    </div>
                </div>                    
                @endif
                @endforeach
            @endif
        </main>

        {{-- send message --}}
        @if (Auth::user()->role === 'staff')
            <footer class="shrink-0 z-10 bg-white inset-x-0">
                <div class="p-2 border-t">
                    <form x-data="{ body: @entangle('body') }" @submit.prevent="$wire.sendMessage().then(() => { body = '' })"
                        method="POST" autocapitalize="off">
                        @csrf

                        <input type="hidden" autocomplete="false" style="display:none">
                        <div class="grid grid-cols-12">
                            <input x-model="body" type="text" autocomplete="off" autofocus
                                placeholder="write your message here" maxlength="1700"
                                class="col-span-10 bg-gray-100 border-0 outline-0 focus:border-0 focus:ring-0 hover:ring-0 rounded-lg focus:outline-none">
                            <button x-bind:disabled="!body.trim()" class="col-span-2" type='submit'>Send
                            </button>
                        </div>
                    </form>

                    @error('body')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </footer>
        @endif
    </div>

    <!-- File Upload Modal -->

    {{-- new file --}}
    <x-modal name="upload-file" focusable>
        <form class="p-6" wire:submit.prevent="fileUpload">
          

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create ClassRoom') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you create a classroom here it will be accessible by everybody in your department and level') }}
            </p>

            <div class="mt-4">
                <x-input-label for="course_title" value="{{ __('Upload File') }}" class="sr-only" />

                <x-text-input
                    id="file"
                    wire:model="file"
                    type="file"
                    accept=".pdf"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Upload File') }}"
                />

                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>

        
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-success-button class="ms-3 bg-indigo-700 hover:bg-indigo-600 focus:bg-indigo-800 active:bg-indigo-700 dark:focus:ring-indigo-500"  >
                    Save
                    <span wire:loading class="w-8 h-8  border-4 border-dashed rounded-full animate-spin border-white"></span>
                </x-success-button>
            </div>
        </form>
    </x-modal>
    {{-- new file --}}


   

    {{-- new image --}}
    <x-modal name="upload-image" focusable>
        <form class="p-6" wire:submit.prevent="imageUpload">
          

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Upload Image') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you upload an ssroom here it will be accessible by everybody in your department and level') }}
            </p>

            <div class="mt-4">
                <x-input-label for="image" value="{{ __('Upload Image') }}" class="sr-only" />

                <x-text-input
                    id="image"
                    wire:model="image"
                    type="file"
                    accept="image/*"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Upload File') }}"
                />

                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

        
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-success-button class="ms-3 bg-indigo-700 hover:bg-indigo-600 focus:bg-indigo-800 active:bg-indigo-700 dark:focus:ring-indigo-500"  >
                    Save
                    <span wire:loading class="w-8 h-8  border-4 border-dashed rounded-full animate-spin border-white"></span>
                </x-success-button>
            </div>
        </form>
    </x-modal>
    {{-- new image --}}

    <!-- Edit Modal -->
{{-- <div
x-show="openEditModal"
class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
x-cloak
>
<div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center border-b pb-3">
        <h2 class="text-xl font-semibold text-gray-800">Edit Message</h2>
        <button @click="openEditModal = false" class="text-gray-500 hover:text-gray-800">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <form wire:submit.prevent="updateMessage" class="mt-4">
        <div>
            <label for="message-body" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea id="message-body" rows="3" wire:model="editedMessageBody"
                class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('editedMessageBody') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4 flex justify-end">
            <button type="button" @click="openEditModal = false"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">
                Cancel
            </button>
            <button type="submit"
                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</div>
</div> --}}



</div>
