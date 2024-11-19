<?php

namespace App\Database;

class DatabaseConnection {
    private static ?DatabaseConnection $instance = null;

    private function __construct() {
        // Db connection
    }

    public static function getInstance(): DatabaseConnection {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): self {
        return $this;
    }

    public function prepare(string $query) {
        return $this;
    }

    public function execute(array $params = []) {
        return $this;
    }

    public function fetch(int $fetch_style) {
        if ($fetch_style === \PDO::FETCH_ASSOC) {
            return [
                'id' => 1,
                'name' => 'Jakub Ociepa',
                'email' => 'ocjakub@gmail.com',
                'isSubscriber' => true,
            ];
        }

        return null;
    }
}
