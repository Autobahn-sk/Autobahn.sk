<template>
    <div class="mt-6 md:w-2/3">
      <div v-if="reviews" class="flex gap-4 p-4 border-b last:border-b-0">
        <img src="https://i.pravatar.cc/40" alt="User Avatar" class="w-10 h-10 rounded-full" />
        <div>
          <div class="font-semibold text-black">{{ reviews.name }}</div>
          <div class="text-sm text-gray-500">{{ reviews.date }}</div>
          <p class="mt-1 text-gray-700">{{ reviews.reviews }}</p>
        </div>
        <hr class="mt-8 border-[#E1E1E1]">
      </div>
      <div v-else class="text-gray-500">Žiadne recenzie na zobrazenie.</div>
    </div>
  </template>
  
  <script>
  import adsData from "@/assets/mocks/ad-cards.json"; 
  
  export default {
    setup() {
      const reviews = adsData[0]?.reviews || null; 
      return { reviews };
    },
  };
  </script>