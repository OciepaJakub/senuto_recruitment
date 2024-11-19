<?php

namespace App\Strategy;

use App\Models\User;

class UserSubscriptionStrategy implements CalculationStrategyInterface {
    public function calculateDiscount(User $user): float {
        return $user->getIsSubscriber() === true ? 0.25 : 0.00;
    }
}
