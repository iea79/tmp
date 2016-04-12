<?php

namespace DaVinci\TaxiBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class PaymentController
{
    public function sendMoneyAction()
    {
      return new Response('<html><body>sendMoney!</body></html>');
    }
    
    public function historyAction()
    {
      return new Response('<html><body> history!</body></html>');
    }
}