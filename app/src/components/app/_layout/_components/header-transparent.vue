<template>
    <header>
      <div class="inline-flex flex-row justify-between w-full text-white">
        <h1 class="logo logo-20">AUTOBAHN.SK</h1>
  
        <nav class="inline-flex space-x-7 desktopmenu">
          <a class="font-medium">Domov</a>
          <a href="/servis" class="font-medium">Virtuálny Servis</a>
          <a href="/qna" class="font-medium">Q&A</a>
          <a href="/about" class="font-medium">O Nás</a>
        </nav>
  
        <div class="login-button desktopmenu">
          <a class="font-medium">Prihlásiť sa</a>
        </div>
  
        <!-- Mobilné menu toggle button -->
        <button class="mobilemenu-toggle" @click="toggleMenu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
  
      <!-- Mobilné menu obsah -->
      <div v-if="menuOpen" class="mobilemenu">
        <a class="block font-medium py-2 px-4">Domov</a>
        <a href="/servis" class="block font-medium py-2 px-4">Virtuálny Servis</a>
        <a href="/qna" class="block font-medium py-2 px-4">Q&A</a>
        <a href="/about" class="block font-medium py-2 px-4">O Nás</a>
        <a class="block font-medium py-2 px-4">Prihlásiť sa</a>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header',
    data() {
      return {
        menuOpen: false
      };
    },
    methods: {
      toggleMenu() {
        this.menuOpen = !this.menuOpen;
      }
    }
  };
  </script>
  
  <style scoped>


  header {
    position: relative;
    }
  .desktopmenu {
    display: inline-flex;
  }
  

  .mobilemenu-toggle {
    display: none;
  }
  

  .mobilemenu {
    display: none;
    padding-top: 10px;
    padding-bottom: 10px;
    background-color: rgba(0, 0, 0, 0.85);
    color: white;

    position: absolute;  
    top: 100%;           
    left: 0;
    right: 0;
    z-index: 10;
}
  

  .login-button::before {
    display: inline-block;
    content: "";
    width: 1.25rem;
    height: 1.25rem;
    background-image: url("../_img/UserIcon.svg");
    background-repeat: no-repeat;
    background-size: contain;
    margin-bottom: -0.18rem;
    margin-right: 0.3rem;
  }
  
  a:hover {
    cursor: pointer;
    color: #E9E9E9;
  }
  

  @media only screen and (max-width: 600px) {
    .desktopmenu {
      display: none;
    }
  
    .mobilemenu-toggle {
      display: block;
    }
  
    .mobilemenu {
      display: block;
    }
  }
  </style>