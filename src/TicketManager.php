<?php
namespace TicketApp;

class TicketManager {
    private $dataFile = '../data/tickets.json';
    
    public function __construct() {
        // Create data directory if it doesn't exist
        if (!file_exists('../data')) {
            mkdir('../data', 0755, true);
        }
        
        // Initialize with sample data if file doesn't exist
        if (!file_exists($this->dataFile)) {
            $initialData = [
                [
                    'id' => 1,
                    'title' => 'Login issue on mobile',
                    'description' => 'Users are unable to login from mobile devices',
                    'status' => 'open',
                    'priority' => 'high',
                    'createdAt' => date('c', strtotime('2024-01-15')),
                    'updatedAt' => date('c', strtotime('2024-01-15'))
                ],
                [
                    'id' => 2,
                    'title' => 'Dashboard loading slow',
                    'description' => 'Dashboard takes more than 10 seconds to load data',
                    'status' => 'in_progress',
                    'priority' => 'medium',
                    'createdAt' => date('c', strtotime('2024-01-14')),
                    'updatedAt' => date('c', strtotime('2024-01-15'))
                ]
            ];
            file_put_contents($this->dataFile, json_encode($initialData));
        }
    }
    
    public function getAllTickets() {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->dataFile), true) ?: [];
    }
    
    public function getTicket($id) {
        $tickets = $this->getAllTickets();
        foreach ($tickets as $ticket) {
            if ($ticket['id'] == $id) {
                return $ticket;
            }
        }
        return null;
    }
    
   public function createTicket($data) {
        $tickets = $this->getAllTickets();
        
        $newTicket = [
            'id' => time(),
            'title' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'status' => $data['status'] ?? 'open',
            'priority' => $data['priority'] ?? 'medium',
            'createdAt' => date('c'),
            'updatedAt' => date('c')
        ];
        
        $tickets[] = $newTicket;
        $this->saveTickets($tickets);
        
        // Set success message in session
        $_SESSION['toast'] = [
            'message' => 'Ticket created successfully!',
            'type' => 'success'
        ];
        
        return $newTicket;
    }
    
    public function updateTicket($id, $data) {
        $tickets = $this->getAllTickets();
        
        foreach ($tickets as &$ticket) {
            if ($ticket['id'] == $id) {
                $ticket['title'] = $data['title'] ?? $ticket['title'];
                $ticket['description'] = $data['description'] ?? $ticket['description'];
                $ticket['status'] = $data['status'] ?? $ticket['status'];
                $ticket['priority'] = $data['priority'] ?? $ticket['priority'];
                $ticket['updatedAt'] = date('c');
                break;
            }
        }
        
        $this->saveTickets($tickets);
        
        // Set success message
        $_SESSION['toast'] = [
            'message' => 'Ticket updated successfully!',
            'type' => 'success'
        ];
    }
    
    public function deleteTicket($id) {
        $tickets = $this->getAllTickets();
        $tickets = array_filter($tickets, function($ticket) use ($id) {
            return $ticket['id'] != $id;
        });
        $this->saveTickets(array_values($tickets));
        
        // Set success message
        $_SESSION['toast'] = [
            'message' => 'Ticket deleted successfully!',
            'type' => 'success'
        ];
    }
    
    public function getStats() {
        $tickets = $this->getAllTickets();
        
        return [
            'total' => count($tickets),
            'open' => count(array_filter($tickets, function($t) { return $t['status'] === 'open'; })),
            'in_progress' => count(array_filter($tickets, function($t) { return $t['status'] === 'in_progress'; })),
            'closed' => count(array_filter($tickets, function($t) { return $t['status'] === 'closed'; }))
        ];
    }
    
    private function saveTickets($tickets) {
        file_put_contents($this->dataFile, json_encode($tickets, JSON_PRETTY_PRINT));
    }
}
