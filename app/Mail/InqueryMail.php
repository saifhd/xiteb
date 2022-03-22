<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InqueryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    protected $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$product)
    {
        $this->data = $data;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.inquery')
            ->subject('Product Inquery')
            ->markdown('emails.inquery', [
                    'data' => $this->data,
                    'product' => $this->product
                ]);;
    }
}
