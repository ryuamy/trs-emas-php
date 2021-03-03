<?php

/**
 * Authentication.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class Authentication
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class Authentication
{
    /**
     * Required parameters for Login Client.
     *
     * @var array
     */
    private static $loginClientRequiredParams = [
        'client_id',
        'client_secret'
    ];

    /**
     * Required parameter types for Login Client.
     *
     * @var array
     */
    private static $loginClientTypeParams = [
        'client_id' => 'string',
        'client_secret' => 'string'
    ];

    /**
     * Required parameters for Register.
     *
     * @var array
     */
    private static $registerRequiredParams = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'gender',
        'birthday',
        'referral_code',
        'phone',
        'security_question',
        'security_question_answer',
        'customer_concern'
    ];

    /**
     * Required parameter types for Register.
     *
     * @var array
     */
    private static $registerTypeParams = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'password_confirmation' => 'string',
        'gender' => 'string', //female or male
        'birthday' => 'date',
        'referral_code' => 'string',
        'phone' => 'string',
        'security_question' => 'string', //id of security question API
        'security_question_answer' => 'string',
        'selfie_scan' => 'string', //Base64
        'id_card_scan' => 'string', //Base64
        'owner_name' => 'string',
        'account_number' => 'string',
        'bank_code' => 'string', //code of Bank List API
        'branch' => 'string',
        'customer_concern' => 'boolean',
        'app_notification' => 'boolean',
        'email_notification' => 'boolean'
    ];

    /**
     * Required parameters for Login.
     *
     * @var array
     */
    private static $loginRequiredParams = [
        'client_id',
        'client_secret',
        'email',
        'password'
    ];

    /**
     * Required parameter types for Login.
     *
     * @var array
     */
    private static $loginTypeParams = [
        'client_id' => 'string',
        'client_secret' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    /**
     * Required parameters for Forgot Password.
     *
     * @var array
     */
    private static $forgotPasswordRequiredParams = [
        'email'
    ];

    /**
     * Required parameter types for Forgot Password.
     *
     * @var array
     */
    private static $forgotPasswordTypeParams = [
        'email' => 'string'
    ];

    /**
     * Client login into Treasury and obtain the bearer token for new user registration.
     *
     * @param   boolean     $flag
     * @param   array       $params
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function loginClient(bool $flag = false, array $params) : object
    {
        Validator::validateRequirement(self::$loginClientRequiredParams, $params)->validateType(self::$loginClientTypeParams, $params);

        $params['grant_type'] = 'client_credetials';

        return Api::sendRequest( 'login', $flag, 'POST', $params );
    }

    /**
     * Register new Treasury user.
     *
     * @param   boolean     $flag
     * @param   array       $params
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function register(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$registerRequiredParams, $params)->validateType(self::$registerTypeParams, $params);

        return Api::sendRequest( 'register', $flag, 'POST', $params, $token );
    }

    /**
     * User login into Treasury and obtain the bearer token.
     *
     * @param   boolean     $flag
     * @param   array       $params
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function login(bool $flag = false, array $params) : object
    {
        Validator::validateRequirement(self::$loginRequiredParams, $params)->validateType(self::$loginTypeParams, $params);

        $params['grant_type'] = 'password';
        
        return Api::sendRequest( 'login', $flag, 'POST', $params );
    }

    /**
     * Send an e-mail contains link for reset password.
     *
     * @param   boolean     $flag
     * @param   array       $params
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function forgotPassword(bool $flag = false, array $params) : object
    {
        Validator::validateRequirement(self::$forgotPasswordRequiredParams, $params)->validateType(self::$forgotPasswordTypeParams, $params);
        
        return Api::sendRequest( 'forgot-password', $flag, 'POST', $params );
    }
}