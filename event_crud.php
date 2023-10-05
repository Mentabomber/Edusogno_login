<?php

class Event {
    public $title;
    public $dataEvento;
    public $attendees;
    public $description;

    public function __construct($title, $dataEvento, $attendees, $description) {
        $this->title = $title;
        $this->dataEvento = $dataEvento;
        $this->attendees = $attendees;
        $this->description = $description;
    }
}

class EventController {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addEvent(Event $event) {
        $title = $this->conn->real_escape_string($event->title);
        $dataEvento = $this->conn->real_escape_string($event->dataEvento);
        $attendees = $this->conn->real_escape_string($event->attendees);
        $description = $this->conn->real_escape_string($event->description);

        $sql = "INSERT INTO `eventi` (nome_evento, data_evento, attendees, description) VALUES ('$title', '$dataEvento', '$attendees', '$description')";
        $this->conn->query($sql);
        header('Location: admin_dashboard.php' );
    }

    public function editEvent($id, Event $event) {
        $title = $this->conn->real_escape_string($event->title);
        $dataEvento = $this->conn->real_escape_string($event->dataEvento);
        $attendees = $this->conn->real_escape_string($event->attendees);
        $description = $this->conn->real_escape_string($event->description);

        $sql = "UPDATE events SET title='$title', dataEvento='$dataEvento', attendees='$attendees', description='$description' WHERE id=$id";
        $this->conn->query($sql);
    }

    public function deleteEvent($id) {
        $sql = "DELETE FROM events WHERE id=$id";
        $this->conn->query($sql);
    }

    public function getAllEvents() {
        $events = [];

        $sql = "SELECT * FROM events";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $events[] = new Event($row['title'], $row['dataEvento'], $row['attendees'], $row['description']);
            }
        }

        return $events;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// // Example usage:
// // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with actual values
// $eventController = new EventController('your_host', 'your_username', 'your_password', 'your_database');

// // Add an event
// $eventController->addEvent(new Event('Event Title', '2023-01-01', 'Attendee 1, Attendee 2', 'Event Description'));

// // Edit an event (assuming there is an event with id=1)
// $eventController->editEvent(1, new Event('Updated Event Title', '2023-02-01', 'New Attendee 1, New Attendee 2', 'Updated Event Description'));

// // Delete an event (assuming there is an event with id=2)
// $eventController->deleteEvent(2);

// // Get all events
// $allEvents = $eventController->getAllEvents();
// print_r($allEvents);

// // Close the database connection
// $eventController->closeConnection();
?>
