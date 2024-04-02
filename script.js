// Mendefinisikan username
let username = document.querySelector("#name").innerHTML;

// Menampilkan atau menyembunyikan chat
let sembunyikan = document.querySelector("button#minimize-chat");
let chat = document.querySelector("#chat-expand");
let bukaChat = document.querySelector("button#chat");
let mulaiChat = document.querySelector("button#mulaiChat")

mulaiChat.addEventListener("click", (e) => {
  perbaruiChat();
  chat.classList.remove("visually-hidden");
  bukaChat.classList.add("visually-hidden");
});

sembunyikan.addEventListener("click", (e) => {  
  chat.classList.add("visually-hidden");
  bukaChat.classList.remove("visually-hidden");
});

bukaChat.addEventListener("click", (e) => {
  perbaruiChat();
  chat.classList.remove("visually-hidden");
  bukaChat.classList.add("visually-hidden");
});

// Mengirim pesan
let sendPesan = document.querySelector('form#kirim-pesan > button[type="submit"]');
sendPesan.addEventListener("click", (e) => {
  e.preventDefault();

  let username = document.querySelector("#name").innerText;
  let pesanTeks = document.querySelector('input[name="pesan"]').value;
  let pesanGambar = document.querySelector('input[name="upfile"]').files[0];

  let formData = new FormData();
  formData.append("username", username);
  formData.append("pesanTeks", pesanTeks);
  formData.append("pesanGambar", pesanGambar);

  fetch("simpan_chat.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      perbaruiChat();
      return response.text();
    })
    .then((data) => {
      console.log(data);
      document.querySelector('input[name="pesan"]').value = "";
      document.querySelector('input[name="upfile"]').value = "";
    })
    .catch((error) => console.error("Error:", error));
});

// Menampilkan chat terbaru
setInterval(perbaruiChat, 5000);
let ruang = document.querySelector("#ruang");
function perbaruiChat() {
  ruang.innerHTML = "";
  fetch("ambil_chat.php")
    .then((response) => response.text())
    .then((data) => {
      const lines = data.split("\n");

      lines.forEach((line) => {
        const parts = line.split("~|~");
        let waktu = parts[0];
        let usn = parts[1];
        let teks = parts[2];
        let gambar = parts[3];

        if (teks != null || gambar != null) {
          const newChat = document.createElement("div");
          if (usn == username) newChat.className = "chatPengirim";
          else newChat.className = "chatPenerima";

          if (gambar != null)
            newChat.innerHTML += `<img class='img-fluid w-100' src="${gambar}">`;
          newChat.innerHTML += teks;
          newChat.innerHTML += `<div class="waktu d-flex pt-2">${waktu}</div>`;
          ruang.appendChild(newChat);
        }
      });
      ruang.scrollTop = ruang.scrollHeight;
    })
    .catch((error) => console.error("Error:", error));
}
