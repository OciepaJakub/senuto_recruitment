<?php

namespace App\BotProtection\Validators;

interface QuestionProviderInterface {
    public function getQuestion(): string;
}