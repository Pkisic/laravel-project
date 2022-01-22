<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $contactName;
    protected $contactEmail;
    protected $contactMessage;


/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactName,$contactEmail,$contactMessage)
    {
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(config('mail.username'), $this->contactName)
                ->subject("You have new message on contact form")
                ->replyTo($this->contactEmail);
        
        return $this->view('front.email.contact_form')
                ->with([
                    'contactName' => $this->contactName,
                    'contactMessage' => $this->contactMessage
                ]);
    }
}
