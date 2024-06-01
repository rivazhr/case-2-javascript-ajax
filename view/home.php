<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="icon" href="resources/img/flowers.png" type="image/x-icon">
  <title>Selamat Datang!</title>
  <script src=".\resources\js\jquery.js"></script>
  <script src=".\resources\js\script.js"></script>
</head>

<?php include "header.html" ?>

<body class="d-flex flex-column min-vh-100">

  <!-- Dialog Masuk -->
  <?php include "dialog/dialog-login.php" ?>

  <!-- Dialog Buat Username -->
  <?php include "dialog/dialog-register.php" ?>

  <!-- Dialog Ubah Username -->
  <?php include "dialog/dialog-update.php" ?>

  <div class="container flex-grow-1 py-5">

    <!-- Header Row -->
    <div class="row">
      <!-- Image Column -->
      <div class="col-md-6 col-12 order-md-2 order-1 d-flex justify-content-center">
        <div class="d-flex align-items-center ">
          <img src="resources/img/image.svg" style="height: 25rem;" class="img-fluid" alt="">
        </div>
      </div>
      <!-- Text Column -->
      <div class="col-md-6 col-12 order-md-1 order-2 d-flex align-items-center">
        <div class="d-flex flex-column justify-content-center h-100">
          <div class="flex-grow-1 d-flex flex-column justify-content-center">
            <h1>Selamat Datang!</h1>
            <p>Kami adalah platform yang menyediakan fitur chat yang dirancang untuk memfasilitasi komunikasi langsung antara teman-teman. Dengan fitur seperti pesan teks sehingga dapat berbagi kabar dan bertukar sapa.</p>
          </div>
          <div class="mt-4 text-center d-flex flex-column justify-content-end align-items-center">
            <button id="mulaiChat" class="p-3 rounded-3 w-75 btn-custom mb-3">Mulai Sekarang</button>
            <p class="text-body-secondary">Atau klik tombol di pojok kanan bawah</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Fitur Chat -->
    <div class="container p-0 d-flex sticky-bottom justify-content-end z-0">

      <!-- Minimized Chat -->
      <button id="chat"><img src="resources\img\chat-button.svg" class="img-fluid" alt=""></button>

      <!-- Expanded Chat -->
      <div id="chat-expand" class="rounded-3 bg-white shadow-sm mb-4">
        <div class="bg-primary rounded-top-3 p-3 text-white d-flex align-items-center">
          <img id="receiver-profile" src="resources\img\foto-profil.svg" style="width: 45px;" alt="Receiver Profile">
          <h6 id="receiver-name" class="mx-3 my-0 w-100"></h6>
          <button id="edit"><img src="resources/img/edit-button.svg" alt="Edit Button"></button>
          <button id="minimize-chat"><img src="resources/img/minimize-button.svg" alt="Minimize Chat"></button>
        </div>

        <!-- Ruang Chat Pengguna -->
        <div id="ruang" class="d-flex flex-column h-100">
        </div>

        <div class="mx-3">
          <hr>
        </div>

        <!-- Form Chat Pengguna -->
        <div id="kirim" class="p-3 pt-0">
          <form action="" id="kirim-pesan" class="d-flex align-items-center" autocomplete="off">
            <input type="text" id="pesan" name="pesan" class="form-control flex-grow-1 me-2" placeholder="Ketikkan sesuatu di sini...">
            <button type="submit"><img src="resources/img/send-button.svg" alt=""></button>
          </form>
        </div>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php include "footer.html" ?>

</html>