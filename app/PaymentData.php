<?php
/**
 * Created by PhpStorm.
 * User: niru
 * Date: 7/9/2016
 * Time: 1:23 PM
 */

namespace App;


class PaymentData
{
    public  $paymentMethod;

    public $currency;

    public $totalAmount;

    public $returnUrl;

    public $cancelUrl;

    public $intent;

    public $description;
}