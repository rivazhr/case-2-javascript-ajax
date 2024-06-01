<dialog id="update" class="p-5 rounded shadow" close>
  <h3 class="mb-5 fw-semibold text-center">Perbarui</h3>
  <form id="updateForm" class="flex-grow-1" method="post" action="index.php">
    <p>Username</p>
    <div class="form-group flex-grow-1 mb-3">
      <input type="text" class="form-control" name="username" readonly>
    </div>
    <p>Nama</p>
    <div class="form-group flex-grow-1 mb-3">
      <input type="text" class="form-control" name="name" required>
    </div>
    <p>Chat dengan</p>
    <div class="form-group flex-grow-1 mb-5">
      <select id="receiver" class="form-control" name="receiver" required>
        <option value="">Pilih User</option>
        <?php foreach ($users as $user) : ?>
          <option value="<?= $user['user_id'] ?>"><?= $user['user_id'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="d-flex">
      <button class="btn btn-custom mt-auto flex-fill me-2" type="submit">Simpan</button>
      <button class="btn btn-outline-dark mt-auto flex-fill" id="batal">Batal</button>
    </div>
  </form>
</dialog>