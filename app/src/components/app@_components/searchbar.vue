<template>
    <form action="" class="input-wrapper">
        <input type="text" :placeholder="placeholderText">
        <button class="button text-base font-medium text-white">Hladať</button>
        <img src="./_img/OpenAILogo.svg" alt="">
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

.input-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.input-wrapper button {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    border: none;
    cursor: pointer;
    width: 11.75rem;
    height: 3rem;
    background-color: #405FF2;
    border-radius: 3.3rem;
}

.input-wrapper img {
    position: absolute;
    top: 17px;
    left: 15px;
    border: none;
}

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

.input-wrapper input {
    width: 51.8rem;
    height: 4.1rem;
    border-radius: 4.1rem;
    background-color: white;
    color: #050B20;
    padding-left: 3.75rem;
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
