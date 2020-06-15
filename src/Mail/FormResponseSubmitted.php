<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Mail;

use Code4Romania\Cms\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormResponseSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var Response */
    public $response;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('email.formResponseSubmitted.subject'))
            ->markdown('emails.formResponseSubmitted');
    }
}
