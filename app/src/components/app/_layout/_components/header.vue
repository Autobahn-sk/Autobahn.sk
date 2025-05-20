<template>
    <header class="hero-layout full-width-screen align-middle relative bg-dark-blue h-[4.8rem]">
      <div class="inline-flex flex-row justify-between w-full text-white">
        <a href="/" class="logo logo-20">AUTOBAHN.SK</a>
        <nav class="inline-flex space-x-7 desktopmenu">
          <a href="/" class="font-medium">Domov</a>
          <a href="/servis" class="font-medium">Virtuálny Servis</a>
          <a href="/qna" class="font-medium">Q&A</a>
          <a href="/about" class="font-medium">O Nás</a>
        </nav>
        <div class="login-button desktopmenu">
          <a class="font-medium">Prihlásiť sa</a>
        </div>
  
        <!-- Hamburger tlačidlo -->
        <button class="hamburger-button" @click="menuOpen = !menuOpen">
  ☰
</button>
      </div>
  
      <!-- Mobilné menu -->
      <div v-if="menuOpen" class="mobilemenu px-6 py-4 space-y-4 text-white">
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
      menuOpen: false
    };
  }
};
</script>

<style scoped>
.mobilemenu {
  /* odstráň visibility hidden, pretože v-if riadi zobrazenie */
  background-color: rgba(0, 0, 0, 0.85); /* opacity efekt */
  overflow: hidden;
}

.desktopmenu {
  visibility: visible;
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

.hamburger-button {
  background: none;
  border: none;
  font-size: 1.8rem;
  color: white;
  cursor: pointer;
  display: none; /* defaultne skryté */
}

a:hover {
  cursor: pointer;
  color: #E9E9E9;
}

.hamburger {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: white;
  cursor: pointer;
  display: none;
}

@media only screen and (max-width: 600px) {
  .desktopmenu {
    visibility: hidden;
  }

  .hamburger-button {
    display: block;
  }
}
</style>