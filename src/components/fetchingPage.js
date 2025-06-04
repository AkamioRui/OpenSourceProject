function redirect_ForumPage(forum_id) {
  window.location.href = "/src/php/FORUMPAGE.php?" + "forum_id=" + forum_id;
}
function redirect_PostPage(post_id) {
  window.location.href = "/src/php/POSTPAGE.php?" + "post_id=" + post_id;
}
function redirect_Homepage() {
  window.location.href = "/src/php/HOMEPAGE.php";
}
async function fetch_LoginPopup() {
  return await (await fetch("/src/php/LOGINPOPUP.php")).text();
}
async function fetch_SignupPopup() {
  return await (await fetch("/src/php/SIGNUPPOPUP.php")).text();
}
async function fetch_accountPopup() {
  return await (await fetch("/src/php/ACCOUNTPOPUP.php")).text();
}
async function fetch_CreateForum() {
  return await (await fetch("/src/php/CREATEFORUM.php")).text();
}
async function fetch_CreatePost(forumId) {
  let form = new FormData();
  form.append("forumId", forumId);
  return await (
    await fetch("/src/php/CREATEPOST.php", {
      method: "POST",
      body: form,
    })
  ).text();
}
async function fetch_CreateComment(postId, parentId) {
  let form = new FormData();
  form.append("postId", postId);
  form.append("parentId", parentId);
  return await (
    await fetch("/src/php/CREATECOMMENT.php", {
      method: "POST",
      body: form,
    })
  ).text();
}

function closePopup() {}

function HEADER_updateProfilePic() {
  let form = new FormData();
  form.append("user_profilePic", 1);

  fetch("/module/SQL_on_PHP/GENERAL_LISTENER.php", {
    method: "POST",
    body: form,
  })
    .then((Response) => Response.text())
    .then((src) => {
      return src;
    });
}

function placeChildinto(destination, body) {
  let element;
  let myscript;
  while ((element = body.children[0])) {
    if (element.tagName == "SCRIPT") {
      myscript = document.createElement("script");
      try {
        myscript.appendChild(document.createTextNode(element.text));
      } catch (e) {
        myscript.text = element.text;
      }
      destination.appendChild(myscript);
      element.remove();
    } else {
      destination.appendChild(element);
    }
  }

  //if script is outside body, change the input to the whole doc, and
  // while( element = msgdoc.getElementsByTagName('SCRIPT')[0] ){
  //     myscript = document.createElement('script');
  //     try{
  //         myscript.appendChild(document.createTextNode(element.text));
  //     }catch(e){
  //         myscript.text = element.text;
  //     }
  //     document.appendChild(myscript);
  //     element.remove();
  // }
}

// async function postData(){

//     //----------------------create form------------------------------//
//     const form = new FormData();

//     form.append('data',document.querySelector('form>.textbox').value);

//     let filesize = 0;
//     for(let file of document.querySelector('form>.filebox').files){
//         form.append('myimg[]',file);
//         filesize += file.size;
//         console.log(filesize);
//     }

//     for(let pair of form.entries()){
//         console.log(pair);
//     }

//     //------------------fetch----------------------------------//
//     fetch('http://localhost:3000/module/SQL_on_PHP/test.php',{
//         method:"POST",
//         body: form
//     }).then(
//         response => response.text()
//     ).then((str)=>{

//         let doc = new DOMParser().parseFromString(str,'text/html');
//         while(doc.body.children.length>0){
//             document.body.appendChild(doc.body.children[0]);
//         }

//         let node = document.createElement('p');
//         node.innerHTML = 'done';
//         document.body.appendChild(node);

//     })

// }

// function showFilesize(){
//     let filesize = 0;
//     for(let file of document.querySelector('.filebox').files){
//         filesize += file.size;
//     }
//     document.querySelector('.counter').innerHTML = "size: "+filesize/1000000+"Mb";
// }
