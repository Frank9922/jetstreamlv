<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;

    public $open=false;

    public $title, $content, $image, $identificador;

    protected $messages =[
        'title.required' => 'El titulo es un campo obligatorio!',
        'content.required' => 'El Contenido es un campo obligatorio!',
        'image.required' => 'La imagen es obligatoria!'

    ];
    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image'
    ];

    public function mount(){
        $this->identificador=rand();
    }

    public function close(){
        $this->open = false;

    }
    
    public function save(){
        $this->validate();

        $image = $this->image->store('posts');

        Post::create([
            'title'=>$this->title,
            'content'=>$this->content,
            'image' =>$image,
        ]);

        $this->reset([
            'open',
            'title',
            'content',
            'image'
        ]);

        $this->identificador=rand();

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'Se ha creado un nuevo Post con el titulo');

        $this->open=false;
    }


    public function render()
    {
        return view('livewire.create-post');
    }
}
