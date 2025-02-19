<template>
    <div class="mt-6 md:w-2/3">
        <div v-if="reviews.length > 0">
            <div v-for="review in reviews" :key="review.id" class="flex gap-4 p-4">
                <img src="https://i.pravatar.cc" alt="User Avatar" class="w-10 h-10 rounded-full" />
                <div>
                <div class="font-semibold text-black">{{ review.name }}</div>
                <div class="text-sm text-gray-500">{{ review.date }}</div>
                <p class="mt-1 text-gray-700">{{ review.review }}</p>
                </div>
            </div>
        </div>
        <div v-else class="text-gray-500">Žiadne recenzie na zobrazenie.</div>
        <hr class="mt-8 border-[#E1E1E1]">
        <div class="mt-6">
            <h2 class="text-2xl font-medium">Pridať komentár</h2>
            <!-- <div class="flex w-full justify-between flex-wrap md:flex-nowrap"> 
                <div class="relative input-wrap">
                    <input type="number" id="name" required class="border border-[#E1E1E1] md:w-[400px] w-full mt-6 p-3 rounded-xl"/>
                    <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Meno</label>
                </div>
                <div class="relative input-wrap">
                    <input type="number" id="name" required class="border border-[#E1E1E1] md:w-[400px] w-full mt-6 p-3 rounded-xl"/>
                    <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">E-mail</label>
                </div>
            </div> -->
            <div class="w-full">
                <div class="relative input-wrap">
                    <input type="text" id="name" required class="border border-[#E1E1E1] w-full h-auto md:h-[148px] mt-6 p-3 rounded-xl"/>
                    <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Popis</label>
                </div>
            </div>
            <div class="w-full">
                <button class="mt-6 p-3 bg-purple text-white flex items-center justify-center hover:bg-[#1B3DDF]"> Odoslať recenziu</button>
            </div>
        </div>
        <hr class="mt-8 border-[#E1E1E1]">
    </div>
</template>
  
<script>
import adsData from "@/assets/mocks/ad-cards.json";

export default {
setup() {
    const reviews = adsData[0]?.reviews || [];
    return { reviews };
},
};
</script>

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