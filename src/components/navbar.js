class Navbar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <nav style="position:relative;">
      <h1>LetMeKnow</h1>
      <form>
        <input class="search" type="text" placeholder="Search..." />
      </form>
      <button data-modal-target=""> 
      <img id="authBtn" src="/src/assets/circle.png" alt="Login/Signup" style="cursor:pointer;" />
      </button> 
      </nav>
    <div id="authModal" class="modal hidden"></div>
    `;
  }
}

customElements.define("app-navbar", Navbar);
