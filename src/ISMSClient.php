<?php
namespace Medkad\ISMS;

use Illuminate\Support\Facades\Http;

class ISMSClient
{
    protected $USERNAME;
    protected $PASSWORD;
    protected $URL;

    public function __construct($username, $password, $url)
    {
        $this->USERNAME = $username;
        $this->PASSWORD = $password;
        $this->URL = $url;
    }

    private function callToApi($body, $headers)
    {
        $response = Http::withBasicAuth($this->USERNAME, $this->PASSWORD)->post(
            $this->URL,
            $body,
            $headers
        );

        return $response;
    }

    public function sendSMS($msisdn, $message)
    {
        $headers = [
            'Content-Type: application/json',
          ];

        $body = [
            'sendid' => 'medkad',
            'recipient' => [
                [
                  'dstno' => $msisdn,
                  'msg' => $message,
                  'type' => '1'
                ]
              ],
              'agreedterm' =>  'YES',
              'method' => 'isms_send_all_id'
            ];
            
        return $this->callToApi($body, $headers);
    }
}
