<?php

/**
 * Additional.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class Additional
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class Additional
{
    /**
     * Required parameters for Check Email Availability.
     *
     * @var array
     */
    private static $checkEmailAvailabilityRequiredParams = [
        'email'
    ];

    /**
     * Required parameter types for Check Email Availability.
     *
     * @var array
     */
    private static $checkEmailAvailabilityTypeParams = [
        'email' => 'string'
    ];

    /**
     * Check if email is available or not.
     *
     * @param   boolean     $flag
     * @param   array       $params
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function checkEmailAvailability(bool $flag = false, array $params) : object
    {
        Validator::validateRequirement(self::$checkEmailAvailabilityRequiredParams, $params)->validateType(self::$checkEmailAvailabilityTypeParams, $params);
        
        return Api::sendRequest( 'check-email', $flag, 'POST', $params );
    }

    /**
     * Get list of security questions.
     *
     * @param   boolean     $flag
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function securityQuestion(bool $flag = false) : object
    {
        return Api::sendRequest( 'security-question', $flag, 'GET' );
    }

    /**
     * Get list of bank.
     *
     * @param   boolean     $flag
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function bankList(bool $flag = false) : object
    {
        return Api::sendRequest( 'bank-list', $flag, 'GET' );
    }
}