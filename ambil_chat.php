<?php
// Membaca file chat.txt ke dalam array
$lines = file('chat.txt');

foreach ($lines as $line) {
  echo $line;
}
