<?php
require_once 'model/ChatModel.php';

class ChatController
{
  public $chatModel;

  public function __construct($chatModel)
  {
    $this->chatModel = $chatModel;
  }

  public function index()
  {
    $users = $this->chatModel->getUsers();
    require './view/home.php';
  }

  public function login($sender, $receiver)
  {
    $this->chatModel->setSender($sender);
    $this->chatModel->setReceiver($receiver);
  }
}
