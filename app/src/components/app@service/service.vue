<template>
    <div>
        <HeroSection />
        <Membership />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import HeroSection from '@/components/app@service/_components/service-hero.vue';
import Membership from '@/components/app@service/_components/service-membership.vue';


export default defineComponent({
  components: {
    HeroSection,
    Membership
  }
});

</script>