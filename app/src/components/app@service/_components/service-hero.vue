<template>
    <div class="w-full align-middle">
        <Header class="" />
        <section class="flex flex-col md:flex-row items-center justify-center site-layout sm:w-full mt-[5.8rem] mb-[6rem] text-center md:text-left">
        <div class="flex-col">
            <h1 class="subtitle-40 font-bold w-full md:w-[80%]">Ponúkame Online Diagnostiku Vášho Auta!</h1>
            <p class="w-full md:w-[80%] mt-7">Pomocou AI Vám prinášame online diagnostiku
            s Click & Drive, alebo nás navštívte v jednom z našich predajných miest ešte dnes.</p>
            <button class="mt-7 bg-purple text-white pr-6 pl-6 pt-3 pb-3 inline-flex">
                <span>Vyskúšajte hneď teraz!</span>
                <svg class="ml-3 mt-[0.3rem]" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
                </svg>
            </button>
        </div>
        <div class="flex-col flex-shrink-0">
            <img src="../_img/service.png" alt="Service Image" class="max-w-full h-auto md:mt-0 mt-6">
        </div>
        </section>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Header from "@/components/app/_layout/_components/header.vue";

export default defineComponent({
components: {
    Header,
},
});
</script>

<style scoped>

@media screen and (max-width: 640px) {
    .site-layout {
        padding-left: 1rem; 
        padding-right: 1rem; 
    }
}
</style>
  
