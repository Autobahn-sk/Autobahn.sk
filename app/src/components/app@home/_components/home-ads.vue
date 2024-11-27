<template>
    <div class="site-layout mt-20">
        <h2 class="text-4xl font-bold text-black">Preskúmať všetky vozidlá</h2>
        <div class="inline-flex my-9">
          <div class="">
            <h5>Odporúčané</h5>
          </div>
          <div>
            <h5>Nové autá</h5>
          </div>
          <div>
            <h5>Používané autá</h5>
          </div>
        </div>
        <div class="">
            <Ad />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Ad from '@/components/app@_components/ad-card.vue';

export default defineComponent({
  components: {
    Ad
  }
});
</script>


<style scoped>

</style>