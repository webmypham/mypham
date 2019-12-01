<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $subject = 'Đặt hàng thành công')
    {
        $this->mailData = $mailData;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.orders.shipped')->with([
            'mailData' => $this->mailData,
        ]);
    }
}
