async function insert_Comment(postId, parentId) {
  let comment = document.querySelector("#comment").value;

  let form = new FormData();
  form.append("insert_Comment", 1);
  form.append("postId", postId);
  form.append("parentId", parentId);
  form.append("comment", comment);

  let response = await (
    await fetch("/module/SQL_on_PHP/CREATECOMMENT_LISTENER.php", {
      method: "POST",
      body: form,
    })
  ).text();
  let code = new DOMParser()
    .parseFromString(response, "text/html")
    .body.style.getPropertyValue("--code");
  console.log(code);
}
