<template>
    <header class="hero-layout full-width-screen align-middle relative bg-dark-blue h-[4.8rem]">
      <div class="inline-flex flex-row justify-between items-center w-full text-white px-4">
        <a href="/" class="logo logo-20">AUTOBAHN.SK</a>
  
        <!-- Desktop menu -->
        <nav class="hidden md:flex space-x-7">
          <a href="/" class="font-medium">Domov</a>
          <a href="/servis" class="font-medium">Virtuálny Servis</a>
          <a href="/qna" class="font-medium">Q&A</a>
          <a href="/about" class="font-medium">O Nás</a>
        </nav>
  
        <!-- Login button (desktop only) -->
        <div class="hidden md:flex items-center">
          <a class="font-medium flex items-center">
            <span class="inline-block w-5 h-5 mr-2 bg-no-repeat bg-contain" style="background-image: url('../_img/UserIcon.svg')"></span>
            Prihlásiť sa
          </a>
        </div>
  
        <!-- Hamburger button (mobile only) -->
        <button class="md:hidden text-2xl" @click="menuOpen = !menuOpen">
          ☰
        </button>
      </div>
  
      <!-- Mobile menu -->
      <div v-if="menuOpen" class="md:hidden bg-dark-blue px-6 py-4 space-y-4 text-white">
        <a href="/" class="block font-medium">Domov</a>
        <a href="/servis" class="block font-medium">Virtuálny Servis</a>
        <a href="/qna" class="block font-medium">Q&A</a>
        <a href="/about" class="block font-medium">O Nás</a>
        <a href="/login" class="block font-medium">Prihlásiť sa</a>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header',
    data() {
      return {
        menuOpen: false,
      };
    },
    watch: {
      // zavrie menu pri zmene veľkosti okna
      $route() {
        this.menuOpen = false;
      }
    }
  };
  </script>
  
  <style scoped>
  a:hover {
    color: #E9E9E9;
  }
  
  @media (min-width: 768px) {
    /* Ak používaš Tailwind, md breakpoint = 768px */
  }
  </style>