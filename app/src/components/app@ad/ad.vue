<template>
  <div>
      <CarOverwiew />
      <Map />
      <LeasingCalculator />
      <Reviews />
  </div>
</template>
  
<script>
import { defineComponent } from 'vue'
import CarOverwiew from './_components/car-overview.vue';
import Map from './_components/car-map.vue';
import LeasingCalculator from './_components/car-leasing-calculator.vue';
import Reviews from './_components/car-reviews.vue';
  
export default defineComponent({
  components: {
    CarOverwiew,
    Map,
    LeasingCalculator,
    Reviews
  }
});
</script> 