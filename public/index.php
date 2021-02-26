<?php

namespace ryan;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .
    'autoload.php';

const DUBLIN_LAT = 53.3340285;
const DUBLIN_LONG = -6.2535495;

$affiliates = new AffiliateRepository(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
    'data' . DIRECTORY_SEPARATOR . 'affiliates.txt');

foreach ($affiliates->get() as $affiliate) {
    if ($affiliate->distanceFrom(DUBLIN_LAT, DUBLIN_LONG) <= 100) {
        echo "{$affiliate->getName()} : {$affiliate->getId()}<br />";
    }
}
