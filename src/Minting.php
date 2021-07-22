<?php

/**
 * Minting.php
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */

namespace Ryuamy\TrsEmas;

/**
 * Class Minting
 *
 * @category Class
 * @package  Ryuamy\TrsEmas
 *
 * @author   Ryu Amy <ryuamy.mail@gmail.com>
 */
class Minting
{
    /**
     * Required parameters for Minting Fee.
     *
     * @var array
     */
    private static $mintingFeeRequiredParams = [
        'minting_partner'
    ];

    /**
     * Required parameter types for Minting Fee.
     *
     * @var array
     */
    private static $mintingFeeTypeParams = [
        'minting_partner' => 'string' //value from code of minting partner API
    ];

    /**
     * Required parameters for Minting Piece.
     *
     * @var array
     */
    private static $mintingPieceRequiredParams = [
        'minting_partner'
    ];

    /**
     * Required parameter types for Minting Piece.
     *
     * @var array
     */
    private static $mintingPieceTypeParams = [
        'minting_partner' => 'string' //value from code of minting partner API
    ];

    /**
     * Required parameters for Minting Shipping.
     *
     * @var array
     */
    private static $mintingShippingRequiredParams = [
        'minting_partner'
    ];

    /**
     * Required parameter types for Minting Shipping.
     *
     * @var array
     */
    private static $mintingShippingTypeParams = [
        'minting_partner' => 'string' //value from code of minting partner API
    ];

    /**
     * Required parameters for Calculate Minting.
     *
     * @var array
     */
    private static $calculateMintingRequiredParams = [
        'minting_partner',
        'minting_fee',
        'minting_piece',
        'minting_shipping'
    ];
    
    /**
     * Required parameters for Calculate Minting.
     *
     * @var array
     */
    private static $calculateMintingTypeParams = [
        'minting_partner' => 'string', //value from code of minting partner API
        'minting_fee' => 'string', //value from code of minting fee API
        'minting_piece' => 'string', //value from code of minting piece API
        'minting_shipping' => 'string' //value from code of minting shipping API
    ];

    /**
     * Required parameters for Gold Minting.
     *
     * @var array
     */
    private static $goldMintingRequiredParams = [
        'minting_partner',
        'minting_fee',
        'minting_piece',
        'minting_shipping',
        'shipping_address',
        'payment_channel'
    ];
    
    /**
     * Required parameters for Gold Minting.
     *
     * @var array
     */
    private static $goldMintingTypeParams = [
        'minting_partner' => 'string', //value from code of minting partner API
        'minting_fee' => 'string', //value from code of minting fee API
        'minting_piece' => 'string', //value from code of minting piece API
        'minting_shipping' => 'string', //value from code of minting shipping API
        'shipping_address' => 'string',
        'payment_channel' => 'string', //value from code of payment method from Payment Method API
        'latitude' => 'string',
        'longitude' => 'string',
    ];

    /**
     * Get list of Minting Partner.
     *
     * @param   boolean     $flag
     * @param   string      $token
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function mintingPartner(bool $flag = false, string $token) : object
    {
        $params = [];

        return Api::sendRequest( 'minting', $flag, 'GET', $params, $token );
    }

    /**
     * Check minting fee of selected partner.
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
    public static function mintingFee(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$mintingFeeRequiredParams, $params)->validateType(self::$mintingFeeTypeParams, $params);

        return Api::sendRequest( 'minting-fee', $flag, 'POST', $params, $token );
    }

    /**
     * Check available minting piece of selected partner.
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
    public static function mintingPiece(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$mintingPieceRequiredParams, $params)->validateType(self::$mintingPieceTypeParams, $params);
        
        return Api::sendRequest( 'minting-piece', $flag, 'POST', $params );
    }

    /**
     * Check available minting piece of selected partner.
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
    public static function mintingShipping(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$mintingShippingRequiredParams, $params)->validateType(self::$mintingShippingTypeParams, $params);
        
        return Api::sendRequest( 'minting-shipping', $flag, 'POST', $params );
    }

    /**
     * Calculate total payment minting.
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
    public static function calculateMinting(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$calculateMintingRequiredParams, $params)->validateType(self::$calculateMintingTypeParams, $params);
        
        return Api::sendRequest( 'minting-calculate', $flag, 'POST', $params );
    }

    /**
     * Gold minting transaction.
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
    public static function goldMinting(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$goldMintingRequiredParams, $params)->validateType(self::$goldMintingTypeParams, $params);

        $params['payment_method'] = 'treasury';
        
        return Api::sendRequest( 'minting-calculate', $flag, 'POST', $params );
    }

    /**
     * Gold minting transaction.
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
    public static function goldMintingPartner(bool $flag = false, array $params, string $token) : object
    {
        Validator::validateRequirement(self::$goldMintingRequiredParams, $params)->validateType(self::$goldMintingTypeParams, $params);

        $params['payment_method'] = 'partner';
        
        return Api::sendRequest( 'minting', $flag, 'POST', $params );
    }
}