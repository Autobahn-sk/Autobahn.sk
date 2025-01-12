<template>
    <form action="" class="input-wrapper relative inline-block w-full">
        <input class="border-[#E9E9E9] border w-full h-[4.1rem] rounded-[4.1rem] bg-white text-black pl-[3.75rem]" type="text" :placeholder="placeholderText">
        <button class="text-base bg-purple font-medium text-white absolute top-[0.5rem] right-[1rem] border-none w-[11.75rem] h-[3rem] rounded-[3.3rem]">Hladať</button>
        <img class="absolute top-[1rem] left-[0.9rem] border-none" src="@/components/app@_components/_img/OpenAILogo.svg" alt="">
    </form>
</template>

<script>
export default {
  data() {
    return {
      placeholderText: "Popíšte Váš problém",
    };
  },
};
</script>

<style scoped>

.input-wrapper button::before {
    display: inline-block;
    content: "";
    width: 1.25rem;
    height: 1.25rem;
    background-image: url("@/components/app@_components/_img/SearchIcon.svg");
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
