<template>
    <div class="bg-violet full-width-screen w-screen">
        <div class="site-layout pt-20 pb-20 flex flex-wrap md:flex-nowrap gap-6">
            <div class="flex-shrink-0 w-full md:w-1/2 flex justify-start">
                <img src="../_img/advertismentAdd.png" alt="" class="max-w-full h-auto">
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-center text-center md:text-left">
                <h4 class="subtitle subtitle-32 md:w-4/5 leading-10">Flexibilné Financovanie Na Mieru Pre Vás</h4>
                <p class="mt-6 md:w-4/5">
                    AA Car Finance vám umožňuje získať ponuku bez toho, aby to ovplyvnilo váš úverový rating. Vyhľadajte auto od akéhokoľvek predajcu a my sa postaráme o zvyšok. S veľkým panelom viac ako 30 veriteľov môžeme pomôcť väčšine vodičov.
                </p>
                <button class="mt-6 p-3 bg-purple text-white w-32 flex items-center justify-center gap-2">
                    <span>Zistite viac</span>
                    <svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
  
<script>
import { defineComponent } from 'vue';

export default defineComponent({
components: {

},
});
</script>
  
<style scoped>

@media screen and (max-width: 640px) {
    .ad-site-layout {
        padding-left: 1.25rem;
        padding-right: 1.25rem;  
    }
}

</style>