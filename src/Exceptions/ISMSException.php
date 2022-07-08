<?php
namespace Medkad\ISMS\Exceptions;

class ISMSException extends \Exception
{
    public static function invalidConfiguration()
    {
        return new static('Configuration for iSMS is not set! Setup your configuration at `config/services.php`. You need to add credentials in the `isms` key of `config.services`.');
    }

    public static function couldNotSend($code, $msg)
    {
        return new static('Could Not Send SMS. ISMS responded with an error-code: '.$code.', with message: `'.$msg.'`');
    }
    
    public static function unknownError($response)
    {
        return new static('Unknown error occurred while sending SMS: `'.$response.'`');
    }
}
