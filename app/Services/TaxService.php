<?php

namespace App\Services;

class TaxService
{
    public function getRates()
    {
        // Mock external API
        return [
            "Electronics" => 0.15,
            "Office" => 0.05,
            "Default" => 0.10
        ];
    }
}