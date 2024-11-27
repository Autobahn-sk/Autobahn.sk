<template>
    <HeroSection />
    <Ads />
</template>

<script>
import { defineComponent } from 'vue'
import HeroSection from '@/components/app@home/_components/home-hero.vue';
import Ads from '@/components/app@home/_components/home-ads.vue';

export default defineComponent({
  components: {
    HeroSection,
    Ads
  }
});
</script>


<style scoped>

</style>
