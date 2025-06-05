const modal = document.getElementById("modal");
let previousModal = null;//is the current loaded modal
function closeModal() {
  modal.classList.add("hidden");
  modal.innerHTML = "";
  unloadModalCSS(previousModal);
}

function unloadModalCSS (modalName){
  const link = document.querySelector(`link[data-modal-css="${modalName}"]`);
  if (link) {
    link.remove();
    console.log(`Unloaded CSS for modal: ${modalName}`);
  }
};
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

  async function loadModal(modalName) {
    if (!modalName) return;

    try {
      const html = await (await fetch(`/src/php/${modalName}.php`)).text();

      //html
      let doc = new DOMParser().parseFromString(html, "text/html");
      modal.appendChild(doc.querySelector(".modal"));

      //append popup script
      let fetchScript = doc.querySelector('script');
      if(fetchScript){
        let modalScript = document.createElement('script');
        try {
          modalScript.appendChild(fetchScript.text);
        } catch (e) {
          modalScript.text = fetchScript.text;
        }
        modal.appendChild(modalScript);
      }
      

      modal.classList.remove("hidden");
      previousModal = modalName;
      loadModalCSS(modalName);

      // Close button handler

      // const closeBtn = modal.querySelector(".back-button");
      // console.log(modal, closeBtn);
      // if (closeBtn) {
      //   closeBtn.addEventListener("click", closeModal);
      // }

      // Cross-modal transitions
      if (modalName === "account") {
        
      }

      if (modalName === "signup") {
        fetchScript.text

      if (modalName === "login") {
        const signupLink = modal.querySelector("#signup-from-login");
        if (signupLink) {
          signupLink.addEventListener("click", () => {
            closeModal();
            loadModal("signup");
          });
        }

        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LOGIN BUTTON HANDLER ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        const loginButton = modal.querySelector("#sign-in-button");
        if (loginButton) {
          loginButton.addEventListener("click", async () => {
            console.log("Login button:", loginButton);
            let user_arg = document.querySelector("#email").value;
            let user_password = document.querySelector("#password").value;
            console.log(`User arg: ${user_arg}, Password: ${user_password}`);

            //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  FETCH QUERY FROM FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            let form = new FormData();
            form.append("query_Login", 1);
            form.append("user_arg", user_arg);
            form.append("user_password", user_password);

            let response = await (
              await fetch("/module/SQL_on_PHP/LOGINPOPUP_LISTENER.php", {
                method: "POST",
                body: form,
              })
            ).text();
            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ PROFILE PIC APPEND ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            loadProfilePic();
            closeModal();
          });
        }
      }
    } catch (error) {
      console.error(`Failed to load modal: ${modalName}`, error);
    }
  }



  document.addEventListener("click", (e) => {
    const profileBtn = e.target.closest(".profile-btn");
    const footerBtn = e.target.closest(".footer-button");

    if (profileBtn) {
      const modalName = getNavbarModal();
      loadModal(modalName);
    }

    if (footerBtn) {
      const modalName = getFooterModal();
      loadModal(modalName);
    }
  });

  async function insert_signup() {
    //$_POST['user_username'];
    //$_POST['user_email'];
    //$_POST['user_password'];

    let user_username = document.querySelector("#uname").value;
    let user_email = document.querySelector("#email").value;
    let user_password = document.querySelector("#password").value;

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

