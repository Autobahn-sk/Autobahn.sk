<template>
  <div>
    <HeroSection />
    <Ads />
    <SellAdd />
    <Benefits />
    <SecondAds />
    <FavouriteBrands />
    <Advertisment />
    <MarketingNumbers />
    <CallToAction />
    <Footer />
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import HeroSection from '@/components/app@home/_components/home-hero.vue';
import Ads from '@/components/app@home/_components/home-ads.vue';
import SellAdd from '@/components/app@home/_components/home-sell-add.vue';
import Benefits from '@/components/app@home/_components/home-benefits.vue';
import SecondAds from '@/components/app@home/_components/home-second-ads.vue';
import FavouriteBrands from '@/components/app@home/_components/home-favourite-brands.vue';
import Advertisment from '@/components/app@home/_components/home-advertisments.vue'
import MarketingNumbers from '@/components/app@home/_components/home-marketing-numbers.vue'
import CallToAction from '@/components/app@home/_components/home-call-to-action.vue'
import Footer from '@/components/app/_layout/_components/footer.vue';

export default defineComponent({
  components: {
    HeroSection,
    Ads,
    SellAdd,
    Benefits,
    SecondAds,
    FavouriteBrands,
    Advertisment,
    MarketingNumbers,
    CallToAction,
    Footer
  }
});
</script>
