<?php

namespace ClawRock\ID3Global\Model\Values;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;

class Profile implements StdClassSerializableInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $version;

    public function __construct(string $id, int $version = 1)
    {
        $this->id      = $id;
        $this->version = $version;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'ID'      => $this->id,
            'Version' => $this->version
        ];
    }
}
