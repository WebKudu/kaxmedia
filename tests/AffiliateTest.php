<?php

namespace ryan;

class AffiliateTest extends \PHPUnit\Framework\TestCase
{
    private $testAffiliateData = ['affiliate_id' => 100, 'name' => 'Example',
        'latitude' => '40.748441', 'longitude' => '-73.985664'];

    public function testInstantiation()
    {
        $this->assertInstanceOf(
            Affiliate::class,
            new Affiliate($this->testAffiliateData),
            'Could not instantiate Affiliate'
        );
    }

    public function testRequiresAllFields()
    {
        $this->expectException(\Exception::class);

        new Affiliate(['affiliate_id' => 23, 'name' => 'Failure Example', 'latitude' => 40.748441]);
    }

    public function testRequiredFieldTypes()
    {
        $this->expectException(\TypeError::class);

        new Affiliate(['affiliate_id' => 23, 'name' => 'Failure Example', 'latitude' => '40.748441', 'longitude' => 'failure']);
    }


    public function testGetId()
    {
        $affiliate = new Affiliate($this->testAffiliateData);
        $this->assertEquals(100, $affiliate->getId(), 'Did not receive expected ID');
    }

    public function testGetName()
    {
        $affiliate = new Affiliate($this->testAffiliateData);
        $this->assertEquals('Example', $affiliate->getName(), 'Did not receive expected ID');
    }

    public function testDistanceFrom()
    {
        $affiliate = new Affiliate($this->testAffiliateData);
        // Expected distance calculated by https://gps-coordinates.org/distance-between-coordinates.php
        $this->assertEquals(
            5111.86,
            round($affiliate->distanceFrom(53.3340285, -6.2535495), 2),
            'Distance calculation incorrect'
        );
    }
}
