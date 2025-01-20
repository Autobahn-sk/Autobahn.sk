<template>
    <div class="site-layout flex flex-col items-center mb-24">
      <div class="flex flex-row items-center mb-12">
        <h2 class="subtitle-32 font-bold text-center">Výhodné členské plány</h2>
      </div>
      <div class="flex flex-row items-center gap-3 flex-wrap md:flex-nowrap">
        <MembershipCard
          v-for="(item) in data"
          :key="item.id"
          :item="item"
        />
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  import MembershipCard from '@/components/app@service/_components/service-membership-card.vue';
  import MembershipCardData from '@/assets/mocks/service-membership-cards.json';
  
  export default defineComponent({
    components: {
      MembershipCard,
    },
    data() {
      return {
        data: MembershipCardData, 
      };
    },
  });
  </script>
  
  <style scoped>
  </style>