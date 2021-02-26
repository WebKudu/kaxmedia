<?php

namespace ryan;

class AffiliateRepositoryTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(
            AffiliateRepository::class,
            new AffiliateRepository(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
                'data' . DIRECTORY_SEPARATOR . 'affiliates.txt'),
            'Could not instantiate AffiliateRepository with affiliates.txt'
        );
    }

    public function testFileNotFound()
    {
        $this->expectException(\Exception::class);

        new AffiliateRepository(__DIR__ . DIRECTORY_SEPARATOR . 'nonexistent.txt');
    }

    public function testGet()
    {
        $affiliates = new AffiliateRepository(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR . 'affiliates.txt');

        $this->assertTrue(
            count($affiliates->get()) == 32 && $affiliates->get()[0] instanceof Affiliate,
            'Did not receive the expected amount of Affiliates'
        );
    }

    public function testAffiliatesAreOrdered()
    {
        $affiliates = new AffiliateRepository(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR . 'affiliates.txt');

        $previousId = -1;
        foreach ($affiliates->get() as $affiliate) {
            if ($affiliate->getId() < $previousId) {
                $this->fail('Affiliates are not properly ordered');
            }
            $previousId = $affiliate->getId();
        }

        $this->assertTrue(true);
    }
}
