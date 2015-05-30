<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 30.5.15
 * Time: 14.54
 */

namespace Soil\SmserBundle\Gateway;


interface GatewayInterface {

    public function send($phoneNumber, $smsText, $options);

} 