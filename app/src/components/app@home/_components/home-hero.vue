<template>
    <div class="bg-image site-layout">
      <div>
        <Header />
        <section class="flex flex-col items-center justify-center w-full text-center">
          <div class="align-middle mt-40">
            <div class="column-1 mb-0">
              <h2 class="subtitle subtitle-20 text-white">Nájdite autá na predaj vo vašom okolí</h2>
            </div>
            <div class="column-1 ">
              <h1 class="title title-61 text-white">Nájdite si svoje dokonalé auto</h1>
            </div>
            <div class="mt-8">
              <Searchbar />
            </div>
          </div>
        </section>
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue'
  import Header from '@/components/app/_layout/_components/header-transparent.vue';
  import Searchbar from '@/components/app@_components/searchbar.vue'
  
  export default defineComponent({
    components: {
      Header,
      Searchbar
    }
  });
  </script>
  
  
  <style scoped>
  
  .bg-image {
    background-image: url("../_img/Background.png");
    background-repeat: no-repeat;
    background-size: cover;
    height: 637.46px;
    width: auto;
  }
  
  
  </style>