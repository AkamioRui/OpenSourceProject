class Navbar extends HTMLElement {
  connectedCallback() {
    const page = this.getAttribute("data-page");
    this.classList.add(`navbar-${page}`);
    let navbarContent;

    switch (page) {
      case "forum-nav":
        navbarContent = `
        <nav >
          <button  class="back-button ">
          <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>
          <form>
            <input class="search" type="text" placeholder="Search Forum..." />
          </form>
          <button class="profile-btn" data-modal-target=""> 
          <img id="" src="/src/assets/circle.png" alt="Login/Signup" />
          </button>
        </nav>
 
      `;
        break;

      case "login-nav":
      case "signup-nav":
        navbarContent = `
        <nav >
          <button  class="back-button ">
        <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>
        </nav>
 
      `;
        break;

      case "account-nav":
        navbarContent = `
        <nav >
          <button  class="back-button ">
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
        navbarContent = `
        <nav >
          <button  class="back-button ">
        <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
          </button>  
          <h1>LetMeKnow</h1>   
          <button class="profile-btn" data-modal-target=""> 
          <img  src="/src/assets/circle.png" alt="Login/Signup" />
          </button>
        </nav>
      `;
        break;

      default:
        navbarContent = `
          <nav >
        <h1>LetMeKnow</h1>
        <form>
          <input class="search" type="text" placeholder="Search..." />
        </form>
        <button class="profile-btn"  data-modal-target=""> 
        <img  src="/src/assets/circle.png" alt="Login/Signup" />
        </button>
      </nav>
      <div id="authModal" class="modal hidden"></div>
        `;
        break;
    }
    this.innerHTML = navbarContent;
  }
}

customElements.define("app-navbar", Navbar);
