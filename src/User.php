<?php

/**
 * User.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class User
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class User
{
    /**
     * Required parameters for Update Password.
     *
     * @var array
     */
    private static $updatePasswordRequiredParams = [
        'email',
        'password',
        'password_confirmation',
    ];
    
    /**
     * Required parameters for Update Password.
     *
     * @var array
     */
    private static $updatePasswordTypeParams = [
        'email' => 'string', //value from code of minting partner API
        'password' => 'string', //value from code of minting fee API
        'password_confirmation' => 'string', //value from code of minting piece API
        'pin' => 'string',
    ];

    /**
     * Treasury user profile.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function profile(bool $flag = false, string $token) : object
    {
        $params = [];

        return Api::sendRequest( 'profile', $flag, 'GET', $params, $token );
    }

    /**
     * Get Treasury update profile link.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function updateProfile(bool $flag = false, string $token) : object
    {
        $params = [];

        return Api::sendRequest( 'update-profile', $flag, 'GET', $params, $token );
    }

    /**
     * Update user password.
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
    public static function updatePassword(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$updatePasswordRequiredParams, $params)->validateType(self::$updatePasswordTypeParams, $params);

        return Api::sendRequest( 'update-password', $flag, 'POST', $params, $token );
    }

}