<template>
  <div :class="[widthClass, 'flex flex-col text-left']">
    <div v-html="icon" class="w-16 h-16"></div>
    <h4 :class="[titleClass, 'mt-5']">{{ title }}</h4>
    <p :class="[descriptionClass, 'mt-2']">{{ description }}</p>
  </div>
</template>

<script>
export default {
  name: "Benefit",
  props: {
    icon: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    description: {
      type: String,
      required: true,
    },
    titleClass: {
      type: String,
      default: "text-xl font-semibold",
    },
    descriptionClass: {
      type: String,
      default: "text-gray-600",
    },
    widthClass: {
      type: String,
      default: "w-full",
    },
  },
};
</script>