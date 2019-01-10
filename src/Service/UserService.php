<?php

namespace App\Service;

use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\Wp\UserRepository;
use App\Service\WpPasswordHashService;

/**
 * Class MiscService
 */
class UserService
{
    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * UserService constructor.
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
            $usersJson = file_get_contents('../var/data/users.json');

            $list = $this->serializer->deserialize($usersJson, 'App\Entity\User[]', 'json');
        } catch (\Exception $e) {
            throw new \Exception('Error while reading user file');
            // @todo: handle the exception
        }
        return $list;
    }
}
