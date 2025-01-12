<template>
    <HeroSection />
</template>

<script>
import { defineComponent } from 'vue';
import HeroSection from '@/components/app@part/_components/part-hero.vue';

export default defineComponent({
    components: {
        HeroSection
    }
});

</script>