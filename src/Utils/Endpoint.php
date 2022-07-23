<?php

declare(strict_types=1);

namespace gazmendsahiti\CcPointe\Utils;

enum Endpoint: string
{
    /*
     * Available CardPointe endpoints
     * */
    case INQUIRE_MERCHANT = 'inquireMerchant';
    case AUTHORIZATION = 'auth';
    case CAPTURE = 'capture';
    case VOID = 'void';
    case REFUND = 'refund';
    case INQUIRE = 'inquire';
    case INQUIRE_BY_ORDER_ID = 'inquireByOrderId';
    case VOID_BY_ORDER_ID = 'voidByOrderId';
    case SETTLEMENT_STATUS = 'settlestat';
    case FUNDING = 'funding';
    case PROFILE = 'profile';
    case SIGNATURE_CAPTURE = 'sigcap';
    case BIN = 'bin';
}