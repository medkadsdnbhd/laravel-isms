<?php
namespace Medkad\ISMS;

use Medkad\ISMS\Exceptions\InvalidReceiver;
use Medkad\ISMS\Exceptions\ISMSException;
use Illuminate\Notifications\Notification;

class ISMSChannel
{
    protected $ISMSClient;

    public function __construct(ISMSClient $client)
    {
        $this->ISMSClient = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        try {
            $to = $this->getTo($notifiable);
            $message = $notification->toISMS($notifiable)->message();
            $result = $this->ISMSClient->sendSMS($to, $message);

            $this->handlingResponse($result);
        } catch (\Exception $ex) {
            throw ISMSException::unknownError($ex->getMessage());
        }
    }

    protected function getTo($notifiable)
    {
        if (isset($notifiable->mobile_number)) {
            return $notifiable->mobile_number;
        }
        
        if ($notifiable->routeNotificationFor('ISMS')) {
            return $notifiable->routeNotificationFor('ISMS');
        }

        throw InvalidReceiver::noReceiverSet();
    }

    protected function handlingResponse($result)
    {
        $responseMessage = str_replace(['"', '[', ']','-','`'], '', $result);

        $responseCode = substr($responseMessage, 0, 4);

        if ($responseCode[0] != 2) {
            throw ISMSException::couldNotSend($responseCode, $responseMessage);
        } else {
            return true;
        }
    }

}
