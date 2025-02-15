<template>
    <footer class="bg-black full-width-screen overflow-hidden">
        <div class="site-layout w-full">
            <div class="pt-12 pb-10 flex flex-wrap justify-between w-full">
                <div class="flex flex-col text-center md:text-left pt-1">
                    <h4 class="text-2xl font-medium text-white">Pripojte sa k Autobahn komunite</h4>
                        <p class="text-white font-normal text-base pt-1 leading-5 mt-3 md:mt-0">
                            Dostávajte aktualizácie cien, nákupné tipy a ďalšie informácie!
                        </p>
                </div>
                <div class="flex flex-col mt-6 md:mt-0">
                    <Searchbar />
                </div>
            </div>
            <hr class="bg-light-black border-none h-[0.06rem]">
            <div class="py-12 flex flex-wrap md:justify-between justify-center">
                <div class="flex flex-wrap md:gap-32 gap-14 justify-center text-center md:text-left">
                    <div class="text-white flex-col">
                        <h6 class="text-20 font-medium">Stránky</h6>
                        <div class="mt-3 items flex flex-col">
                            <a>Domov</a>
                            <a>Virtuálny seris</a>
                            <a>Q&A</a>
                        </div>
                    </div>
                    <div class="text-white flex-col">
                        <h6 class="text-20 font-medium">Naše značky</h6>
                        <div class="mt-3 items flex flex-col">
                            <a>Audi</a>
                            <a>BMW</a>
                            <a>Ford</a>
                            <a>Nissan</a>
                            <a>Peugeot</a>
                            <a>Volkswagen</a>
                        </div>
                    </div>
                <div class="text-white flex-col">
                    <h6 class="text-20 font-medium">Typy vozidiel</h6>
                    <div class="mt-3 items flex flex-col">
                        <a>Sedan</a>
                        <a>Hatchback</a>
                        <a>SUV</a>
                        <a>Hybrid</a>
                        <a>Elektrické</a>
                        <a>Coupe</a>
                        <a>Pickup</a>
                        <a>Kabriolet</a>
                    </div>
                </div>
            </div>
            <div class="text-white flex-col pt-6">
                <h6 class="text-20 font-medium text-center md:text-left">Naša mobilná aplikácia</h6>
                <div class="mt-5 items">
                    <button class="mt-6 py-4 px-8 flex flex-col items-center justify-center">
                        <span class="text-sm ml-6">Stiahnite na</span>
                            <span class="flex items-center justify-center">
                                <span class="custom-logo mr-3">
                                    <svg width="26" height="32" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2011 9.20791C12.2011 9.28095 12.0916 11.4357 14.4654 12.5678C14.0272 13.9191 12.4933 16.9138 10.7038 16.9138C9.68119 16.9138 9.09685 16.2564 7.92819 16.2564C6.72301 16.2564 6.06563 16.9138 5.15262 16.9138C3.39962 16.9868 1.71967 13.7 1.2449 12.3487C0.87969 11.3261 0.733607 10.34 0.733607 9.39051C0.733607 6.14017 2.88833 4.56977 4.93349 4.53325C5.91955 4.53325 7.16126 5.22715 7.70907 5.22715C8.22036 5.22715 9.64466 4.38717 10.9594 4.49673C12.3107 4.6063 13.3333 5.11759 14.0272 6.10365C12.822 6.87058 12.2011 7.85664 12.2011 9.20791ZM10.156 3.21851C9.42554 4.05848 8.54904 4.53325 7.5995 4.46021C7.52646 3.47415 7.89167 2.56113 8.54904 1.83072C9.13337 1.17335 10.156 0.625536 11.0325 0.552495C11.0325 0.954223 11.142 2.04984 10.156 3.21851Z" fill="white"/>
                                    </svg>
                                </span>
                                <span class="ml-2 text-lg font-medium">Apple Store</span>
                            </span>
                    </button>
                    <button class="mt-4 py-4 px-8 flex flex-col items-center justify-center">
                        <span class="text-sm ml-6">Dostante na</span>
                            <span class="flex items-center justify-center">
                                <span class="custom-logo mr-3">
                                    <svg width="24" height="30" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4568 8.81776L3.38568 0.710163L13.648 6.62652L11.4568 8.81776ZM1.304 0.235394L10.6533 9.5847L1.304 18.934C0.829229 18.7149 0.500543 18.2401 0.500543 17.6558V1.55014C0.500543 0.965809 0.829229 0.491039 1.304 0.235394ZM16.8253 8.48908C17.5192 9.00037 17.5192 10.2056 16.8618 10.7168L14.6706 11.9585L12.2602 9.5847L14.6706 7.24737L16.8253 8.48908ZM3.38568 18.4592L11.4568 10.3882L13.648 12.5794L3.38568 18.4592Z" fill="white"/>
                                    </svg>
                                </span>
                                <span class="ml-2 text-lg font-medium">Google Play</span>
                            </span>
                    </button>
                </div>
                <div class="mt-7">
                    <h6 class="text-20 font-medium text-center md:text-left">Prepojte sa s nami</h6>
                    <div class="flex flex-wrap mt-4 gap-4 md:justify-start justify-center">
                        <a class="pt-1">
                            <svg width="16" height="20" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.84611 6.3153H4.20267V11.2237H2.01143V6.3153H0.21461V4.29936H2.01143V2.74357C2.01143 0.990578 3.06323 0.00451815 4.66283 0.00451815C5.42977 0.00451815 6.24053 0.157905 6.24053 0.157905V1.88899H5.34212C4.46562 1.88899 4.20267 2.41489 4.20267 2.98461V4.29936H6.15288L5.84611 6.3153Z" fill="white"/>
                            </svg>
                        </a>
                        <a class="pt-1">
                            <svg width="20" height="24" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3622 2.33521C10.3622 2.44477 10.3622 2.53242 10.3622 2.64198C10.3622 5.68781 8.06143 9.17189 3.83233 9.17189C2.51758 9.17189 1.3124 8.79938 0.304424 8.142C0.479723 8.16392 0.655023 8.18583 0.852235 8.18583C1.92594 8.18583 2.912 7.81332 3.70085 7.19977C2.69288 7.17786 1.83829 6.52048 1.55343 5.60016C1.70682 5.62207 1.83829 5.64399 1.99168 5.64399C2.18889 5.64399 2.40802 5.60016 2.58332 5.55634C1.53152 5.33721 0.742673 4.41689 0.742673 3.29936V3.27744C1.04945 3.45274 1.42196 3.54039 1.79447 3.5623C1.15901 3.14597 0.764585 2.44477 0.764585 1.65592C0.764585 1.21767 0.874147 0.82325 1.07136 0.494564C2.21081 1.87505 3.91998 2.79537 5.82636 2.90493C5.78253 2.72963 5.76062 2.55433 5.76062 2.37903C5.76062 1.10811 6.7905 0.0782275 8.06143 0.0782275C8.7188 0.0782275 9.31043 0.341177 9.74868 0.801338C10.2527 0.691776 10.7567 0.494564 11.1949 0.231615C11.0196 0.779425 10.669 1.21767 10.1869 1.50254C10.6471 1.45871 11.1073 1.32724 11.5017 1.15194C11.1949 1.6121 10.8005 2.00652 10.3622 2.33521Z" fill="white"/>
                            </svg>
                        </a>
                        <a class="pt-1">
                            <svg width="20" height="24" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.55823 3.09417C6.93872 3.09417 8.07816 4.23362 8.07816 5.6141C8.07816 7.0165 6.93872 8.13403 5.55823 8.13403C4.15584 8.13403 3.0383 7.0165 3.0383 5.6141C3.0383 4.23362 4.15584 3.09417 5.55823 3.09417ZM5.55823 7.25753C6.45664 7.25753 7.17975 6.53442 7.17975 5.6141C7.17975 4.71569 6.45664 3.99258 5.55823 3.99258C4.63791 3.99258 3.9148 4.71569 3.9148 5.6141C3.9148 6.53442 4.65982 7.25753 5.55823 7.25753ZM8.75745 3.00652C8.75745 3.33521 8.4945 3.59816 8.16581 3.59816C7.83713 3.59816 7.57418 3.33521 7.57418 3.00652C7.57418 2.67784 7.83713 2.41489 8.16581 2.41489C8.4945 2.41489 8.75745 2.67784 8.75745 3.00652ZM10.4228 3.59816C10.4666 4.40892 10.4666 6.8412 10.4228 7.65196C10.379 8.44081 10.2037 9.12009 9.63395 9.71173C9.06422 10.2815 8.36302 10.4567 7.57418 10.5006C6.76342 10.5444 4.33114 10.5444 3.52038 10.5006C2.73153 10.4567 2.05224 10.2815 1.46061 9.71173C0.890884 9.12009 0.715584 8.44081 0.671759 7.65196C0.627935 6.8412 0.627935 4.40892 0.671759 3.59816C0.715584 2.80931 0.890884 2.10811 1.46061 1.53839C2.05224 0.968665 2.73153 0.793366 3.52038 0.749541C4.33114 0.705716 6.76342 0.705716 7.57418 0.749541C8.36302 0.793366 9.06422 0.968665 9.63395 1.53839C10.2037 2.10811 10.379 2.80931 10.4228 3.59816ZM9.371 8.50654C9.63395 7.87108 9.56821 6.33721 9.56821 5.6141C9.56821 4.9129 9.63395 3.37903 9.371 2.72166C9.1957 2.30532 8.86701 1.95472 8.45067 1.80134C7.7933 1.53839 6.25943 1.60413 5.55823 1.60413C4.83512 1.60413 3.30125 1.53839 2.66579 1.80134C2.22754 1.97664 1.89886 2.30532 1.72356 2.72166C1.46061 3.37903 1.52634 4.9129 1.52634 5.6141C1.52634 6.33721 1.46061 7.87108 1.72356 8.50654C1.89886 8.94479 2.22754 9.27348 2.66579 9.44878C3.30125 9.71173 4.83512 9.64599 5.55823 9.64599C6.25943 9.64599 7.7933 9.71173 8.45067 9.44878C8.86701 9.27348 9.21761 8.94479 9.371 8.50654Z" fill="white"/>
                            </svg>
                        </a>
                        <a class="pt-1">
                            <svg width="20" height="24" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.4905 9.82129H0.452648V3.26947H2.4905V9.82129ZM1.46062 2.39297C0.82516 2.39297 0.299261 1.84516 0.299261 1.18779C0.299261 0.552329 0.82516 0.0264306 1.46062 0.0264306C2.11799 0.0264306 2.64389 0.552329 2.64389 1.18779C2.64389 1.84516 2.11799 2.39297 1.46062 2.39297ZM10.0941 9.82129H8.07818V6.64399C8.07818 5.87705 8.05626 4.9129 7.00447 4.9129C5.95267 4.9129 5.79928 5.72366 5.79928 6.57825V9.82129H3.76143V3.26947H5.71163V4.16788H5.73354C6.01841 3.66389 6.67578 3.11608 7.66184 3.11608C9.72161 3.11608 10.116 4.47465 10.116 6.22765V9.82129H10.0941Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <hr class="bg-light-black h-[0.06rem] border-none">
            <div class="py-7 flex justify-between flex-wrap">
                <div class="flex justify-center md:justify-start text-center">
                    <p class="text-white">© {{ getCurrentYear }} autobahn.sk Všetky práva vyhradené.</p>
                </div>
                <div class="text-white flex gap-0 md:gap-3.5 justify-center flex-wrap text-center items-center">
                    <a class="mt-2 md:mt-0" href="">Podmienky používania</a>
                    <p class="hidden md:block">●</p>
                    <a class="mt-2 md:mt-0" href="">Ochrana súkromia</a>
                </div>
            </div>  
        </div> 
    </footer>
</template>
  


<script>
import { defineComponent } from 'vue'
import Header from '@/components/app/_layout/_components/header-transparent.vue';
import Searchbar from '@/components/app@_components/footer-searchbar.vue'

export default defineComponent({
  components: {
    Header,
    Searchbar
  },
  computed: {
    getCurrentYear() {
      return new Date().getFullYear();
    }
  }
});
</script>

<style scoped>

.items a {
    margin-top: 0.5rem;
}

.items button {
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
}

.items button:hover {
    opacity: 0.8;
}

.custom-logo {
    margin-top: -1.5rem;
}

</style>