<?php
require_once './vendor/autoload.php';
require_once './src/Auth.php';
require_once './src/TicketManager.php';

session_start();

// Setup Twig - FIXED PATH
$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);

$auth = new TicketApp\Auth();
$ticketManager = new TicketApp\TicketManager();

// Check for toast messages from previous request
$toast = $_SESSION['toast'] ?? null;
if ($toast) {
    unset($_SESSION['toast']); 
}

$path = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

// Remove query string for routing
$path = strtok($path, '?');

switch ($path) {
    case '/':
        echo $twig->render('landing.html.twig', ['toast' => $toast]);
        break;
        
    case '/auth/login':
        if ($method === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($auth->login($email, $password)) {
                $_SESSION['toast'] = [
                    'message' => 'Welcome back!',
                    'type' => 'success'
                ];
                header('Location: /dashboard');
                exit;
            } else {
                echo $twig->render('login.html.twig', [
                    'error' => 'Invalid credentials',
                    'toast' => $toast
                ]);
            }
        } else {
            echo $twig->render('login.html.twig', ['toast' => $toast]);
        }
        break;
        
    case '/dashboard':
        if (!$auth->isLoggedIn()) {
            header('Location: /auth/login');
            exit;
        }
        
        $tickets = $ticketManager->getAllTickets();
        $stats = $ticketManager->getStats();
        
        echo $twig->render('dashboard.html.twig', [
            'user' => $auth->getUser(),
            'tickets' => $tickets,
            'stats' => $stats,
            'toast' => $toast
        ]);
        break;
        
    case '/tickets':
        if (!$auth->isLoggedIn()) {
            header('Location: /auth/login');
            exit;
        }
        
        if ($method === 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'create') {
                $ticketManager->createTicket($_POST);
                header('Location: /tickets');
                exit;
            } elseif ($action === 'update') {
                $ticketManager->updateTicket($_POST['id'], $_POST);
                header('Location: /tickets');
                exit;
            } elseif ($action === 'delete') {
                $ticketManager->deleteTicket($_POST['id']);
                header('Location: /tickets');
                exit;
            }
        }
        
        $tickets = $ticketManager->getAllTickets();
        $filter = $_GET['filter'] ?? 'all';
        
        if ($filter !== 'all') {
            $tickets = array_filter($tickets, function($ticket) use ($filter) {
                return $ticket['status'] === $filter;
            });
        }
        
        echo $twig->render('tickets.html.twig', [
            'user' => $auth->getUser(),
            'tickets' => $tickets,
            'filter' => $filter,
            'stats' => $ticketManager->getStats(),
            'toast' => $toast
        ]);
        break;
        
    case '/logout':
        $auth->logout();
        $_SESSION['toast'] = [
            'message' => 'Logged out successfully',
            'type' => 'success'
        ];
        header('Location: /');
        exit;
        
    default:
        http_response_code(404);
        echo $twig->render('404.html.twig', ['toast' => $toast]);
        break;
}