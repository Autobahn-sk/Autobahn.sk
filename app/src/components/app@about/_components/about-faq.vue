<template>
    <div class="mt-[93px] mb-[155px]">
        <div class="w-3/4 flex justify-center flex-col mx-auto">
            <h1 class="subtitle-32 mb-9 flex justify-center text-center">Často kladené otázky</h1>
                <div class="mt-3" v-for="(question, index) in questionsData" :key="index">
                    <button class="accordion flex justify-between rounded-none rounded-t-lg pt-[18px] pr-[18px] pl-[18px] pb-[18px] hover:bg-[#F9FBFC] color-[#444] w-full outline-none border-none text-left cursor-pointer"
                        @click="toggleAccordion(index)" 
                        :class="{ 'bg-[#F9FBFC]': activeIndex === index }">
                        <h3 class="text-black">{{ question.question }}</h3>
                        <span :class="{'rotate-45': activeIndex === index}" class="mr-2 inline-block text-2xl">+</span>
                    </button>
                <div 
                    class="panel rounded-b-lg bg-[#F9FBFC] pt-[18px] pr-[18px] pl-[18px] pb-[18px] overflow-auto" 
                    v-show="activeIndex === index">
                    <p>{{ question.answer }}</p>
                </div>
            </div>   
        </div>
    </div>
</template>

<script>

export default {
    name: "GeneralAccordion",
    data() { 
        return {
            questionsData: [
                {
                    question: "Vlastní spoločnosť Autobahn.sk inzerované vozidlá?",
                    answer: "Nie, Autobahn.sk nie je vlastníkom inzerovaných vozidiel. Autobahn.sk je online inzertný portál, ktorý umožňuje inzerovať vozidlá a iné produkty a služby. Autobahn.sk nie je zodpovedný za obsah inzerátov, ktoré sú zverejnené na stránke."
                },
                {
                    question: "Ako vyberáte autá, ktoré predávate?",
                    answer: "Autobahn.sk nie je vlastníkom inzerovaných vozidiel. Autobahn.sk je online inzertný portál, ktorý umožňuje inzerovať vozidlá a iné produkty a služby. Autobahn.sk nie je zodpovedný za obsah inzerátov, ktoré sú zverejnené na stránke."
                },
                {
                    question: "Môžem si svoje obľúbené vozidlá uložiť a zobraziť neskôr?",
                    answer: "Áno, môžete si uložiť svoje obľúbené vozidlá a zobraziť ich neskôr. Pre uloženie vozidla do obľúbených kliknite na tlačidlo s ikonou srdca, ktoré sa nachádza na stránke detailu vozidla. Pre zobrazenie uložených vozidiel kliknite na tlačidlo Obľúbené v hornej časti stránky."
                },
                {
                    question: "Môžem byť informovaný o pridaní vozidiel, ktoré sa mi páčia?",
                    answer: "Áno, môžete byť informovaný o pridaní nových vozidiel, ktoré zodpovedajú vašim preferenciám. Pre nastavenie upozornení kliknite na tlačidlo s ikonou zvončeka, ktoré sa nachádza na stránke detailu vozidla."
                },
                {
                    question: "Aké nástroje máte k dispozícii, aby ste mi pomohli nájsť to správne auto?",
                    answer: "Na Autobahn.sk máte k dispozícii rôzne nástroje, ktoré vám pomôžu nájsť to správne vozidlo. Môžete použiť vyhľadávanie podľa značky, modelu, ceny, roku výroby, stavu vozidla, typu karosérie, typu paliva, výkonu motora, prevodovky..."
                }
            ],
            activeIndex: null 
        };
    },
    methods: {
        toggleAccordion(index) { 
            this.activeIndex = this.activeIndex === index ? null : index;
        }
    }
};
</script>

<style scoped>
.accordion {
  transition: 0.4s;
}
</style>