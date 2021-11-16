<?php

namespace core\base\exceptions;

class RouteException extends \Exception
{
    protected $messages;
    protected $message;

    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);

        $this->messages = include 'messages.php';

        $error = $this->getMessage() ? $this->getMessage() : $this->messages[$this->getCode()];

        $error .="\r\n" . 'file' . $this->getFile() . "\r\n" . 'In line' . $this->getLine() . "\r\n";

        $this->message = $error;

    }

    public function getError()
    {
        echo $this->message;
    }
}