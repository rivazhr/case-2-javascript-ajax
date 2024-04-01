<?php
date_default_timezone_set('Asia/Jakarta');
$date = date('H:i');
$username = $_POST['username'];
$pesanTeks = $_POST['pesanTeks'];

if (!empty($_FILES['pesanGambar']['name']) || !empty($_POST['pesanTeks'])) {
  if (isset($_FILES['pesanGambar']) && $_FILES['pesanGambar']['error'] === UPLOAD_ERR_OK) {
    $dest = 'uploads/' . $_POST['username'] . date('dmY_His') . $_FILES['pesanGambar']['name'];

    if (move_uploaded_file($_FILES['pesanGambar']['tmp_name'], $dest)) {
      $data = $date . "~|~" . $username . "~|~" . $pesanTeks . "~|~" . $dest;
      file_put_contents('chat.txt', $data . PHP_EOL, FILE_APPEND);
      echo "Upload sukses.";
    } else {
      echo "Upload gagal.";
    }
  } else {
    $data = $date . "~|~" . $username . "~|~" . $pesanTeks;
    file_put_contents('chat.txt', $data . PHP_EOL, FILE_APPEND);
    echo "Upload sukses.";
  }
}
