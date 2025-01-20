<template>
    <div>
        <HeroSection />
        <Parts />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import HeroSection from '@/components/app@part/_components/part-hero.vue';
import Parts from './_components/part-parts.vue'

export default defineComponent({
    components: {
        HeroSection,
        Parts
    }
});

</script>