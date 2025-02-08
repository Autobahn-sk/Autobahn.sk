<template>
    <div>
        <HeroSection />
        <Benefits />
        <SubscriptionRevenue />
        <Brands />
        <Testimonials />
    </div>
</template>

<script>
import { defineComponent } from 'vue'   
import HeroSection from '@/components/app@about/_components/about-hero.vue'
import Benefits from '@/components/app@about/_components/about-benefits.vue'
import SubscriptionRevenue from '@/components/app@about/_components/about-subscription-revenue.vue'
import Brands from '@/components/app@about/_components/about-brands.vue'
import Testimonials from '@/components/app@about/_components/about-testimonials.vue'

export default defineComponent({
    components: {
        HeroSection,
        Benefits,
        SubscriptionRevenue,
        Brands,
        Testimonials
    }
})

</script>