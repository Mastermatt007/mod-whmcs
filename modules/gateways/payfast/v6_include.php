<?php
/**
 * Copyright (c) 2008 PayFast (Pty) Ltd
 * You (being anyone who is not PayFast (Pty) Ltd) may download and use this plugin / code in your own website in conjunction with a registered and active PayFast account. If your PayFast account is terminated for any reason, you may not use this plugin / code or part thereof.
 * Except as expressly indicated in this licence, you may not use, copy, modify or distribute this plugin / code or part thereof in any way.
 */

/**
 * getInvoiceHostingItems
 *
 *
 *
 * @date 2016-06-29
 * @version 1.0.0
 * @access
 *
 * @author Ron Darby <ron.darby@payfast.co.za>
 * @since 1.0.0
 *
 * @param $invoiceId
 * @return mixed
 *
 *
 */
function getInvoiceHostingItems($invoiceId)
{
    $invoiceHostingItems = Illuminate\Database\Capsule\Manager::table('tblinvoiceitems')
        ->where('invoiceid', $invoiceId)
        ->where('type', 'Hosting')
        ->get();
    return json_decode(json_encode($invoiceHostingItems), true);
}

/**
 * getInvoiceItems
 *
 *
 *
 * @date 2016-06-29
 * @version 1.0.0
 * @access
 *
 * @author Ron Darby <ron.darby@payfast.co.za>
 * @since 1.0.0
 *
 * * @param $invoiceId
 * @return mixed
 *
 *
 */
function getInvoiceItems($invoiceId )
{
    $invoiceHostingItems = Illuminate\Database\Capsule\Manager::table('tblinvoiceitems')
        ->where('invoiceid', $invoiceId)
        ->get();
    return json_decode(json_encode($invoiceHostingItems), true);
}

/**
 * getInvoiceStatus
 *
 *
 *
 * @date 2016-06-29
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen <brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * * @param $invoiceId
 * @return mixed
 *
 *
 */
function getInvoiceStatus( $invoiceId )
{
    $invoice = Illuminate\Database\Capsule\Manager::table('tblinvoices')
        ->where('id', $invoiceId)
        ->get();
    return json_decode(json_encode($invoice), true);
}

/**
 * getHosting
 *
 *
 *
 * @date 2016-06-29
 * @version 1.0.0
 * @access
 *
 * @author Ron Darby <ron.darby@payfast.co.za>
 * @since 1.0.0
 *
 * * @param $id
 * @return array
 *
 *
 */
function getHosting($id )
{
    $hosting = Illuminate\Database\Capsule\Manager::table('tblhosting')
        ->where('id', $id)
        ->first();
    return (array)$hosting;
}

/**
 * getProduct
 *
 *
 *
 * @date 2016-06-29
 * @version 1.0.0
 * @access
 *
 * @author Ron Darby <ron.darby@payfast.co.za>
 * @since 1.0.0
 *
 * * @param $id
 * @return array
 *
 *
 */
function getProduct($id )
{
    $product = Illuminate\Database\Capsule\Manager::table('tblproducts')
        ->where('id', $id )
        ->first();
    return (array)$product;
}

/**
 * getSubscriptionId
 *
 *
 *
 * @date 2017-08-28
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen <brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @param $userid
 * @return array
 *
 *
 */
function getSubscriptionId( $userId )
{
    $product = Illuminate\Database\Capsule\Manager::table('tblhosting')
        ->where('userid', $userId )
        ->where('subscriptionid', '<>', '')
        ->latest('id')
        ->first();
    return (array)$product;
}

/**
 * setAdHocPayment
 *
 *
 *
 * @date 2016-11-18
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen<brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @param $orderId
 * @return boolean
 *
 */
function setAdHocPaymentMethod( $orderId )
{
    Illuminate\Database\Capsule\Manager::table('tblhosting')
        ->where('orderid', $orderId)
        ->update(
            [
                'paymentmethod' => 'payfast-adhoc',
            ]
        );

    return true;
}

/**
 * setDomainStatus
 *
 *
 *
 * @date 2016-11-18
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen<brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @param $orderId
 * @return boolean
 *
 *
 */
function setDomainStatus( $orderId )
{
    Illuminate\Database\Capsule\Manager::table('tblhosting')
        ->where('orderid', $orderId)
        ->update(
            [
                'domainstatus' => 'Active',
            ]
        );

    return true;
}

/**
 * setSubscriptionId
 *
 *
 *
 * @date 2019-02-27
 * @version 2.0.0
 * @access
 *
 * @author Brendon Posen<brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @author Cate Faull <cate.faull@payfast.co.za>
 * @since 2.0.0
 *
 * @param $clientSubId
 * @param $clientEmail
 * @return boolean
 *
 *
 */
function setSubscriptionId( $clientSubId, $clientEmail )
{
    Illuminate\Database\Capsule\Manager::table('tblclients')
        ->where('email', $clientEmail)
        ->update(
            [
                'gatewayid' => $clientSubId,
            ]
        );

    return true;
}

/**
 * setTblHostingCancelStatus
 *
 *
 *
 * @date 2016-11-18
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen<brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @param $orderId
 * @return boolean
 *
 *
 */
function setTblHostingCancelStatus( $orderId )
{
    Illuminate\Database\Capsule\Manager::table('tblhosting')
        ->where('orderid', $orderId)
        ->update(
            [
                'domainstatus' => 'Cancelled',
            ]
        );

    return true;
}

/**
 * setTblOrdersCancelStatus
 *
 *
 *
 * @date 2016-11-18
 * @version 1.0.0
 * @access
 *
 * @author Brendon Posen<brendon.posen@payfast.co.za>
 * @since 1.0.0
 *
 * @param $invoiceId
 * @return boolean
 *
 *
 */
function setTblOrdersCancelStatus( $invoiceId )
{
    Illuminate\Database\Capsule\Manager::table('tblorders')
        ->where('invoiceid', $invoiceId)
        ->update(
            [
                'status' => 'Cancelled',
            ]
        );

    return true;
}