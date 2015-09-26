<?php

namespace DaVinci\TaxiBundle\Event;

final class FinancialOfficeEvents 
{
	
	const OPERATION_SALE = 'operation.sale';
	const OPERATION_ADD = 'operation.add';
	const OPERATION_WITHDRAW = 'operation.withdraw';
	const OPERATION_INTERNAL_TRANSFER = 'operation.internal-transfer';
    
    static public function getEventList()
	{
		return array(
			self::OPERATION_SALE,
			self::OPERATION_ADD,
			self::OPERATION_WITHDRAW,
            self::OPERATION_INTERNAL_TRANSFER
		);
	}
    
    static public function getDescriptionEventList()
    {
        return array(
			self::OPERATION_SALE => 'Opeartion sale',
			self::OPERATION_ADD => 'Opeartion addition',
			self::OPERATION_WITHDRAW => 'Opeartion withdraw',
            self::OPERATION_INTERNAL_TRANSFER => 'Opeartion internal transfer'
		);
    }
	
}

?>