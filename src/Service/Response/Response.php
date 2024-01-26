<?php

namespace Orangecode\Helpers\Service\Response;

class Response
{
    /** @var mixed  */
    public mixed $data;

    /** @var Message|null  */
    public ?Message $message;

    /** @var Field|null  */
    public ?Field $field;

    /** @var Modal|null  */
    public ?Modal $modal;

    /** @var string|null  */
    public ?string $redirect;

    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->data = null;
        $this->message = null;
        $this->field = null;
        $this->modal = null;
        $this->redirect = null;
    }
}
