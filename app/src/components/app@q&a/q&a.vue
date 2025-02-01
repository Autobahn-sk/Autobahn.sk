<template>
    <div>
        <Header />
        <generalAccordion />
        <paymentsAccordion />
        <Footer />  
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Header from "@/components/app/_layout/_components/header.vue";
import generalAccordion from './_components/general-accordion.vue';
import paymentsAccordion from './_components/payments-accordion.vue';
import Footer from '@/components/app/_layout/_components/footer.vue';

export default defineComponent({
    components: {
        Header,
        generalAccordion,
        paymentsAccordion,
        Footer
    }
})

</script>