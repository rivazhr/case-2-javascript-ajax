<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="img\flowers.png" type="image/x-icon">
  <title>Selamat Datang!</title>
</head>

<?php include "header.html" ?>

<body>
  <div class="container">

    <!-- Header -->
    <div class="row justify-content-between">
      <div class="col d-flex flex-column justify-content-center pe-5">
        <h1 class="my-3">Selamat Datang!</h1>
        Kami adalah platform yang menyediakan fitur chat yang dirancang untuk memfasilitasi komunikasi langsung antara teman-teman. Dengan fitur seperti pesan teks sehingga dapat berbagi kabar dan bertukar sapa.
        <div class="mt-5 text-center">
          <button id="mulaiChat" class="p-3 rounded-3 w-75 btn-custom mb-3">Mulai Sekarang</button>
          <p class="text-body-secondary">Atau klik tombol di pojok kanan bawah</p>
        </div>
      </div>
      <div class="col d-flex justify-content-end">
        <img src="img\image.svg" class="img-fluid" alt="">
      </div>
    </div>

    <!-- Fitur Chat -->
    <div class="container p-0 d-flex sticky-bottom justify-content-end z-0">
      <!-- Minimized Chat -->
      <button id="chat"><img src="img\chat-button.svg" class="img-fluid" alt=""></button>

      <!-- Expanded Chat -->
      <div id="chat-expand" class="visually-hidden rounded-3 bg-white d-flex flex-column shadow-sm mb-4">
        <div class="bg-primary rounded-top-3 p-3 text-white d-flex align-items-center">
          <img class="me-2" style="width: 45px;" src="img\foto-profil.svg" alt="">
          <h6 id=name class="mx-3 my-0 w-100">Rere</h6>
          <button id="minimize-chat"><img src="img/minimize-button.svg" alt=""></button>
        </div>

        <!-- Ruang Chat Pengguna -->
        <div id="ruang" class="d-flex flex-column h-100">
        </div>

        <div class="mx-3">
          <hr>
        </div>

        <!-- Form Chat Pengguna -->
        <div id="kirim" class="p-3 pt-0">
          <form action="" id="kirim-pesan" class="d-flex align-items-center" enctype="multipart/form-data" autocomplete="off">
            <label for="upfile" id="upfile-label"><img src="img/add-file-button.svg" alt=""></label>
            <input type="file" name="upfile" id="upfile" class="d-none">
            <input type="text" id="pesan" name="pesan" class="form-control flex-grow-1 me-2" placeholder="Ketikkan sesuatu di sini...">
            <button type="submit"><img src="img/send-button.svg" alt=""></button>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>
<?php include "footer.html" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
<script src="script.js"> </script>

</html>