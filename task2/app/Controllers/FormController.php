<?php

namespace App\Controllers;

use App\BotProtection\BotProtection;

class FormController {
    public function __construct(public readonly BotProtection $botProtection){}

    public function store(): array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            $isValid = $this->botProtection->processFormData($data);

            if (!$isValid) {
                return ['error' => 'Form submission failed'];
            }

            return ['success' => 'Form submission successful'];
        }
    }

    public function getSimpleQuestion(): array {
        $question = $this->botProtection->getSimpleQuestion();

        return ['question' => $question];
    }
}
