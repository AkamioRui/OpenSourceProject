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

    //nav body building block
    let navbarContent = '<h1>LetMeKnow</h1> ';
    let backbutton = `
      <button class="back-button">
      <img id="back-btn" src="/src/assets/back.png" alt="Back"  />
      </button>    
    `;
    let searchBar = `
      <form>
        <input class="search" type="text" placeholder="Search Forum..." />
      </form>    
    `;
    let profilePic = `
      <img  id="profilePic" src="` +
      imgSrc +
      `"  /> 
      </button>  
    `;


    //create nav body
    const page = this.getAttribute("data-page");
    this.classList.add(`navbar-${page}`);
    switch (page) {
      case "forum-nav":
        navbarContent = backbutton + navbarContent + searchBar + profilePic;
        break;

      case "login-nav":
      case "signup-nav":
      case "account-nav":
        navbarContent = backbutton + navbarContent ;
        break;

      case "post-nav":
      case "write-post-nav":
      case "write-forum-nav":
      case "comment-bar-nav":
        navbarContent = backbutton + navbarContent + profilePic;
        break;

      default://homepage
        navbarContent = navbarContent + searchBar + profilePic;
        break;

    }
    this.innerHTML = `<nav>`+navbarContent +`</nav>`;

    //add function to back button
    switch (page) {
      case "forum-nav":// go to homepage
        this.querySelector('.back-button')?.addEventListener('click',()=>{
          window.location.href = "/src/php/homepage.php";
        });
        break;

      case "post-nav"://go to forumned
        this.querySelector('.back-button')?.addEventListener('click',()=>{
          forum_id = 
          window.location.href = "/src/php/forum.php?forum_id="+forum_id;
        });
        break;

      default://
        this.querySelector('.back-button')?.addEventListener('click',()=>{
          this.closePopup();
        });
        break;

    }
    
    
  }

  closePopup(){
    modal.classList.add("hidden");
    modal.innerHTML = "";
    
    let modalName = this.getAttribute("data-page");
    modalName = modalName.substring(0, modalName.length - 4);
    const link = document.querySelector(
      `link[data-modal-css="${modalName}"]`
    );
    if (link) {
      link.remove();
      /* temp */console.log(`Unloaded CSS for modal: ${modalName}`);
    }

  } 
}

  
customElements.define("app-navbar", Navbar);
