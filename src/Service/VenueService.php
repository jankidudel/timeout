<?php

namespace App\Service;

use App\Entity\Venue;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\Wp\UserRepository;
use App\Service\WpPasswordHashService;

/**
 * Class MiscService
 */
class VenueService
{
    private $serializer;

    /**
     * VenueService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getList(): array
    {
        $list = [];
        try {
            $usersJson = file_get_contents('../var/data/venues.json');

            $list = $this->serializer->deserialize($usersJson, 'App\Entity\Venue[]', 'json');
        } catch (\Exception $e) {
            throw new \Exception('Error while reading venue file');
            // @todo: handle the exception
        }
        return $list;
    }

    /**
     * @param array $venues
     * @param array $users
     * @return array
     */
    public function getPlacesGoAvoid(array $venues, array $users): array
    {
        $placesToGo = [];
        $placesToAvoid = [];

        /** @var Venue $venue */
        foreach ($venues as $venue) {
            $venueCons = [];
            $venueFood = $venue->getFood();
            $venueDrinks = $venue->getDrinks();

            /** @var User $user */
            foreach ($users as $user) {
                // first check if a person has something to eat
                if (empty(array_diff($venueFood, $user->getWontEat()))) {
                    $venueCons[] = [
                        'type' => 'eat',
                        'user' => $user
                    ];
                }

                // next check if he has something to drink
                if (empty(array_intersect($venueDrinks, $user->getDrinks()))) {
                    $venueCons[] = [
                        'type' => 'drink',
                        'user' => $user
                    ];
                }

            }
            if ($venueCons) {
                $placesToAvoid[] = [
                    'venue' => $venue,
                    'reasons' => $venueCons
                ];
            } else {
                $placesToGo[] = [
                    'venue' => $venue
                ];
            }
        }

        $res = [
            'go' => $placesToGo,
            'avoid' => $placesToAvoid
        ];

        return $res;
    }
}
