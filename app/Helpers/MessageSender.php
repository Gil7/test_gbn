<?php

namespace App\Helpers;

use App\models\Book;
use Illuminate\Session\SessionManager;
use Illuminate\View\Factory;

class MessageSender
{
    protected $message;
    public function nofifyUser(Book $book){
        $this->generateMessage();
    }
    public function generateMessage(){
        $this->message = "Hey! The book $book->name is available now!";
        $this->sendNotification();
    }
    public function sendNotification(){
        //TODO - SEND NOTIFICATIONS
    }
}
