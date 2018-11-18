<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PointOfSale;


class MapController extends BaseController
{

    public function indexAction(Request $request)
    {

        $entity = $this->em()->getRepository(PointOfSale::class)->findAll();
        $pointOfSales = $this->getSerializeDecode($entity, 'pointofsale');

        $response = $this->render(
            'AppBundle:Map:index.html.twig',
            [
                'point_of_sales' => $pointOfSales,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_HOUR);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

}

