<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 30.5.15
 * Time: 14.47
 */

namespace Soil\SmserBundle\Gateway;


use Buzz\Client\Curl;
use Buzz\Message\Form\FormRequest;
use Buzz\Message\Request;
use Buzz\Message\Response;

class SmspBy implements GatewayInterface {
    protected $apiKey = 'hVZbukszW6';

    protected $endpoint = "http://cp.smsp.by";

    /**
     * @var Curl
     */
    protected $buzz;

    public function __construct($endpoint, $apiKey) {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
    }

    /**
     * @param mixed $buzz
     */
    public function setBuzz($buzz)
    {
        $this->buzz = $buzz;
    }




    public function send($phoneNumber, $smsText, $options)    {
        file_put_contents('/tmp/sms_gateway', '[' . date('Y-m-d H:i:s') . '] - ' . $phoneNumber . ' - ' . $smsText . PHP_EOL, FILE_APPEND);

        $sender = array_key_exists('sender', $options) ? $options['sender'] : 'sender';
        $urgent = array_key_exists('urgent', $options) ? $options['urgent'] : false;

//        $sender = 'SMSp.by';


        $request = new FormRequest(FormRequest::METHOD_GET, $this->endpoint);
        $response = new Response();

        $params = [
            'r' => 'api/msg_send',
            'recipients' => $phoneNumber,
            'message' => $smsText,
            'sender' => $sender,
            'urgent' => $urgent,
            'user'=>'talakaby@gmail.com',
            'apikey' => $this->apiKey
        ];
        $request->addFields($params);

        $this->buzz->send($request, $response);

        $content = $response->getContent();

        $response = json_decode($content);

        return $response;
    }

} 