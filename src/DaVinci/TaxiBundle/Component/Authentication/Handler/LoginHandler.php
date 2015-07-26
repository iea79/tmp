<?php
 
namespace DaVinci\TaxiBundle\Component\Authentication\Handler;
 
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Cmf\Component\Routing\ChainRouter as Router;
 
class LoginHandler implements AuthenticationSuccessHandlerInterface
{
	
    protected $container;
    protected $router;
	protected $security;
	
	public function __construct(Container $container, Router $router, SecurityContext $security)
	{
        $this->container = $container;
		$this->router = $router;
		$this->security = $security;
	}
	
	public function onAuthenticationSuccess(Request $request, TokenInterface $token)
	{
        $response = new RedirectResponse($request->headers->get('referer'));
        
        if ($this->security->isGranted('ROLE_USER')) {
			$requestId = $request->getSession()->get('request_id');
            if (!is_null($requestId)) {
                $response = new RedirectResponse($this->router->generate(
                    'passenger_request_payment', 
                    array('id' => $requestId)
                ));
            }    
		}
			
		return $response;
	}
	
}

?>