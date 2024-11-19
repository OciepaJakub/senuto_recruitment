<?php

require_once __DIR__ . '/autoload.php';

use App\Database\DatabaseConnection;
use App\Repository\UserRepository;
use App\Strategy\UserSubscriptionStrategy;

$dbConnection = DatabaseConnection::getInstance();
$userRepository = new UserRepository($dbConnection);

$user = $userRepository->findById(1);

$subscriptionStrategy = new UserSubscriptionStrategy();
$subscriptionPrice = $subscriptionStrategy->calculateDiscount($user);

echo "Zniżka wynosi: " . $subscriptionPrice * 100 . "%". PHP_EOL;
