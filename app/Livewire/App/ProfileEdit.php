<?php

namespace App\Livewire\App;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Modal;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProfileEdit extends Component
{
    use WithFileUploads; 
 
    public $openModalUserEdit = false;
    public $avatar;
    public $name,$phone,$location,$email,$gender,$descripcion,$userId;
    public function mount(){
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->telefono;
        $this->gender = $user->gender;
        $this->descripcion = $user->descripcion;
        $this->location = $user->ubicacion;
        $this->userId =$user->id;
        if(Auth::user()->profile_photo_path ===null){
            $this->avatar = Auth::user()->profile_photo_url;

        }
        elseif(strpos(Auth::user()->profile_photo_path, 'http') === 0){
            $this->avatar = Auth::user()->profile_photo_path;

        }
        elseif(file_exists(public_path('storage/' . Auth::user()->profile_photo_path))){
            $this->avatar =  asset('storage/' . Auth::user()->profile_photo_path);

        }
    }
    public function render()
    {
        return view('livewire.app.profile-edit');
    }
    public function openModal(){
        $this->openModalUserEdit = true;
    }
    public function updateUser(){
        $userEdit =User::find($this->userId);
        // Verificar si se proporcionó una nueva imagen
        if (is_string($this->avatar) || $this->avatar === null || strpos($this->avatar, 'http') === 0) {
            $image = $userEdit->profile_photo_path; // Mantener la imagen existente
        } else {
            if (strpos($userEdit->profile_photo_path, 'profile-photos') === 0) {
                Storage::disk('public')->delete($userEdit->profile_photo_path); // Eliminar la imagen antigua
            }            
            $image = $this->avatar->store('profile-photos', 'public'); // Almacenar la nueva imagen
        }
        
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'telefono' => $this->phone,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->location,
            'gender' => $this->gender,
            'profile_photo_path' => $image
        ];
        $userEdit->update($userData);
        return redirect('user/profile');
       // $this->reset('openModalUserEdit','name','descripcion','gender','email','phone','location');
    }
    
}
