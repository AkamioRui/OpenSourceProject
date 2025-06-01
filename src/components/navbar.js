class Navbar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <nav style="position:relative;">
      <h1>LetMeKnow</h1>
      <form>
        <input class="search" type="text" placeholder="Search..." />
      </form>
      <img id="authBtn" src="../assets/circle.png" alt="Login/Signup" style="cursor:pointer;" />
    </nav>
    <div id="authModal" class="modal hidden"></div>
    <style>
      .modal {
        position: absolute;
        top: 60px;
        right: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.18);
        z-index: 1000;
        min-width: 320px;
        max-width: 90vw;
        padding: 0;
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
      }
      .modal.hidden { display: none; }
      .login-card {
        box-shadow: none;
        border-radius: 12px;
        margin: 0;
        padding: 2rem 1.5rem;
        background: #fff;
        min-width: 300px;
      }
      .login-header { border-radius: 12px 12px 0 0; }
      @media (max-width: 500px) {
        .modal { right: 0; left: 0; min-width: unset; }
      }
    </style>
    `;
    // Modal logic
    const authBtn = this.querySelector('#authBtn');
    const authModal = this.querySelector('#authModal');
    const nav = this.querySelector('nav');

    // Helper to load and show only the .login-card from the page using DOMParser
    async function showAuthPage(page) {
      const res = await fetch(`/src/views/${page}.html`);
      let html = await res.text();
      // Use DOMParser to extract the .login-card div and its full content
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const card = doc.querySelector('.login-card');
      authModal.innerHTML = card ? card.outerHTML : '<div style="padding:2rem">Error loading form</div>';
      // Dynamically load the correct CSS for login or signup
      let styleId = 'auth-popup-style';
      let cssHref = page === 'login' ? '/src/css/login.css' : '/src/css/signup.css';
      let existingStyle = document.getElementById(styleId);
      if (existingStyle) existingStyle.remove();
      let link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = cssHref;
      link.id = styleId;
      document.head.appendChild(link);
      authModal.classList.remove('hidden');
      // Link switching logic
      const loginLink = authModal.querySelector('a[href$="signup.html"]');
      if (loginLink) {
        loginLink.onclick = (e) => {
          e.preventDefault();
          showAuthPage('signup');
        };
        // Prevent default navigation
        loginLink.setAttribute('href', '#');
      }
      const signupLink = authModal.querySelector('a[href$="login.html"]');
      if (signupLink) {
        signupLink.onclick = (e) => {
          e.preventDefault();
          showAuthPage('login');
        };
        // Prevent default navigation
        signupLink.setAttribute('href', '#');
      }
      // Back button closes modal
      const backBtn = authModal.querySelector('.back');
      if (backBtn) {
        backBtn.onclick = (e) => {
          e.preventDefault();
          authModal.classList.add('hidden');
          // Remove the popup style when closing
          let s = document.getElementById(styleId);
          if (s) s.remove();
        };
        // Prevent default navigation
        backBtn.setAttribute('href', '#');
      }
    }

    authBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showAuthPage('login');
    });
    // Close modal on outside click (only if click is outside the card)
    authModal.addEventListener('click', e => {
      if (e.target === authModal) authModal.classList.add('hidden');
    });
  }
}

customElements.define("app-navbar", Navbar);
