<?php

class ChatModel extends Model
{
  private $conn;
  private $sender;
  private $senderName;
  private $receiver;
  private $receiverName;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function createUser($username, $name)
  {
    $query = "INSERT INTO USER VALUES ('$username', '$name')";
    $result = $this->conn->query($query);

    return $username;
  }

  public function getUsers()
  {
    $query = "SELECT user_id, user_name FROM user ORDER BY user_name";
    $result = $this->conn->query($query);

    $users = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $users[] = $row;
      }
    }

    return $users;
  }

  public function update($id, $name, $receiver)
  {
    $query = "UPDATE user SET user_name = '$name' WHERE user_id = '$id'";
    $result = $this->conn->query($query);

    if ($result) {
      $this->senderName = $name;
      $this->setReceiver($receiver);
      return ['sender_name' => $this->senderName, 'receiver_id' => $this->receiver, 'receiver_name' => $this->receiverName];
    }
  }

  public function setSender($sender)
  {
    $query = "SELECT user_id, user_name FROM user WHERE user_id = '$sender'";
    $result = $this->conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $this->sender = $row['user_id'];
      $this->senderName = $row['user_name'];
    }
  }

  public function setReceiver($receiver)
  {
    $query = "SELECT user_id, user_name FROM user WHERE user_id = '$receiver'";
    $result = $this->conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $this->receiver = $row['user_id'];
      $this->receiverName = $row['user_name'];
    }
  }

  public function getSender()
  {
    return ['id' => $this->sender, 'name' => $this->senderName];
  }

  public function getReceiver()
  {
    return ['id' => $this->receiver, 'name' => $this->receiverName];
  }

  public function sendChat($sender, $receiver, $chat)
  {
    $query = "INSERT INTO chat (sender_id, receiver_id, chat_text) VALUES ('$sender', '$receiver', '$chat')";
    $result = $this->conn->query($query);

    return $chat;
  }

  public function getAllChats($sender, $receiver)
  {
    $query = "SELECT chat_id, sender_id, receiver_id, chat_text, read_status, time_sent FROM chat WHERE (sender_id = '$sender' AND receiver_id = '$receiver') OR (sender_id = '$receiver' AND receiver_id = '$sender')";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $chats = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $chats[] = $row;

        // Memperbarui status dibaca
        if ($row['sender_id'] == $receiver) {
          $updateQuery = "UPDATE chat SET read_status = TRUE WHERE chat_id = ?";
          $updateStmt = $this->conn->prepare($updateQuery);
          $updateStmt->bind_param("i", $row['chat_id']);
          $updateStmt->execute();
          $updateStmt->close();
        }
      }
    }

    $stmt->close();
    return $chats;
  }
}
