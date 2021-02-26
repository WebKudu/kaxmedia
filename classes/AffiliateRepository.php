<?php

namespace ryan;

class AffiliateRepository
{
    private $affiliates = [];

    public function __construct(string $file)
    {
        if (!file_exists($file)) {
            throw new \Exception("File $file not found!");
        }
        if (!is_readable($file)) {
            throw new \Exception("File $file exists, but is not readable!");
        }

        $filePointer = fopen($file, 'r');
        if (!$filePointer) {
            throw new \Exception("Could not open file $file for reading!");
        }

        while (($affiliateRow = fgets($filePointer)) !== false) {
            $this->affiliates[] = new Affiliate(json_decode($affiliateRow, true));
        }

        if (!feof($filePointer)) {
            trigger_error('Non-fatal issue reading affiliates list.', E_USER_WARNING);
        }

        fclose($filePointer);

        $this->orderAffiliates();
    }

    public function get(): array
    {
        return $this->affiliates;
    }

    private function orderAffiliates(): void
    {
        usort($this->affiliates, function ($a, $b) {
            return $a->getId() <=> $b->getId();
        });
    }
}
