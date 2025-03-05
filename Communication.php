<?php
include 'config.php';
class Communication {
    private $messageID;
    private $sender;
    private $receiver;
    private $messageText;
    private $timestamp;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function sendMessage($sender, $receiver, $messageText) {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->messageText = $messageText;
        $this->timestamp = date("Y-m-d H:i:s");

        $query = "INSERT INTO communication (sender, receiver, messageText, timestamp) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $this->sender, $this->receiver, $this->messageText, $this->timestamp);
        return $stmt->execute();
    }

    public function receiveMessage($receiver) {
        $query = "SELECT * FROM communication WHERE receiver = ? ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $receiver);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function viewAnnouncements() {
        $query = "SELECT * FROM communication WHERE receiver = 'ALL' ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
