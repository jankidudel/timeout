<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Venue;
use App\Service\VenueService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class VenueServiceTest
 */
class VenueServiceTest extends KernelTestCase
{
    /**
     * @var VenueService $venueService
     */
    private $venueService;

    /**
     * Set up tests
     */
    public function setUp() {
        self::bootKernel();

        $this->venueService = self::$kernel->getContainer()->get('venue_service');
    }

    /**
     * Test place has not drinks
     */
    public function testPlaceHasNoDrinks()
    {
        $venue1 = (new Venue())
            ->setName('Venue 1')
            ->setFood(['fruits', 'salads', 'meat'])
            ->setDrinks(['water', 'juice', 'tea']);

        $venue2 = (new Venue())
            ->setName('Venue 2')
            ->setFood(['meat', 'pizza', 'mexican'])
            ->setDrinks(['water', 'beer', 'vodka', 'smoothie']);


        $user1 = (new User())
            ->setName('John')
            ->setWontEat(['meat'])
            ->setDrinks(['smoothie']);

        $user2 = (new User())
            ->setName('Peter')
            ->setWontEat(['dairy'])
            ->setDrinks(['water']);

        $res = $this->venueService->getPlacesGoAvoid([$venue1, $venue2], [$user1, $user2]);

        $this->assertCount(1, $res['avoid']);
        $this->assertEquals(
            [
                'venue' => $venue1,
                'reasons' => [
                    [
                        'type' => 'drink',
                        'user' => $user1
                    ]
                ]
            ],
            $res['avoid'][0]
        );

        $this->assertTrue(true);
    }

    /**
     * Test place has no food
     */
    public function testPlaceHasNoFood()
    {
        $venue1 = (new Venue())
            ->setName('Venue 1')
            ->setFood(['fruits', 'salads', 'meat'])
            ->setDrinks(['water', 'juice', 'tea']);

        $venue2 = (new Venue())
            ->setName('Venue 2')
            ->setFood(['meat', 'pizza', 'mexican'])
            ->setDrinks(['water', 'beer', 'vodka', 'smoothie']);


        $user1 = (new User())
            ->setName('Simon')
            ->setWontEat(['meat'])
            ->setDrinks(['smoothie', 'water']);

        $user2 = (new User())
            ->setName('Jan')
            ->setWontEat(['dairy', 'meat', 'pizza', 'mexican'])
            ->setDrinks(['water', 'tea']);

        $res = $this->venueService->getPlacesGoAvoid([$venue1, $venue2], [$user1, $user2]);

        $this->assertCount(1, $res['avoid']);
        $this->assertEquals(
            [
                'venue' => $venue2,
                'reasons' => [
                    [
                        'type' => 'eat',
                        'user' => $user2
                    ]
                ]
            ],
            $res['avoid'][0]
        );

        $this->assertTrue(true);
    }

    /**
     * Test places have food and drinks
     */
    public function testPlaceHasFoodAndDrinks()
    {
        $venue1 = (new Venue())
            ->setName('Venue 1')
            ->setFood(['fruits', 'salads', 'meat'])
            ->setDrinks(['water', 'juice', 'tea']);

        $venue2 = (new Venue())
            ->setName('Venue 2')
            ->setFood(['meat', 'pizza', 'mexican', 'thai'])
            ->setDrinks(['water', 'beer', 'vodka', 'smoothie']);


        $user1 = (new User())
            ->setName('Carl')
            ->setWontEat(['meat'])
            ->setDrinks(['smoothie', 'water']);

        $user2 = (new User())
            ->setName('Michael')
            ->setWontEat(['dairy', 'meat', 'pizza', 'mexican'])
            ->setDrinks(['water', 'tea']);

        $res = $this->venueService->getPlacesGoAvoid([$venue1, $venue2], [$user1, $user2]);

        $this->assertEmpty($res['avoid']);
        $this->assertCount(2, $res['go']);

        $this->assertTrue(true);
    }

}
