<?php

namespace App\Controller;

use App\Service\UserService;
use App\Service\VenueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{
    /**
     * @param UserService $userService
     * @param VenueService $venueService
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="default")
     */
    public function index(UserService $userService, VenueService $venueService)
    {
        $venues = $venueService->getList();
        $users = $userService->getList();

        $placesGoAvoid = $venueService->getPlacesGoAvoid($venues, $users);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'places' => $placesGoAvoid
        ]);
    }
}
