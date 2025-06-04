document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modal");
  let previousModal = null;

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
    if (existing) return; // already loaded

    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = `/src/css/${modalName}.css`;
    link.setAttribute("data-modal-css", modalName);
    document.head.appendChild(link);
    console.log(`Loaded CSS for modal: ${modalName}`);
  };

  const unloadModalCSS = (modalName) => {
    const link = document.querySelector(`link[data-modal-css="${modalName}"]`);
    if (link) {
      link.remove();
      console.log(`Unloaded CSS for modal: ${modalName}`);
    }
  };

  async function loadModal(modalName) {
    if (!modalName) return;

    try {
      const res = await fetch(`/src/views/popup/${modalName}.html`);
      const html = await res.text();
      modal.innerHTML = html;
      modal.classList.remove("hidden");
      previousModal = modalName;

      loadModalCSS(modalName);

      // Close button handler
      const closeBtn = modal.querySelector("#back-button");
      if (closeBtn) {
        closeBtn.addEventListener("click", closeModal);
      }

      // Cross-modal transitions
      if (modalName === "account") {
        const signupBtn = modal.querySelector("#signup-from-account");
        if (signupBtn) {
          signupBtn.addEventListener("click", () => {
            closeModal();
            loadModal("signup");
          });
        }
      }

      if (modalName === "signup") {
        const loginBtn = modal.querySelector("#login-from-signup");
        if (loginBtn) {
          loginBtn.addEventListener("click", () => {
            closeModal();
            loadModal("login");
          });
        }
      }

      if (modalName === "login") {
        const signupLink = modal.querySelector("#signup-from-login");
        if (signupLink) {
          signupLink.addEventListener("click", () => {
            closeModal();
            loadModal("signup");
          });
        }
      }
    } catch (error) {
      console.error(`Failed to load modal: ${modalName}`, error);
    }
  }

  function closeModal() {
    modal.classList.add("hidden");
    modal.innerHTML = "";
    unloadModalCSS(previousModal);
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
});
