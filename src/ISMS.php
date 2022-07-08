<?php
namespace Medkad\ISMS;

class ISMS
{
    /**
     *  The message body to be sent to the user
     */

    protected $message;

    /**
     * primary contruction
     */

    public function __construct(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * retrive message body
     */

    public function message()
    {
        return $this->message;
    }
}
