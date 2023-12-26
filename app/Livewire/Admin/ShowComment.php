<?php

namespace App\Livewire\Admin;

use App\Livewire\Shared\FormComment;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class ShowComment extends Component
{
    use WithPagination;
    public $search;
    public $direction = "desc";
    protected $listeners = ['render'];
    public function render()
    {
      //->orderBy($this->ordenar,$this->direction)
        $comments = Comment::where('description', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.show-comments',compact('comments'));
    }
    public function destroyComment(Comment $comment){
        $comment->delete();
        $this->dispatch('show-toast', type:"error", message: "¡Comentario eliminado exitosamente!"); 
        $this->resetPage();
    }

    public function emitComment(Comment $comment){
        $this->dispatch('editarCommentForm',$comment)->to(FormComment::class);
    }
    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }
  
}
