<?php

namespace App\Strategy;

use App\Models\User;

interface CalculationStrategyInterface {
    public function calculateDiscount(User $user): float;
}
