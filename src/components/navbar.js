class Navbar extends HTMLElement {
  async connectedCallback() {
    const modal = document.getElementById("modal");

    // Load the profile picture
    let form = new FormData();
    form.append("user_profilePic", 1);
    let res = await fetch("/module/SQL_on_PHP/GENERAL_LISTENER.php", {
      method: "POST",
      body: form,
    });
    let imgSrc = await res.text();

    const page = this.getAttribute("data-page");
    this.classList.add(`navbar-${page}`);
    let navbarContent;

    switch (page) {
      case "forum-nav":
        navbarContent =
          `
        <nav >
          <button class="back-button">
          <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>
          <form>
            <input class="search" type="text" placeholder="Search Forum..." />
          </form>
          <button class="profile-btn" data-modal-target=""> 
          <img  id="profilePic" src="` +
          imgSrc +
          `"  />
          </button>
        </nav>
 
      `;
        break;

      case "login-nav":
      case "signup-nav":
        navbarContent = `
        <nav>
          <button class="back-button">
        <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>
        </nav>
 
      `;
        break;

      case "account-nav":
        navbarContent = `
        <nav>
          <button class="back-button">
        <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>
        </nav>
      `;
        break;

      case "post-nav":
      case "write-post-nav":
      case "write-forum-nav":
      case "comment-bar-nav":
        navbarContent =
          `
        <nav>
          <button class="back-button">
        <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>   
          <button class="profile-btn" data-modal-target=""> 
                    <img  id="profilePic" src="` +
          imgSrc +
          `"  />

          </button>
        </nav>
      `;
        break;

      default:
        navbarContent =
          `
          <nav >
        <h1>LetMeKnow</h1>
        <form>
          <input class="search" type="text" placeholder="Search..." />
        </form>
        <button class="profile-btn"  data-modal-target=""> 
                  <img id="profilePic" src="` +
          imgSrc +
          `"  />
        </button>
      </nav>
      <div id="authModal" class="modal hidden"></div>
        `;
        break;
    }
    this.innerHTML = navbarContent;
    let modalName = page.substring(0, page.length - 4);
    this.querySelector(".back-button").addEventListener("click", () => {
      modal.classList.add("hidden");
      modal.innerHTML = "";
      const link = document.querySelector(
        `link[data-modal-css="${modalName}"]`
      );

      if (link) {
        link.remove();
        console.log(`Unloaded CSS for modal: ${modalName}`);
      }
    });
  }
}

customElements.define("app-navbar", Navbar);
