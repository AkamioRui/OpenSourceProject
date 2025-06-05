const modal = document.getElementById("modal");
let previousModal = null; //is the current loaded modal
function closeModal() {
  modal.classList.add("hidden");
  modal.innerHTML = "";
  unloadModalCSS(previousModal);
}

function unloadModalCSS(modalName) {
  const link = document.querySelector(`link[data-modal-css="${modalName}"]`);
  if (link) {
    link.remove();
    console.log(`Unloaded CSS for modal: ${modalName}`);
  }
}
const getFooterModal = () => {
  const footerPage = document
    .querySelector("app-footer")
    ?.getAttribute("data-page");
  switch (footerPage) {
    case "homepage-footer":
      return "writeforum";
    case "forum-footer":
      return "writepost";
    case "post-footer":
      return "commentbar";
    default:
      return null;
  }
};

const getNavbarModal = () => {
  const navPage = document
    .querySelector("app-navbar")
    ?.getAttribute("data-page");
  switch (navPage) {
    case "homepage-nav":
    case "forum-nav":
    case "post-nav":
      return "account";
    case "account-nav":
      return "login";
    case "login-nav":
      return "signup";
    case "signup-nav":
      return "login";
    default:
      return "account";
  }
};

const loadModalCSS = (modalName) => {
  const existing = document.querySelector(
    `link[data-modal-css="${modalName}"]`
  );

  if (existing) return;

  const link = document.createElement("link");
  link.rel = "stylesheet";
  link.href = `/src/css/${modalName}.css`;
  link.setAttribute("data-modal-css", modalName);
  document.head.appendChild(link);
  console.log(`Loaded CSS for modal: ${modalName}`);
};

async function loadProfilePic() {
  let form = new FormData();
  form.append("user_profilePic", 1);
  let res = await fetch("/module/SQL_on_PHP/GENERAL_LISTENER.php", {
    method: "POST",
    body: form,
  });

  let imgSrc = await res.text();
  let profilePic = document.querySelector("#profilePic");
  profilePic.src = imgSrc;
}

async function loadModal(modalName,form=null) {
  try {

    //------------get html-----------------//
    let html;
    if(form){
      html = await (await fetch(`/src/php/${modalName}.php`,{
        method:'POST',
        body: form
      })).text();
    } else {
      html = await (await fetch(`/src/php/${modalName}.php`)).text();
    }

    //-------------append normal html-----------//
    let doc = new DOMParser().parseFromString(html, "text/html");
    console.log(doc);
    modal.appendChild(doc.querySelector(".modal"));

    //-------------append popup script--------------//
    let fetchScript = doc.querySelector("script");
    if (fetchScript) {
      let modalScript = document.createElement("script");
      try {
        modalScript.appendChild(fetchScript.text);
      } catch (e) {
        modalScript.text = fetchScript.text;
      }
      modal.appendChild(modalScript);
    }

    //---------------reenable the modal div----------------//
    previousModal = modalName;
    loadModalCSS(modalName);
    modal.classList.remove("hidden");

  } catch (error) {
    console.error(`Failed to load modal: ${modalName}`, error);
  }
}

// document.addEventListener("click", (e) => {
//   const profileBtn = e.target.closest(".profile-btn");
//   const footerBtn = e.target.closest(".footer-button");

//   if (profileBtn) {
//     const modalName = getNavbarModal();
//     loadModal(modalName);
//   }

//   if (footerBtn) {
//     const modalName = getFooterModal();
//     loadModal(modalName);
//   }
// });

