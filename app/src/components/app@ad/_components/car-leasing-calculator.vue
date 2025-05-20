<template>
    <div class="mt-6 w-full md:w-2/3">
      <h2 class="text-2xl font-medium">Lízingová kalkulačka</h2>
      <div>
        <div class="flex flex-row flex-wrap md:flex-nowrap mt-1 w-full gap-8">
          <div class="flex flex-col m-auto md:m-0">
            <div class="relative input-wrap">
              <input type="number" v-model.number="price" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
              <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Cena (€)</label>
            </div>
            <div class="relative input-wrap">
              <input type="number" v-model.number="years" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
              <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Doba splatnosti úveru (roky)</label>
            </div>
          </div>
          <div class="flex flex-col m-auto md:m-0">
            <div class="relative input-wrap">
              <input type="number" v-model.number="interest" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
              <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Úroková sadzba (%)</label>
            </div>
            <div class="relative input-wrap">
              <input type="number" v-model.number="downPayment" required class="border border-[#E1E1E1] w-auto md:w-[19rem] mt-6 p-3 rounded-xl"/>
              <label class="absolute left-[0.9rem] top-[2.3rem] text-gray-400">Zálohová platba (€)</label>
            </div>
          </div>
        </div>
  
        <button @click="calculate" class="mt-6 p-3 bg-purple text-white w-32 gap-2 flex items-center justify-center hover:bg-[#1B3DDF]">
          <span>Výpočítať</span>
          <svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
          </svg>
        </button>
  
        <div v-if="monthlyPayment !== null" class="mt-6 text-lg font-semibold">
          Mesačná splátka: {{ monthlyPayment.toFixed(2) }} €
        </div>
      </div>
      <hr class="mt-8 border-[#E1E1E1]">
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  

  const price = ref(0)
  const years = ref(1)
  const interest = ref(5)
  const downPayment = ref(0)
  const monthlyPayment = ref(null)
  

  const calculate = () => {
    const loanAmount = price.value - downPayment.value
    const totalMonths = years.value * 12
    const monthlyInterest = (interest.value / 100) / 12
  
    if (monthlyInterest === 0) {
      monthlyPayment.value = loanAmount / totalMonths
    } else {
      monthlyPayment.value =
        (loanAmount * monthlyInterest) /
        (1 - Math.pow(1 + monthlyInterest, -totalMonths))
    }
  }
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
  </style>