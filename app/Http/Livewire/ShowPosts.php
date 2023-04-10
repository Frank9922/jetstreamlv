<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $post, $image, $identificador, $cant="10";
    public $edit_open=false;
    public $sort='id';
    public $direction='desc';
    public $search="";
    public $readyToload= false;

    
    protected $queryString= [
        'cant' => ['except' =>"10"],
        'sort' => ['except' =>'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount(){
        $this->identificador= rand();
        $this->post= new Post;
    }

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    protected $listeners =['render' =>'render'];

    public function render()
    {
        if($this->readyToload){

                    $posts = Post::where('title','like', '%'. $this->search . '%')->
                    orWhere('content','like', '%'. $this->search . '%')
                    ->orderBy($this->sort,$this->direction)
                    ->paginate($this->cant);
        }
        else {
            $posts = [];
        }
        return view('livewire.show-posts', compact('posts'));
    }

    public function loadPosts()
    {
        $this->readyToload=true;
    }

    public function order($sort)
    {

        if ($this->sort ==$sort) {
            if($this->direction == 'desc'){
                $this->direction ='asc';
            }
            else {
                $this->direction='desc';
            }
        } 
        else {
            $this->sort =$sort;
        }
        
        $this->sort =$sort;
    }

    public function edit(Post $post)
    {
        $this->post=$post;
        $this->edit_open=true;
    }

    public function update()
    {
        $this->validate();

        if($this->image){
            Storage::delete([$this->post->image]);

            $this->post->image = $this->image->store('/posts');

        }

        $this->post->save();

        $this->reset(['edit_open', 'image']);

        $this->identificador=rand();

        $this->emit('alert', 'Post Actualizado!');

        $this->edit_open =false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
