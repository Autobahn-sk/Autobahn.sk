<template>
    <form action="" class="input-wrapper relative inline-block w-full">
        <input class="w-[51.8rem] h-[4.1rem] rounded-[4.1rem] bg-white text-black pl-[3.75rem]" type="text" :placeholder="placeholderText">
        <button class="text-base bg-purple font-medium text-white absolute top-[0.5rem] right-[0.5rem] border-none w-[11.75rem] h-[3rem] rounded-[3.3rem]">Hladať</button>
        <img class="absolute top-[1rem] left-[0.9rem] border-none" src="./_img/OpenAILogo.svg" alt="">
    </form>
</template>

<script>
export default {
  data() {
    return {
      placeholderText: "Popíšte Vaše vysnívané auto",
    };
  },
  methods: {
    updatePlaceholder() {
      if (window.innerWidth <= 768) {
        this.placeholderText = "Popíšte Vaše auto";
      } else {
        this.placeholderText = "Popíšte Vaše vysnívané auto";
      }
    },
  },
  mounted() {
    this.updatePlaceholder();
    window.addEventListener("resize", this.updatePlaceholder);
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.updatePlaceholder);
  },
};
</script>

<style scoped>


.input-wrapper button::before {
    display: inline-block;
    content: "";
    width: 20px;
    height: 20px;
    background-image: url("./_img/SearchIcon.svg");
    background-repeat: no-repeat;
    background-size: contain;
    margin-bottom: -4px;
    margin-right: 5px;
}

input::placeholder {
  color: #050B20;
}

@media only screen and (max-width: 854px) {

    .input-wrapper input {
        width: 100%;
        padding-left: 1rem;
    }

    form img {
        display: none;
    }

    .input-wrapper button {
        width: 8rem;
    }
}

</style>
