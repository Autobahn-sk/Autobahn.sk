<template>
    <div>
        <HeroSection />
        <Benefits />
    </div>
</template>

<script>
import { defineComponent } from 'vue'   
import HeroSection from '@/components/app@about/_components/about-hero.vue'
import Benefits from '@/components/app@about/_components/about-benefits.vue'

export default defineComponent({
    components: {
        HeroSection,
        Benefits
    }
})

</script>