<template>
  <div class="bg-image site-layout">
    <div>
      <Header />
      <section class="flex flex-col items-center justify-center w-full text-center">
        <div class="align-middle mt-40">
          <div class="column-1 mb-0">
            <h2 class="subtitle subtitle-20">Nájdite autá na predaj vo vašom okolí</h2>
          </div>
          <div class="column-1 mt--5">
            <h1 class="title title-61">Nájdite si svoje dokonalé auto</h1>
          </div>
          <div>
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

.mt--5{
  margin-top: -1rem;
}

.bg-image {
  background-image: url("./_img/Background.png");
  background-repeat: no-repeat;
  background-size: cover;
  height: 637.46px;
  width: auto;
}


</style>
