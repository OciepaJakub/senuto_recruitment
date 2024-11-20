<?php

namespace App\BotProtection;

use App\BotProtection\Validators\QuestionProviderInterface;
use App\BotProtection\Validators\QuestionValidator;
use App\BotProtection\Validators\SpeedCheckValidator;
use App\BotProtection\Validators\UserAgentValidator;

class BotProtection {
    private static ?BotProtection $instance = null;

    private array $validators;

    protected function __construct() {
        $this->validators = [
            new QuestionValidator,
            new SpeedCheckValidator,
            new UserAgentValidator,
        ];
    }

    protected function __clone() {}
    public function __wakeup() {}

    public static function getInstance(): BotProtection {
        if (self::$instance === null) {
            self::$instance = new BotProtection();
        }
        
        return self::$instance;
    }

    public function processFormData(array $data): bool {
        foreach ($this->validators as $validator) {
            if (!$validator->check($data)) {
                return false;
            }
        }

        return true;
    }

    public function getSimpleQuestion(): string {
        foreach ($this->validators as $validator) {
            if ($validator instanceof QuestionProviderInterface) {
                return $validator->getQuestion();
            }
        }
    }
}
