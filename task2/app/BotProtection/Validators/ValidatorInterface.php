<?php

namespace App\BotProtection\Validators;

interface ValidatorInterface {
   public function check(array $data): bool;
}
