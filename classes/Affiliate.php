<?php

namespace ryan;

class Affiliate
{
    private const RADIUS_OF_EARTH = 6371;

    private int $id;
    private string $name;
    private float $lat;
    private float $long;

    public function __construct(array $data)
    {
        if (!isset($data['affiliate_id']) || !isset($data['name']) || !isset($data['latitude']) || !isset($data['longitude'])) {
            throw new \Exception('Missing one or more expected fields');
        }

        $this->id = $data['affiliate_id'];
        $this->name = $data['name'];
        $this->lat = $data['latitude'];
        $this->long = $data['longitude'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function distanceFrom(float $destinationLat, float $destinationLong): float
    {
        $myLat = deg2rad($this->lat);
        $targetLat = deg2rad($destinationLat);
        $deltaLong = deg2rad(abs($this->long - $destinationLong));

        $centralAngle = acos(sin($myLat) * sin($targetLat) + cos($myLat) * cos($targetLat) * cos($deltaLong));

        return self::RADIUS_OF_EARTH * $centralAngle;
    }
}
