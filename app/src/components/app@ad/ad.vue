<template>
    <div>
        <CarOverwiew />
    </div>
  </template>
  
  <script>
import { defineComponent } from 'vue'
  import CarOverwiew from './_components/car-overview.vue';
  
  export default defineComponent({
    components: {
      CarOverwiew
    }
  });
  </script> 