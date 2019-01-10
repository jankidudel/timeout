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
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $usersJson = file_get_contents('../var/data/users.json');

        $users = $this->serializer->deserialize($usersJson, 'App\Entity\User[]', 'json');

        return $users;
    }
}
