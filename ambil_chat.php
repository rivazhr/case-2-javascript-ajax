<?php
// Membaca file chat.txt
$file = fopen('chat.txt', 'r');

if ($file) {
  while (($line = fgets($file)) != false) {
    echo $line;
  }
}
