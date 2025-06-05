class Footer extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
     <footer class="footer">
        <button class="footer-button" aria-label="Create new post" onclick="footerFunction()">
          <img class="footer-img" src="/src/assets/plus.png" alt="" srcset="" />
        </button>
      </footer>
    `;

    
    
  }
}
customElements.define("app-footer", Footer);
