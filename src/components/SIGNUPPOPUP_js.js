async function insert_signup() {
  //$_POST['user_username'];
  //$_POST['user_email'];
  //$_POST['user_password'];

  let user_username = document.querySelector("#user_username").value;
  let user_email = document.querySelector("#user_email").value;
  let user_password = document.querySelector("#user_password").value;

  let form = new FormData();
  form.append("insert_signup", 1);
  form.append("user_username", user_username);
  form.append("user_email", user_email);
  form.append("user_password", user_password);

  let response = await (
    await fetch("/module/SQL_on_PHP/SIGNUPPOPUP_LISTENER.php", {
      method: "POST",
      body: form,
    })
  ).text();
  let code = new DOMParser()
    .parseFromString(response, "text/html")
    .body.style.getPropertyValue("--code");
  console.log(code);
}
