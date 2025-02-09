<template>
    <div class="mt-16">
        <div class="w-3/4 flex justify-center flex-col mx-auto">
            <h1 class="subtitle-32 mb-9 flex justify-center">Všeobecné</h1>
            <div v-if="loading" class="flex justify-center items-center">
                <div class="animate-spin border-t-2 border-blue-500 border-solid rounded-full w-10 h-10"></div>
            </div>

            <div v-else>
                <div v-cloak>
                    {{ message }}
                </div>

                <div class="mt-3" v-for="(question, index) in questionsData" :key="index">
                    <button 
                        class="accordion flex justify-between rounded-none rounded-t-lg pt-[18px] pr-[18px] pl-[18px] pb-[18px] hover:bg-[#F9FBFC] color-[#444] w-full outline-none border-none text-left cursor-pointer"
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
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "GeneralAccordion",
    data() { 
        return {
            questionsData: [], 
            loading: true, 
            activeIndex: null 
        };
    },
    mounted() {
        this.fetchQuestions();
    },
    methods: {
        async fetchQuestions() {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_URL}/qna`); 

                let questions = response.data.data ? response.data.data : response.data;
                this.questionsData = questions.filter(q => q.category === "GENERAL");

            } catch (error) {
                console.error("Error fetching questions:", error);
            } finally {
                this.loading = false; 
            }
        },
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