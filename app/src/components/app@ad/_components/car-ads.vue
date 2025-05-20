<template>
  <div class="md:mt-20 mt-10 mb-20">
    <h2 class="subtitle subtitle-40 font-bold text-black">
      <strong>Súvisiace inzeráty</strong>
    </h2>
    <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-6">
      <Ad
        class="flex-row"
        v-for="item in recentAds"
        :key="item.id"
        :item="item"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import axios from 'axios';
import Ad from '@/components/app@_components/ad-card.vue';

export default defineComponent({
  components: {
    Ad,
  },
  data() {
    return {
      recentAds: [],
      error: null,
    };
  },
  async created() {
    try {
      const response = await axios.get(
        `${import.meta.env.VITE_API_URL}/ads?limit=4&sort=created_newest`
      );
      this.recentAds = response.data.data;
    } catch (err) {
      this.error = err.response?.data?.message || err.message;
      console.error('Chyba pri načítaní inzerátov:', this.error);
    }
  },
});
</script>