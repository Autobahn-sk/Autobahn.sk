<template>
  <div class="pr-6 pl-6 py-6 flex flex-col border-2 border-gray-100 rounded-2xl w-full"
    :class="{'bg-[#405FF2] text-white': isSecondCard}"
    >
    <h3 class="subtitle-32 mt-4 text-left">{{ item.Price }}</h3>
    <h4 class="mt-3.5 text-lg">{{ item.Plan }}</h4>
    <p class="text-base mt-4">{{ item.Description }}</p>
    <div class="mt-4">
      <div class="flex items-center align-middle mb-3"
        v-for="(benefit, index) in benefits"
        :key="index"
      >
        <div 
          class="bg-dark-violet w-6 h-6 rounded-full flex items-center justify-center"
          :style="{ backgroundColor: isSecondCard ? '#FFF' : '' }"
        >
          <font-awesome-icon :icon="['fas', 'check']" :style="{ color: '#405ff2' }" />
        </div>
        <h5 class="ml-2">{{ benefit }}</h5>
      </div>
      <div class="mt-6">
        <button class="border"
        :class="{
            'border-[#405FF2] pr-20 pl-20 py-4 text-purple hover:bg-[#405FF2] hover:text-white': !isSecondCard,
            'border-white bg-white text-purple pr-20 pl-20 py-4 hover:border-[#FFF] hover:bg-[#405FF2] hover:text-white ]': isSecondCard
          }"
        >
          Zakúpiť
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MembershipCard",
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  computed: {
    benefits() {
      return [
        this.item["First benefit"],
        this.item["Second benefit"],
        this.item["Third benefit"],
        this.item["Fourth benefit"],
        this.item["Fifth benefit"],
        this.item["Sixth benefit"],
      ];
    },
    isSecondCard() {
      return this.$parent.data.indexOf(this.item) === 1;
    },
  },
};
</script>