<?php

/**
 * Api.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class Api
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class Api
{
    /**
     * Send HTTP Request to Treasury API.
     */
    public static function sendRequest( string $endPoint, bool $flag = false, string $requestMethod, array $requestBody = [], string $bearerToken = '' ) : object
    {
        $base_url = ($flag === false) ? 'https://stagetrs.treasury.id/partner/v2/' : 'https://www.treasury.id/partner/v2/';

        $requestHeaders = array();
        $requestHeaders[] = 'Accept: application/json';
        if($bearerToken !== '') {
            $requestHeaders[] = 'Authorization: Bearer ' . $bearerToken;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base_url . $endPoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        
        if($requestMethod === 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
        }

        $httpRequest = curl_exec($ch);
        $httpEffectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        Validator::validateResponseCode($httpCode);

        return json_decode($httpRequest);
    }
}