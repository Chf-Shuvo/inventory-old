<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $mes;


    public function __construct($subject,$message)
    {
        $this->sub = $subject;
        $this->mes = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $build_subject = $this->sub;
        $build_message = $this->mes;
        return $this->view('build_mail', compact("build_message"))->subject($build_subject);
    }
}
