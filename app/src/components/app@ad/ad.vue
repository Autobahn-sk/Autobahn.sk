<template>
  <div>
      <CarOverwiew />
      <Map />
      <LeasingCalculator />
      <Reviews />
      <Chart />
      <Ad />
      <Footer />
  </div>
</template>
  
<script>
import { defineComponent } from 'vue'
import CarOverwiew from './_components/car-overview.vue';
import Map from './_components/car-map.vue';
import LeasingCalculator from './_components/car-leasing-calculator.vue';
import Reviews from './_components/car-reviews.vue';
import Chart from './_components/car-chart.vue';
import Ad from './_components/car-ads.vue';
import Footer from '@/components/app/_layout/_components/footer.vue';
  
export default defineComponent({
  components: {
    CarOverwiew,
    Map,
    LeasingCalculator,
    Reviews,
    Chart,
    Ad,
    Footer
  }
});
</script> 