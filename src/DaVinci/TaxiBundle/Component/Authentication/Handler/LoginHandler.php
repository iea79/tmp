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
                $repository = $this->getPassengerRequestRepository();
                
                $passengerRequest = $repository->getFullRequestById($requestId);
                $passengerRequest->setUser($this->security->getToken()->getUser());
                
                $repository->save($passengerRequest);
                              
                $response = new RedirectResponse($this->router->generate(
                    'passenger_request_confirm', 
                    array('id' => $requestId)
                ));
            }    
		}
        
        $request->getSession()->remove('request_id');
			
		return $response;
	}
    
    /**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	protected function getPassengerRequestRepository()
	{
		$em = $this->container->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest');
	}
	
}

?>