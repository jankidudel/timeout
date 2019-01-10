<?php

namespace App\Entity;

/**
 * Class User
 */
class User
{
    /**
     * @var
     */
    private $name;

    /**
     */
    private $wontEat = [];

    /**
     */
    private $drinks = [];

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getWontEat(): ?array
    {
        return $this->wontEat;
    }

    /**
     * @param array $wontEat
     * @return User
     */
    public function setWontEat(array $wontEat): self
    {
        $this->wontEat = $wontEat;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDrinks(): ?array
    {
        return $this->drinks;
    }

    /**
     * @param array $drinks
     * @return User
     */
    public function setDrinks(array $drinks): self
    {
        $this->drinks = $drinks;

        return $this;
    }
}
