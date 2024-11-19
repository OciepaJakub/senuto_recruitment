<?php

namespace App\Models;

class User {
    private int $id;
    private string $name, $email;
    private bool $isSubscriber;

    public function __construct(int $id, string $name, string $email, ?bool $isSubscriber = false) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->isSubscriber = $isSubscriber;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getIsSubscriber(): bool {
        return $this->isSubscriber;
    }
}
