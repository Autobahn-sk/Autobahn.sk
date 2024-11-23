<template>
    <form action="" class="input-wrapper">
        <input type="text" placeholder="Popíšte Vaše vysnívané auto">
        <button class="button text text-16">Hladať</button>
        <img src="./_img/OpenAILogo.svg" alt="">
    </form>
</template>

<style>

.input-wrapper {
    position: relative;
    display: inline-block;
}

.input-wrapper button {
    position: absolute;
    top: 9px;
    right: 9px;
    border: none;
    cursor: pointer;
    width: 188px;
    height: 49px;
    background-color: #405FF2;
    border-radius: 53px;
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
    width: 60vw;
    height: 67px;
    border-radius: 67px;
    background-color: white;
    color: #050B20;
    padding-left: 60px;
}

input::placeholder {
  color: #050B20;
}

</style>
