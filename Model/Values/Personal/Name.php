<?php

namespace ClawRock\ID3Global\Model\Values\Personal;

class Name
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $firstname, string $lastname, string $title = null)
    {
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->title     = $title;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
