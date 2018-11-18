<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{

    public function loginAction(Request $request)
    {

        if ($request->isMethod('POST')) {
            return $this->redirectUrl('app_map_index');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $response = $this->render(
            'AppBundle:Security:login.html.twig',
            [
                'last_username' => $lastUsername,// last username entered by the user
                'error' => $error,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_HOUR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }


    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }


}

