<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ordermail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        return $this->from('example@example.com', 'Example')
                ->view('ordermail')->with([
                'email' => $data['email'],
                'fname' => $data['firstname'],
                'lname' => $data['lastname'],
                'address1' => $data['address1'],
                'zip' => $data['zip'],
                'phone' => $data['phone'],
                'producttotal' => $data['producttotal'],
                'finalTotal' => $data['finalTotal']
                ]);
    }
}
