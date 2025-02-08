<template>
    <div class="mt-24">
        <div class="flex flex-wrap md:flex-nowrap">
            <img class="rounded-t-lg md:rounded-l-lg" src="../_img/about-carimage.png" alt="Luxury Car image">
            <div class="bg-light-blue w-full text-center md:text-left pt-12 pb-12 md:pt-[111px] flex flex-col justify-center items-start pl-4 md:pl-11 align-middle rounded-b-lg md:rounded-r-lg">
                <div class="flex flex-col">
                    <h3 class="text-4xl font-bold w-[95%]">Získajte spravodlivú cenu za svoje auto. Predajte ho ešte dnes!</h3>
                </div>
                <div class="flex flex-col mt-6">
                    <p class="font-medium">Našim zákazníkom sa snažíme poskytovať výnimočné služby, konkurencieschopné ceny a širokú ponuku.</p>
                </div>
                <div class="flex flex-col items-start mt-6">
                    <div class="flex text-left mb-5" v-for="(benefit, index) in benefits" :key="index">
                        <div class="bg-white w-6 h-6 rounded-full flex justify-center items-center mr-2">    
                            <font-awesome-icon :icon="['fas', 'check']" />
                        </div>
                        <h5 class="font-medium">{{ benefit }}</h5>
                    </div>
                </div>
                <div class="flex w-full justify-center md:justify-start">
                    <button class="mt-6 p-3 bg-purple text-white w-32 gap-2 flex items-center justify-center">
                        <span>Zistite viac</span>
                        <svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-20 site-layout">
            <div class="flex flex-wrap justify-center md:gap-40">
                <div class="flex flex-col text-center my-11 w-full sm:w-auto">
                    <h3 class="subtitle subtitle-32">810M</h3>
                    <p class="text-sm mt-1">ÁUT NA PREDAJ</p>
                </div>
                <div class="flex flex-col text-center my-11 w-full sm:w-auto">
                    <h3 class="subtitle subtitle-32">715M</h3>
                    <p class="text-sm mt-1">INZERÁTOV</p>
                </div>
                <div class="flex flex-col text-center my-11 w-full sm:w-auto">
                    <h3 class="subtitle subtitle-32">96M</h3>
                    <p class="text-sm mt-1">NÁVŠTEVNÍKOV DENNE</p>
                </div>
                <div class="flex flex-col text-center my-11 w-full sm:w-auto">
                    <h3 class="subtitle subtitle-32">230M</h3>
                    <p class="text-sm mt-1">OVERENÝCH PREDAJCOV</p>
                </div>
            </div>
        </div>
        <div class="border border-gray-100"></div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: "AboutSubscriptionRevenue",
    data() {
        return {
            benefits: [
                "Sme najväčším poskytovateľom na Slovensku ",
                "Cestná asistencia 24/7",
                "4 z 5 áut opravíme priamo na ceste",
            ]
        };
    }
});

</script>