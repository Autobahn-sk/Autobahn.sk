<template>
    <div>
        <HeroSection />
        <Membership />
        <Benefits />
        <PlannedService />
        <Footer />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import HeroSection from '@/components/app@service/_components/service-hero.vue';
import Membership from '@/components/app@service/_components/service-membership.vue';
import Benefits from '@/components/app@service/_components/service-benefits.vue';
import PlannedService from '@/components/app@service/_components/service-planned-service.vue';
import Footer from '@/components/app/_layout/_components/footer.vue';


export default defineComponent({
  components: {
    HeroSection,
    Membership,
    Benefits,
    PlannedService,
    Footer
  }
});

</script>