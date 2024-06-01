<dialog id="register" class="p-5 rounded shadow" close>
  <h3 class="mb-5 fw-semibold text-center">Daftar</h3>
  <form id="registerForm" class="flex-grow-1" method="post" action="index.php">
    <p>Username</p>
    <div class="form-group flex-grow-1 mb-3">
      <input type="text" class="form-control" name="username" placeholder="Masukkan username..." required>
    </div>
    <p>Nama</p>
    <div class="form-group flex-grow-1 mb-5">
      <input type="text" class="form-control" name="name" placeholder="Masukkan nama..." required>
    </div>
    <div class="d-flex">
      <button class="btn btn-outline-dark mt-auto flex-fill me-2" id="masuk">Masuk</button>
      <button class="btn btn-custom mt-auto flex-fill" type="submit">Daftar</button>
    </div>
  </form>
</dialog>