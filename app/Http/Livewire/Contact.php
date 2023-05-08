<?php

namespace App\Http\Livewire;

use Mail;
use Livewire\Component;

class Contact extends Component
{
    public $email;
    public $text;

    public $rules = [
        'email' => 'required|email',
        'text' => 'required|string',
    ];

    public function send()
    {
        $this->validate();
        $data = array('email'=>$this->email,'text'=>$this->text);
        Mail::send('emails.contact', $data, function($message) {
            $message->to('qnarik.ericyan@mail.ru', 'Knarik Yeritsyan')->subject
            ('Laravel HTML Testing Mail');
            $message->from('knarik.yeritsyan@gmail.com','Fitting app');
        });

    }

    public function render()
    {
        return view('livewire.contact');
    }
}
