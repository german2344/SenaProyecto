<?php

namespace App\Livewire\App\Pages;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactLivewire extends Component
{
    public $name, $email,$phone, $affair,$message;
    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'affair' => 'required',
        'message' => 'required'
    ];
    public function render()
    {
        return view('livewire.app.pages.contact-livewire');
    }
    public function enviarCorreo(){
        $this->validate();
        $data = [
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'affair' => $this->affair,
            'message' => $this->message
        ];
        $correo = new ContactanosMailable($data);
        Mail::to('jachate7@misena.edu.co')->send($correo);
        $this->reset(['name','email','affair','message']);
        $this->dispatch('show-toast', type:"info", message:"su correo ha sido enviado exitosamente"); 
       
    }

}
