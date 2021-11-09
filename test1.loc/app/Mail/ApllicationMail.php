<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApllicationMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $test;
	
	public $content;
	//public $text = 'text';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $test )
    {
        $this->test = $test;	
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pf122@yandex.ru')->view( env('THEME').'.mail')
						->with( [ 'test' => $this->test	])
							->subject('Заявка с файлами');

    }

}
