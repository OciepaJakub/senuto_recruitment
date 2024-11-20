<?php

namespace App\BotProtection\Validators;

class QuestionValidator implements ValidatorInterface, QuestionProviderInterface {
    private array $questions = [
        'What is 1 + 1?' => '2',
        'What is the capital of France?' => 'Paris',
        'What color is the sky?' => 'blue',
    ];

    public function check(array $data): bool {
        $question = $data['question'] ?? '';
        $answer = $data['answer'] ?? '';
        
        return $this->validateAnswer($question, $answer);
    }

    public function getQuestion(): string {
        $keys = array_keys($this->questions);

        return $keys[array_rand($keys)];
    }

    private function validateAnswer(string $question, string $answer): bool {
        $correctAnswer = $this->questions[$question] ?? '';

        return $correctAnswer === $answer;
    }
}
