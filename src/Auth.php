<?php
namespace TicketApp;

class Auth {
    public function isLoggedIn() {
        return isset($_SESSION['user']);
    }
    
    public function getUser() {
        return $_SESSION['user'] ?? null;
    }
    
    public function login($email, $password) {
        // Mock authentication - same credentials
        if ($email === 'demo@example.com' && $password === 'password123') {
            $_SESSION['user'] = [
                'id' => 1,
                'email' => $email,
                'name' => 'Demo User'
            ];
            return true;
        }
        return false;
    }
    
    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
    }
}