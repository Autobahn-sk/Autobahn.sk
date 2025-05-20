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
    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
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
import { defineComponent, watch } from "vue";
import axios from "axios";
import Ad from "@/components/app@_components/ad-card.vue";

export default defineComponent({
  components: {
    Ad,
  },
  props: {
    searchQuery: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      recentAds: [],
    };
  },
  watch: {
    searchQuery: {
      immediate: true,
      handler(newQuery) {
        if (newQuery && newQuery.trim().length > 0) {
          this.searchAds(newQuery.trim());
        } else {
          this.loadRecentAds();
        }
      },
    },
  },
  mounted() {
    this.loadRecentAds();
  },
  methods: {
    async loadRecentAds() {
      try {
        const response = await axios.get(`${import.meta.env.VITE_API_URL}/ads`, {
          params: {
            limit: 8,
            sort: "created_newest",
          },
        });
        this.recentAds = response.data?.data || [];
      } catch (error) {
        console.error("Chyba pri načítavaní inzerátov:", error);
      }
    },
    async searchAds(query) {
      try {
        const response = await axios.get(
          `${import.meta.env.VITE_API_URL}/ads-search`,
          {
            params: {
              query: `(${query})`,
              limit: 8, // ⬅️ Pridaný limit
            },
          }
        );
        this.recentAds = response.data?.data || [];
      } catch (error) {
        console.error("Chyba pri vyhľadávaní inzerátov:", error);
      }
    },
  },
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