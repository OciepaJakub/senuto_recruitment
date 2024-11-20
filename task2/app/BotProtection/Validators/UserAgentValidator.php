<?php

namespace App\BotProtection\Validators;

class UserAgentValidator implements ValidatorInterface {
    private array $agentsToBlock = [
        '360Spider', 'acapbot', 'acoonbot', 'ahrefs', 'alexibot'
    ];

    public function check(array $data): bool {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        foreach ($this->agentsToBlock as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return false;
            }
        }
        
        return true;
    }
}
