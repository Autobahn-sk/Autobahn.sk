<template>
  <div class="md:mt-20 mt-10">
    <h2 class="subtitle subtitle-40 font-bold text-black">
      <strong>Preskúmať všetky vozidlá</strong>
    </h2>
    <div class="my-9">
      <div class="select-bar flex gap-9">
        <a class="active">Odporúčané</a>
        <a>Nové autá</a>
        <a>Používané autá</a>
      </div>
      <hr class="mt-3 bg-light-gray h-[0.06rem]">
    </div>
    <div class="flex flex-wrap gap-4">
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
import Ad from '@/components/app@home/_components/ad-card.vue';
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
        .slice(0, 8);
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