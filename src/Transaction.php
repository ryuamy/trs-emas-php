<?php

/**
 * Transaction.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class Transaction
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class Transaction
{
    /**
     * Required parameters for Gold Rate.
     *
     * @var array
     */
    private static $goldRateRequiredParams = [
        'start_date',
        'end_date'
    ];

    /**
     * Required parameter types for Gold Rate.
     *
     * @var array
     */
    private static $goldRateTypeParams = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'type' => 'string' //value type: 'daily'
    ];
    
    /**
     * Required parameters for Calculate Gold.
     *
     * @var array
     */
    private static $calculateBuyRequiredParams = [
        'amount_type',
        'amount',
        'payment_method'
    ];

    /**
     * Required parameter types for Calculate Gold.
     *
     * @var array
     */
    private static $calculateBuyTypeParams = [
        'amount_type' => 'enum', //amount type: 'currency', 'gold'
        'amount' => 'float',
        'payment_method' => 'string', //value from code of payment method from Payment Method API
    ];
    
    /**
     * Required parameters for Calculate Gold for Treasury Partner.
     *
     * @var array
     */
    private static $calculateBuyPartnerRequiredParams = [
        'amount_type',
        'amount',
    ];

    /**
     * Required parameter types for Calculate Gold for Treasury Partner.
     *
     * @var array
     */
    private static $calculateBuyPartnerTypeParams = [
        'amount_type' => 'enum', //amount type: 'currency', 'gold'
        'amount' => 'float',
    ];
    
    /**
     * Required parameters for Calculate Gold.
     *
     * @var array
     */
    private static $calculateSellRequiredParams = [
        'amount_type',
        'amount',
    ];

    /**
     * Required parameter types for Calculate Gold.
     *
     * @var array
     */
    private static $calculateSellTypeParams = [
        'amount_type' => 'enum', //amount type: 'currency', 'gold'
        'amount' => 'float',
    ];
    
    /**
     * Required parameters for Calculate Gold for Treasury Partner.
     *
     * @var array
     */
    private static $calculateSellPartnerRequiredParams = [
        'amount_type',
        'amount',
    ];

    /**
     * Required parameter types for Calculate Gold for Treasury Partner.
     *
     * @var array
     */
    private static $calculateSellPartnerTypeParams = [
        'amount_type' => 'enum', //amount type: 'currency', 'gold'
        'amount' => 'float',
    ];
    
    /**
     * Required parameters for Buy Gold.
     *
     * @var array
     */
    private static $buyRequiredParams = [
        'unit',
        'total',
        'payment_channel'
    ];

    /**
     * Required parameter types for Buy Gold.
     *
     * @var array
     */
    private static $buyTypeParams = [
        'unit' => 'float',
        'total' => 'integer',
        'payment_channel' => 'string', //value from code of payment method from Payment Method API
        'latitude' => 'string',
        'longitude' => 'string'
    ];
    
    /**
     * Required parameters for Buy Gold for Treasury Partner.
     *
     * @var array
     */
    private static $buyPartnerRequiredParams = [
        'invoice_number',
        'unit',
        'total',
        'payment_channel'
    ];

    /**
     * Required parameter types for Buy Gold for Treasury Partner.
     *
     * @var array
     */
    private static $buyPartnerTypeParams = [
        'invoice_number' => 'string',
        'unit' => 'float',
        'total' => 'integer',
        'payment_channel' => 'string', //value from code of payment method from Payment Method API
        'latitude' => 'string',
        'longitude' => 'string'
    ];
    
    /**
     * Required parameters for Sell Gold.
     *
     * @var array
     */
    private static $sellRequiredParams = [
        'total',
        'unit',
    ];

    /**
     * Required parameter types for Sell Gold.
     *
     * @var array
     */
    private static $sellTypeParams = [
        'total' => 'integer',
        'unit' => 'float',
        'latitude' => 'string',
        'longitude' => 'string'
    ];
    
    /**
     * Required parameters for Payment Notify for Treasury Partner.
     *
     * @var array
     */
    private static $paymentNotifyRequiredParams = [
        'invoice_number',
        'payment_note'
    ];

    /**
     * Required parameter types for Payment Notify for Treasury Partner.
     *
     * @var array
     */
    private static $paymentNotifyTypeParams = [
        'invoice_number' => 'string', //Invoice number from Buy transaction for Treasury Partner
        'payment_note' => 'string'
    ];
    
    /**
     * Required parameters for Apply Voucher.
     *
     * @var array
     */
    private static $applyVoucherRequiredParams = [
        'code'
    ];

    /**
     * Required parameter types for Apply Voucher.
     *
     * @var array
     */
    private static $applyVoucherTypeParams = [
        'code' => 'string'
    ];

    /**
     * Get gold rate from range date.
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
    public static function goldRate(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$goldRateRequiredParams, $params)->validateType(self::$goldRateTypeParams, $params);
        
        return Api::sendRequest( 'gold-price', $flag, 'POST', $params, $token );
    }

    /**
     * Calculate buy gold with current gold rate before do transaction.
     * Gold unit support can be up to 4 digits.
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
    public static function calculateBuy(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$calculateBuyRequiredParams, $params)->validateType(self::$calculateBuyTypeParams, $params);

        $params['transaction_type'] = 'buy';
        $params['payment_type'] = 'nett';

        return Api::sendRequest( 'calculate', $flag, 'POST', $params, $token );
    }

    /**
     * Calculate buy gold with current gold rate before do transaction.
     * Gold unit support can be up to 4 digits.
     * Calculate Partner only for Treasury Partner
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
    public static function calculateBuyPartner(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$calculateBuyPartnerRequiredParams, $params)->validateType(self::$calculateBuyPartnerTypeParams, $params);

        $params['transaction_type'] = 'buy';
        $params['payment_type'] = 'gross';

        return Api::sendRequest( 'calculate', $flag, 'POST', $params, $token );
    }

    /**
     * Calculate sell gold with current gold rate before do transaction.
     * Gold unit support can be up to 4 digits.
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
    public static function calculateSell(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$calculateSellRequiredParams, $params)->validateType(self::$calculateSellTypeParams, $params);

        $params['transaction_type'] = 'sell';
        $params['payment_type'] = 'nett';

        return Api::sendRequest( 'calculate', $flag, 'POST', $params, $token );
    }

    /**
     * Calculate sell gold with current gold rate before do transaction.
     * Gold unit support can be up to 4 digits.
     * Calculate Partner only for Treasury Partner
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
    public static function calculateSellPartner(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$calculateSellPartnerRequiredParams, $params)->validateType(self::$calculateSellPartnerTypeParams, $params);

        $params['transaction_type'] = 'sell';
        $params['payment_type'] = 'gross';

        return Api::sendRequest( 'calculate', $flag, 'POST', $params, $token );
    }

    /**
     * Get list of payment method.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function paymentMethod(bool $flag = false, string $token) : object
    {
        $params = [];

        return Api::sendRequest( 'payment-method', $flag, 'GET', $params, $token );
    }

    /**
     * Buy gold transaction.
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
    public static function buy(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$buyRequiredParams, $params)->validateType(self::$buyTypeParams, $params);

        $params['payment_method'] = 'treasury';

        return Api::sendRequest( 'payment-method', $flag, 'POST', $params, $token );
    }

    /**
     * Buy gold transaction for Treasury Partner.
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
    public static function buyPartner(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$buyPartnerRequiredParams, $params)->validateType(self::$buyPartnerTypeParams, $params);

        $params['payment_method'] = 'partner';

        return Api::sendRequest( 'payment-method', $flag, 'POST', $params, $token );
    }

    /**
     * Sell gold transaction.
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
    public static function sell(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$sellRequiredParams, $params)->validateType(self::$sellTypeParams, $params);

        return Api::sendRequest( 'payment-method', $flag, 'POST', $params, $token );
    }

    /**
     * Payment notify from Treasury Partner to Treasury after user do pay transaction on Treasury Partner.
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
    public static function paymentNotify(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$paymentNotifyRequiredParams, $params)->validateType(self::$paymentNotifyTypeParams, $params);

        return Api::sendRequest( 'payment-notify', $flag, 'POST', $params, $token );
    }

    /**
     * Apply voucher for buy gold transaction.
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
    public static function applyVoucher(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$applyVoucherRequiredParams, $params)->validateType(self::$applyVoucherTypeParams, $params);

        return Api::sendRequest( 'voucher', $flag, 'POST', $params, $token );
    }
}