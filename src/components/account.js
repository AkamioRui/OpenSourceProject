async function change_profilePic() {
  // $_FILES['user_profilePic']
  // if($_POST['change_profilePic'])

  let filePicker = await window.showOpenFilePicker({
    types: [
      {
        description: "Images",
        accept: {
          "image/*": [".png", ".gif", ".jpeg", ".jpg"],
        },
      },
    ],
    excludeAcceptAllOption: true,
    multiple: false,
  });

  files = await filePicker[0].getFile();
  /* temp */ let file = files;
  console.log("file", file);
  /* temp */ let headerProfilePic = document.querySelector("#profilePic");
  // let img = document.querySelector(".profile-btn");

  let form = new FormData();
  form.append("change_profilePic", 1);
  form.append("user_profilePic", file);
  let response = await (
    await fetch("/module/SQL_on_PHP/ACCOUNTPOPUP_LISTENER.php", {
      method: "POST",
      body: form,
    })
  ).text();

  let doc = new DOMParser().parseFromString(response, "text/html");
  console.log(doc);
  console.log(doc.body.style.getPropertyValue("--code"));
  console.log(doc.body.innerHTML);

  if (doc.body.style.getPropertyValue("--code") == "success") {
    headerProfilePic.src = doc.body.innerHTML;
  }
}
