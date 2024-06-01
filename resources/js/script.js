let ruang;
let sender_id;
let sender_name;
let receiver_id;
let receiver_name;

$(() => {
  ruang = $("#ruang");
  $("#logout").hide();
  $("#chat-expand").hide();

  // Menampilkan atau menyembunyikan chat
  $("#mulaiChat, #chat, #minimize-chat").click(function () {
    $("#chat-expand").toggle();
    $("#chat").toggle();
    updateChat(true);
  });

  // Keluar
  $("#logout").click(function(e){
    $(location).attr("href", "index.php");
  });

  // Dialog login atau register
  let loginDialog = $("#login")[0];
  let registerDialog = $("#register")[0];
  if (loginDialog.showModal) {
    loginDialog.showModal();
  }

  $("#daftar").click(function (e) {
    e.preventDefault();
    loginDialog.close();
    registerDialog.showModal();
  });

  $("#masuk").click(function (e) {
    e.preventDefault();
    registerDialog.close();
    loginDialog.showModal();
  });

  // Menyembunyikan opsi user yang sama sebagai penerima
  $("#username").change(function () {
    let selectedUser = $(this).val();
    $("#receiver option").show();
    $("#receiver option[value='" + selectedUser + "']").hide();
  });

  // Menyimpan informasi user (sender dan receiver)
  $(document).on("submit", "#loginForm", function (e) {
    e.preventDefault();
    let username = $("#username").val();
    let receiver = $("#receiver").val();

    $.post("index.php", {
      sender: username,
      receiver: receiver,
    })
      .done(function (response) {
        sender_id = response.sender.id;
        sender_name = response.sender.name;
        receiver_id = response.receiver.id;
        receiver_name = response.receiver.name;
        $("#receiver-name").text(receiver_name);
        loginDialog.close();
        $("#logout").show();
      })
      .fail(function (error) {
        console.error("Error:", error);
      });
  });

  $(document).on("submit", "#registerForm", function (e) {
    e.preventDefault();
    let username = $("input[name='username']").val();
    let name = $("input[name='name']").val();

    $.post("index.php", {
      username: username,
      name: name,
    })
      .done(function () {
        $(location).attr("href", "index.php");
      })
      .fail(function (error) {
        console.error("Error:", error);
      });
    $("form#registerForm")[0].reset();
  });

  // Menangani update user
  let updateDialog = $("#update")[0];
  $("#edit").click(function (e) {
    updateDialog.showModal();
    $("#updateForm input[name='username']").val(sender_id);
    $("#updateForm input[name='name']").val(sender_name);
    $("#updateForm select[name='receiver']").val(receiver_id);

    $("button#batal").click(function (e) {
      updateDialog.close();
    });

    $(document).on("submit", "#updateForm", function (e) {
      e.preventDefault();
      let sender = $("#updateForm input[name='name']").val();
      let receiver = $("#updateForm select[name='receiver']").val();

      $.post("index.php", {
        username: sender_id,
        name: sender,
        receiver: receiver,
      }).done(function (response) {
        updateDialog.close();
        sender_name = response.update.sender_name;
        receiver_id = response.update.receiver_id;
        receiver_name = response.update.receiver_name;
        $("#receiver-name").text(receiver_name);
        updateChat(true);
      });
    });
  });

  // Menyimpan chat ke database dan memperbarui chat
  $(document).on("submit", "form#kirim-pesan", function (e) {
    e.preventDefault();
    let pesan = $("input[name='pesan']").val();

    $.post("index.php", {
      sender: sender_id,
      receiver: receiver_id,
      chat: pesan,
    })
      .done(function (response) {
        console.log("Message sent:", response.chat);
        updateChat(true);
      })
      .fail(function (error) {
        console.error("Error:", error);
      });

    $("form#kirim-pesan")[0].reset();
  });
});

// Memperbarui chat
function updateChat(scrollToBottom = false) {
  $.get("index.php", {
    action: "getAllChats",
    sender: sender_id,
    receiver: receiver_id,
  })
    .done(function (response) {
      let ruangContent = "";
      let chats = response.chats;

      chats.forEach((chat) => {
        ruangContent += newChat(chat);
      });
      ruang.html(ruangContent);
      if (scrollToBottom)
        setTimeout(() => {
          ruang.scrollTop(ruang[0].scrollHeight);
        }, 0);
    })
    .fail(function (error) {
      console.error("Error:", error);
    });

  setTimeout(updateChat, 1000);
}

// Membuat tampilan bubble chat
function newChat(chat) {
  let time_sent = formatTime(chat["time_sent"]);
  let sender = chat["sender_id"];
  let chat_text = chat["chat_text"];
  let read_status = chat["read_status"] ? "read" : "sent";

  if (chat_text != null) {
    const newChat = document.createElement("div");
    newChat.innerHTML += chat_text;
    if (sender == sender_id) {
      newChat.className = "chatPengirim";
      newChat.innerHTML += `<div class="waktu d-flex pt-2">${time_sent} ${read_status}</div>`;
    } else {
      newChat.className = "chatPenerima";
      newChat.innerHTML += `<div class="waktu d-flex pt-2">${time_sent}</div>`;
    }
    return newChat.outerHTML;
  }
  return "";
}

// Menampilkan waktu
function formatTime(timestamp) {
  let timePart = timestamp.split(" ")[1];
  let [hours, minutes] = timePart.split(":");
  return `${hours}:${minutes}`;
}
