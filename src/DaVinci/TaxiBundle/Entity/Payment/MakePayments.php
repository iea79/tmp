<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

final class MakePayments 
{
	
	const FLOW_NAME = 'makePayment';
	const PAYMENT_INFO_TYPE = 'PaymentInfoType';

	const COMISSION = 0.15;
	
	const DEFAULT_REQUEST_PRICE = 1.00;
	const DEFAULT_CURRENCY = 'USD';
	
	const DEFAULT_DESCRIPTION_SETTLE_ACCCOUNT = 'Settle account';
	
	const CODE_SUCCESS = 0;
	const CODE_FAIL = 9999;
    
    const OPERATION_PAYMENT = 'payment';
    const OPERATION_ADDITION = 'addition';
    const OPERATION_SHOP_PURCHASE = 'shop-purchase';
    
    const OPERATION_STATE_IN_PROGRESS = 'in-progress';
    const OPERATION_STATE_COMPLETED = 'completed';
    const OPERATION_STATE_DECLINED = 'declined';
    
    static public function getOperationTypesList()
    {
        return array(
            self::OPERATION_PAYMENT, 
            self::OPERATION_ADDITION, 
            self::OPERATION_SHOP_PURCHASE
        );
    }
    
    static public function getOperationStatesList()
    {
        return array(
            self::OPERATION_STATE_COMPLETED, 
            self::OPERATION_STATE_DECLINED, 
            self::OPERATION_STATE_IN_PROGRESS
        );
    }
			
}

?>