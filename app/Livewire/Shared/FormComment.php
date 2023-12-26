<?php
namespace App\Livewire\Shared;
use App\Livewire\Admin\ShowComment;
use App\Livewire\App\Pages\ComentariosLivewire;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class FormComment extends Component
{
    public $openModal = false;
    public $titleModal = "Crear Comentario";
    public $btnModal = "Crear";
    public $description,$rating,$commentId;
    public $rules = ['description'=>'required','rating'=>'required'];
    protected $listeners = ['editarCommentForm'];

    public function render(){
        return view('livewire.shared.form-comment');
    }
    public function mount(){

    }

     public function createOrUpdate(){
         $this->validate();
         $comment = ['description'=>$this->description,'rating'=>$this->rating,'user_id'=>Auth::user()->id]; 
         if($this->btnModal=="Crear"){ 
             Comment::create($comment); 
             $message = '¡Comentario creado exitosamente!';
         }else{ 
             Comment::findOrFail($this->commentId)->update($comment);
             $message = '¡Comentario actualizado exitosamente!';
         }
        $this->reset(['openModal','description','rating','commentId','btnModal','titleModal']);
        
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
        $this->dispatch('render')->to(ShowComment::class);
        $this->dispatch('render')->to(ComentariosLivewire::class);

     }

    public function editarCommentForm(Comment $comment){
        $this->commentId = $comment->id;
        $this->description =$comment->description;
        $this->rating =$comment->rating;
        $this->titleModal = "Editar Comentario";
        $this->btnModal = "Actualizar";
        $this->openModal= true;
    }
    public function abrirModal(){
        $this->reset('description','rating','commentId');
        $this->openModal= true;
    }
}
