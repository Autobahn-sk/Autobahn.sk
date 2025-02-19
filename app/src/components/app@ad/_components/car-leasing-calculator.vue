<template>
    <div class="mt-6 w-full md:w-2/3">
        <h2 class="text-2xl font-medium">Lízingová kalkulačka</h2>
        <div>
            <div class="flex flex-row flex-wrap md:flex-nowrap mt-1 w-full gap-8">
                <div class="flex flex-col m-auto md:m-0">
                    <div class="relative input-wrap">
                        <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                        <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Cena ($)</label>
                    </div>
                    <div class="relative input-wrap">
                        <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                        <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Doba splatnosti úveru (rok)</label>
                    </div>
                </div>
                <div class="flex flex-col m-auto md:m-0"> 
                    <div class="relative input-wrap">
                        <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                        <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Úroková sadzba</label>
                    </div>
                    <div class="relative input-wrap">
                        <input type="number" id="name" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
                        <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Zálohová platba</label>
                    </div>
                </div>
            </div>
            <button class="mt-6 p-3 bg-purple text-white w-32 gap-2 flex items-center justify-center hover:bg-[#1B3DDF]">
                <span>Výpočítať</span>
                <svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
                </svg>
            </button>
        </div>
        <hr class="mt-8 border-[#E1E1E1]">
    </div>
</template>

<style scoped>

.input-wrap label {
    transition: 300ms ease all;
}
      
.input-wrap input:focus ~ label,
.input-wrap input:valid ~ label {
    top: 1.5rem;
    font-size: 0.75rem;
}

@media screen and (max-width: 640px) {
    .ad-site-layout {
        padding-left: 0rem;
        padding-right: 0rem;  
    }
}

</style>