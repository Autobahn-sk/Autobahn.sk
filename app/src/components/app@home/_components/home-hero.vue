<template>
  <div class="bg-image h-[39rem] bg-no-repeat bg-cover hero-layout full-width-screen align-middle relative">
    <Header class="top-0 w-full" />
    <section class="text-center flex items-center justify-center flex-col h-full">
      <div>
        <h4 class="text-base md:text-xl text-white">
          Nájdite autá na predaj vo vašom okolí
        </h4>
        <h1 class="text-5xl md:text-6xl font-bold text-white">
          Nájdite si svoje dokonalé auto
        </h1>
        <div class="mt-8">
          <!-- zachytíme event zo Searchbaru a prepustíme hore -->
          <Searchbar @search="onSearch" />
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import Header from "@/components/app/_layout/_components/header-transparent.vue";
import Searchbar from "@/components/app@_components/searchbar.vue";

export default defineComponent({
  components: {
    Header,
    Searchbar,
  },
  methods: {
    onSearch(query) {
      this.$emit("search", query);
    },
  },
});
</script>
  
  
<style scoped>
  
  .bg-image {
    background-image: url("../_img/Background.png");
    background-color: black;
  } 
  
</style>