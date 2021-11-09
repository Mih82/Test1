<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class ApllicationSendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

		public $test;
		
		public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $test )
    {
		$this->test = $test;
	
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		Mail::to( 'photo-flora@yandex.ru' )
				->send( new \App\Mail\ApllicationMail( $this->test ) );
    }
}
