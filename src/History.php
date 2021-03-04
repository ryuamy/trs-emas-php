<?php

/**
 * History.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class History
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class History
{
    /**
     * Required parameters for Detail History.
     *
     * @var array
     */
    private static $detailHistoryRequiredParams = [
        'invoice_no'
    ];
    
    /**
     * Required parameters for Detail History.
     *
     * @var array
     */
    private static $detailHistoryTypeParams = [
        'invoice_no' => 'string',
    ];

    /**
     * Get buy gold history transactions.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function buyGoldHistory(bool $flag = false, string $token) : object
    {
        $params = [];
        $params['type'] = 'buy';

        return Api::sendRequest( 'history', $flag, 'POST', $params, $token );
    }

    /**
     * Get sell gold history transactions.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function sellGoldHistory(bool $flag = false, string $token) : object
    {
        $params = [];
        $params['type'] = 'sell';

        return Api::sendRequest( 'history', $flag, 'POST', $params, $token );
    }


    /**
     * Get gold minting history transactions.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function goldMintingHistory(bool $flag = false, string $token) : object
    {
        $params = [];
        $params['type'] = 'minting';

        return Api::sendRequest( 'history', $flag, 'POST', $params, $token );
    }

    /**
     * Buy gold detail history transactions.
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
    public static function buyGoldDetailHistory(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$detailHistoryRequiredParams, $params)->validateType(self::$detailHistoryTypeParams, $params);
        
        $params['type'] = 'buy';

        return Api::sendRequest( 'detail-history', $flag, 'POST', $params, $token );
    }

    /**
     * Sell gold detail history transactions.
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
    public static function sellGoldDetailHistory(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$detailHistoryRequiredParams, $params)->validateType(self::$detailHistoryTypeParams, $params);
        
        $params['type'] = 'sell';

        return Api::sendRequest( 'detail-history', $flag, 'POST', $params, $token );
    }

    /**
     * Gold minting detail history transactions.
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
    public static function goldMintingDetailHistory(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$detailHistoryRequiredParams, $params)->validateType(self::$detailHistoryTypeParams, $params);
        
        $params['type'] = 'minting';

        return Api::sendRequest( 'detail-history', $flag, 'POST', $params, $token );
    }

}