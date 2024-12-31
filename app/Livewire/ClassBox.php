<?php

namespace App\Livewire;

use App\Models\ClassMessage;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClassBox extends Component
{
    use WithFileUploads;
    public $user;
    public $selectedConversation;
    public $name;
    public $body;
    public $file;
    public $image;
    public $loadedMessages;
    public $messageIdToEdit;
    public $editedMessageBody;
    public $paginate_var = 10;

    public function mount()
    {
        $conversationId = request()->route('query');

        $this->selectedConversation = ClassRoom::find($conversationId);
        // dd($conversationId);
        // if ($this->selectedConversation) {
        //     $this->user = User::find($this->selectedConversation->class_rooms_id);
        // }
        $this->loadedMessages();
        // $this->name = Conversation::all();
    }

    public function loadMore(){
        $this->paginate_var+=10;
        dd("detected");

        $this->loadedMessages();    
    }

    public function loadedMessages(){
        $count=ClassMessage::where('class_rooms_id',$this->selectedConversation->id)->count();
        $this->loadedMessages=ClassMessage::where('class_rooms_id',$this->selectedConversation->id)
        ->skip(max(0, $count - $this->paginate_var))
        ->take($this->paginate_var)
        ->get();

        return $this->loadedMessages;
    }
    public function sendMessage(){
        $this->validate(['body'=>'required|string']);
        $createMessage = ClassMessage::create([
            'class_rooms_id'=>$this->selectedConversation->id,
            'sender_id'=>auth()->id(),
            // 'department_id'=>Auth::user()->department,
            'body'=> $this->body
        ]);
        $this->body = ' ';
        $this->loadedMessages->push($createMessage);


        $this->selectedConversation->updated_at= now();
        $this->selectedConversation->save();

        // $this->emitTo('chat.chat-list', 'refresh');
    }

    // problem with the submittion it is not working yet take note
    public function fileUpload(){
        // dd($this->file);
        $this->validate([
            'file' => "required|file|max:102400|mimes:pdf",
        ]);
        $fileName = $this->file->getClientOriginalName();
        $path=$this->file->store('uploads', 'public');
        ClassMessage::create([
            'body' => $path,
            'class_rooms_id'=>$this->selectedConversation->id,
            'sender_id'=>auth()->id(),
            'file_name' => $fileName,
        ]);
        // dd($this->selectedConversation->id);
        return redirect('/classchat/'.$this->selectedConversation->id);

    }
    public function imageUpload(){
        $this->validate([
            'image' => "image|required|mimes:png,jpg,jpeg|max:1024",
        ]);
        // $imageName = $this->file->getClientOriginalName();
        $path=$this->image->store('images', 'public');
        // dd("shege");
        ClassMessage::create([
            'body' => $path,
            'class_rooms_id'=>$this->selectedConversation->id,
            'sender_id'=>auth()->id(),
            'file_name' => "ochigbosharp"
        ]);
        return redirect('/classchat/'.$this->selectedConversation->id);
    }

    public function destroy($id)
    {
        ClassMessage::whereId($id)->delete();
        
        // Alert::toast('Deleted Successfully', 'success');
        // return back();
        return redirect('/classchat/'.$this->selectedConversation->id);
    }

    public function updateMessage()
{
    // Validate the new message body
    $this->validate([
        'editedMessageBody' => 'required|string|max:1000',
    ]);

    // Find and update the message
    $message = ClassMessage::find($this->messageIdToEdit);

    if ($message && $message->sender_id === auth()->id()) {
        $message->update([
            'body' => $this->editedMessageBody,
        ]);

        // Reset fields and emit event to close modal
        $this->reset(['messageIdToEdit', 'editedMessageBody']);
        $this->dispatchBrowserEvent('close-modal');
    }
}
    public function render()
    {
        return view('livewire.class-box');
    }
}
