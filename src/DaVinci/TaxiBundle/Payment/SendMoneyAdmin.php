<?php

namespace DaVinci\TaxiBundle\Payment;


use Symfony\Component\HttpFoundation\Response;

class SendMoneyAdmin
{
    public function indexAction($name)
    {
        return new Response('<html><body>Hello '.$name.'!</body></html>');
    }
}