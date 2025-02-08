<template>
    <div class="mt-[96px] mr-10 ml-10 mb-[96px]">
        <div class="flex w-full justify-between flex-wrap md:flex-nowrap text-center md:text-left">
            <h3 class="subtitle-32">Prezrite si naše prémiové značky</h3>
            <div class="flex justify-start mx-auto md:mx-0 mt-6 md:mt-0">
                <a href="" class="text-black mr-2">Všetky značky</a>
                <svg class="mt-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="black"/>
                </svg>
            </div>
        </div>
        <div class="mt-16 flex justify-start overflow-x-auto w-full">
            <div class="flex gap-6 mx-auto">
                <Brands
                    v-for="brand in brands"
                    :key="brand.name"
                    :BrandName="brand.name"
                    :BrandImage="brand.image"
                />
            </div>
        </div> 
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import Brands from '@/components/app@_components/brands.vue';
import AudiLogo from "@/components/app@_components/_img/audiLogo.png";
import BMWLogo from "@/components/app@_components/_img/bmwLogo.png";
import FordLogo from "@/components/app@_components/_img/fordLogo.png";
import MercedesLogo from "@/components/app@_components/_img/mercedesLogo.png";
import PeugeotLogo from "@/components/app@_components/_img/peugeotLogo.png";
import VolkswagenLogo from "@/components/app@_components/_img/volkswagenLogo.png";

export default defineComponent({
    components: {
        Brands
    },
    data() {
        return {
            brands: [
                { name: "Audi", image: AudiLogo},
                { name: "BMW", image: BMWLogo},
                { name: "Ford", image: FordLogo },
                { name: "Mercedes", image: MercedesLogo },
                { name: "Peugeot", image: PeugeotLogo },
                { name: "Volkswagen", image: VolkswagenLogo },
            ],
        };
     },
});
</script>