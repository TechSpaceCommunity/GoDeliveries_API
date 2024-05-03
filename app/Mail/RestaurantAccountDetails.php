<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantAccountDetails extends Mailable
{
    use Queueable, SerializesModels;

    protected $userData;

    /**
     * Create a new message instance.
     *
     * @param array $userData
     */
    public function __construct(array $userData)
    {
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $loginUrl = config('app.url') . '/restaurantslogin';

        return $this->subject('Restaurant Account Details')
                    ->view('emails.restaurant-account-creation')
                    ->with(['userData' => $this->userData, 'loginUrl' => $loginUrl]);
    }
}