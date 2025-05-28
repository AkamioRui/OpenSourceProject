class Navbar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <nav>
      <h1>LetMeKnow</h1>
      <form>
        <input class="search" type="text" placeholder="Search..." />
      </form>
      <img src="../assets/circle.png" alt="" />
    </nav>
    `;
  }
}

customElements.define("app-navbar", Navbar);
