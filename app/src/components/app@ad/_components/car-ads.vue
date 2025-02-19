<template>
  <div class="md:mt-20 mt-10 mb-20">
    <h2 class="subtitle subtitle-40 font-bold text-black">
      <strong>Súvisiace inzeráty</strong>
    </h2>
    <div class="flex flex-wrap gap-4 mt-6">
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
import Ad from '@/components/app@_components/ad-card.vue'
import AdsData from '@/assets/mocks/ad-cards.json'

export default defineComponent({
    components: {
      Ad,
    },
    data() {
      return {
        recentAds: []
      };
    },
    mounted() {
      const links = document.querySelectorAll('.select-bar a');
      links.forEach(function (link) {
        link.addEventListener('click', function () {
          links.forEach(function (l) {
            l.classList.remove('active');
          });
          link.classList.add('active');
        });
      });
    },
    created() {
      this.loadRecentAds();
    },
    methods: {
    loadRecentAds() {
      this.recentAds = [...AdsData]
        .sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt))
        .slice(0, 4);
    }
  }
});
</script>

<style scoped>

.select-bar a:hover {
  cursor: pointer;
}

.select-bar a.active {
  text-decoration-line: underline !important;
  text-decoration-color: #405ff2 !important;
  text-underline-offset: 17px;
  text-decoration-thickness: 3px;
}

@media (max-width: 768px) {
  .select-bar {
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    position: relative;
  }

  .select-bar a {
    display: inline-block;
    position: relative;
  }

  .select-bar::-webkit-scrollbar {
    display: none;
  }
}
</style>