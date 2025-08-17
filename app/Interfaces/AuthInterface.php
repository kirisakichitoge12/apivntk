<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function login(array $credentials);
    public function logout();
    public function register(array $data);
    public function sendAccountVerificationEmail(string $email, string $token);
    public function findByEmailVerificationToken($token);
    public function sendPasswordResetEmail(string $email, string $token);
}
