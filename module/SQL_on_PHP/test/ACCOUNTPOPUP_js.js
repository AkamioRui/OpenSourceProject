async function change_profilePic() {
  // $_FILES['user_profilePic']
  // if($_POST['change_profilePic'])

  /* temp */ let file = document.querySelector("#fileInput").files[0];
  /* temp */ let headerProfilePic = document.querySelector("#profilePic");

  let form = new FormData();
  form.append("change_profilePic", 1);
  form.append("user_profilePic", file);
  response = await (
    await fetch("/module/SQL_on_PHP/ACCOUNTPOPUP_LISTENER.php", {
      method: "POST",
      body: form,
    })
  ).text();

  let doc = new DOMParser().parseFromString(response, "text/html");
  if (doc.body.style.getPropertyValue("--code") == "success") {
    headerProfilePic.src = doc.body.innerHTML;
  }
}

async function logout() {
  //if($_POST['logout']);

  let form = new FormData().append("logout", 1);
  let msg = await (
    await fetch("/module/SQL_on_PHP/ACCOUNTPOPUP.php", {
      method: "POST",
      body: form,
    })
  ).text();

  let doc = new DOMParser().parseFromString(msg, "text/html");
  while ((element = doc.body.children[0])) {
    document.body.appendChild(element);
  }
}
