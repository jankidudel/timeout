<?php

namespace App\Entity;

/**
 * Class Venue
 */
class Venue
{
    private $name;

    private $food = [];

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
     * @return Venue
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getFood(): ?array
    {
        return $this->food;
    }

    /**
     * @param array $food
     * @return Venue
     */
    public function setFood(array $food): self
    {
        $this->food = $food;

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
     * @return Venue
     */
    public function setDrinks(array $drinks): self
    {
        $this->drinks = $drinks;

        return $this;
    }
}
