<?php

namespace App\BotProtection\Validators;

class SpeedCheckValidator implements ValidatorInterface {
    const MAX_SUBMIT_INTERVAL = 10;

    public function check(array $data): bool {
        $lastSubmissionTime = $_SESSION['last_submission_time'] ?? 0;
        $currentTime = time();

        if (($currentTime - $lastSubmissionTime) < self::MAX_SUBMIT_INTERVAL) {
            return false;
        }

        $_SESSION['last_submission_time'] = $currentTime;
        
        return true;
    }
}
