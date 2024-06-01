<?php
require_once 'model/Model.php';
require_once 'model/ChatModel.php';
require_once 'controller/ChatController.php';

$db = new Model();
$conn = $db->connect();
$chatModel = new ChatModel($conn);
$controller = new ChatController($chatModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['chat']) && isset($_POST['sender']) && isset($_POST['receiver'])) {
    $chat = $controller->chatModel->sendChat($_POST['sender'], $_POST['receiver'], $_POST['chat']);

    header('Content-Type: application/json');
    echo json_encode(['chat' => $chat]);
    exit;
  }

  if (isset($_POST['sender']) && isset($_POST['receiver'])) {
    $controller->login($_POST['sender'], $_POST['receiver']);
    $sender = $controller->chatModel->getSender();
    $receiver = $controller->chatModel->getReceiver();

    header('Content-Type: application/json');
    echo json_encode(['sender' => $sender, 'receiver' => $receiver]);
    exit;
  }

  if (isset($_POST['username']) && isset($_POST['name']) && isset($_POST['receiver'])) {
    $update = $controller->chatModel->update($_POST['username'], $_POST['name'], $_POST['receiver']);

    header('Content-Type: application/json');
    echo json_encode(['update' => $update]);
    exit;
  }

  if (isset($_POST['username']) && isset($_POST['name'])) {
    $user = $controller->chatModel->createUser($_POST['username'], $_POST['name']);
    exit;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getAllChats') {
  $chats = $controller->chatModel->getAllChats($_GET['sender'], $_GET['receiver']);
  header('Content-Type: application/json');
  echo json_encode(['chats' => $chats]);
  exit;
}

$controller->index();
