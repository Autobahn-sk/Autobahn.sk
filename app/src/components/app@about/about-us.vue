<template>
    <HeroSection />
</template>

<script>
import { defineComponent } from 'vue'   
import HeroSection from '@/components/app@about/_components/about-hero.vue'

export default defineComponent({
    components: {
        HeroSection,
    }
})

</script>