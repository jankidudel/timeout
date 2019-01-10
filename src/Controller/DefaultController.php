<?php

namespace App\Controller;

use App\Service\UserService;
use App\Service\VenueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
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
