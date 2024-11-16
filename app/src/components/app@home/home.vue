<template>
  <section class="bg-image">
    <div>
      <Header />
      <h1>dfv</h1>
    </div>
  </section>
</template>

<script>
import { defineComponent } from 'vue'
import Header from '@/components/app/_layout/_components/header-transparent.vue';

export default defineComponent({
  components: {
    Header
  }
});
</script>


<style scoped>

section{
    padding-right: 31px;
    padding-left: 31px;
    padding-top: 26px;
}

.bg-image {
  background-image: url("./_img/Background.png");
  background-repeat: no-repeat;
  background-size: cover;
  height: 637.46px;
  width: auto;
}


</style>
