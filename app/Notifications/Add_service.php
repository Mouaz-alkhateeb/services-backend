<?php

namespace App\Notifications;

use App\services;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Add_service extends Notification
{
    use Queueable;
    private $services;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(services $services)
    {
        $this->services = $services;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [

            //'data' => $this->details['body']
            'id'=> $this->services->id,
            'title'=>'تم اضافة خدمة جديدة بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }

}