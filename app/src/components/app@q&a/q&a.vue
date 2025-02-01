<template>
    <div>
        <Header />
        <generalAccordion />
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Header from "@/components/app/_layout/_components/header.vue";
import generalAccordion from './_components/general-accordion.vue';

export default defineComponent({
    components: {
        Header,
        generalAccordion,
    }
})

</script>