<template>
    <div class="mt-16">
        <h1 class="subtitle-32 mb-9 flex justify-center">Všeobecné</h1>
        <div class="mt-3" v-for="(question, index) in questionsData" :key="index">
            <button class="accordion rounded-none rounded-t-lg pt-[18px] pr-[18px] pl-[18px] pb-[18px] hover:bg-[#F9FBFC] color-[#444] w-full outline-none border-none text-left cursor-pointer">
                <h3>{{ question.question }}</h3>
            </button>
            <div class="panel rounded-b-lg bg-[#F9FBFC] pt-[18px] pr-[18px] pl-[18px] pb-[18px] overflow-auto display-none">
                <p>{{ question.answer }}</p>
            </div>
        </div>   
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "GeneralAccordion",
    data() { 
        return {
            questionsData: [ 
                {
                    question: 'Vlastní Autobahn.sk vozidlá, ktoré vidím online, alebo ich vlastnia iné spoločnosti?',
                    answer: 'Cras vitae ac nunc orci. Purus amet tortor non at phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.'
                },
                {
                    question: 'Môžem si svoje obľúbené vozidlá uložiť a pozrieť si ich neskôr?',
                    answer: 'You can contact the company by phone or email.'
                },
                {
                    question: 'Môžem byť upozornený, keď sa pridajú vozidlá, ktoré sa mi páčia?',
                    answer: 'The company is open Monday through Friday from 9am to 5pm.'
                },
                {
                    question: 'Aké nástroje máte k dispozícii, aby ste mi pomohli nájsť to správne auto pre mňa?',
                    answer: 'The company is open Monday through Friday from 9am to 5pm.'
                }
            ]
        };
    },
    mounted() {
        let buttons = this.$el.querySelectorAll(".accordion"); 
        let panels = this.$el.querySelectorAll(".panel");

        for (let i = 0; i < panels.length; i++) {
            panels[i].style.display = "none";
        }

        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function () {
                let panel = panels[i]; 
                let isOpen = panel.style.display === "block";

                for (let j = 0; j < buttons.length; j++) {
                    buttons[j].classList.remove("button-active");
                    panels[j].style.display = "none"; 
                }

                if (!isOpen) {
                    panel.style.display = "block";
                    this.classList.add("button-active");
                }
            });
        }
    }
};
</script>

<style scoped>

.accordion {
  transition: 0.4s;
}

.button-active {
    background-color: #F9FBFC;
}

</style>