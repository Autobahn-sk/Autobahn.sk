<template>
    <div class="w-full">
        <Header />
        <section class="flex flex-col md:flex-row items-center justify-center w-full mt-[5.8rem] mb-[6rem] text-center md:text-left">
            <div class="flex-col items-center justify-center text-center w-full md:w-[70%]">
                <h1 class="subtitle-32 font-bold">Online Diagnostika</h1>
                <div class="mt-8">
                    <Searchbar />
                </div>
                <div class="mt-8 border-[#E9E9E9] border flex flex-col text-left rounded-2xl h-auto py-6 pl-7 pr-7">
                    <h6 class="font-bold text-lg">Popis</h6>
                    <p class="mt-4">{{ Description }}</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Header from "@/components/app/_layout/_components/header.vue";
import Searchbar from "@/components/app@part/_components/part-searchbar.vue";

export default defineComponent({
components: {
    Header,
    Searchbar
},
data() {
    return {
        Description: "Pomocou AI Vám prinášame online diagnostiku s Click & Drive, alebo nás navštívte v jednom z našich predajných miest ešte dnes."
    }
},
});
</script>