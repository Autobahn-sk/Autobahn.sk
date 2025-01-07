<template>
    <form action="" class="input-wrapper">
        <input type="text" class="text-white" placeholder="Vaša e-mailová adresa">
        <button class="button text-base font-medium text-white">Prihlásiť sa</button>
    </form>
</template>

<style scoped>

.input-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.input-wrapper button {
    position: absolute;
    top: 0.5rem;
    right: 0.6rem;
    border: none;
    cursor: pointer;
    width: 6.7rem;
    height: 3rem;
    background-color: #405FF2;
    border-radius: 3.3rem;
}

.input-wrapper input {
    width: 100%;
    width: 25rem;
    height: 4.1rem;
    border-radius: 4.1rem;
    background-color: rgba(255, 255, 255, 0.15);
    padding-left: 1rem;
}

input::placeholder {
    color: white;
}

@media only screen and (max-width: 854px) {

.input-wrapper input {
    width: 100%;
}

.input-wrapper button {
    width: 8rem;
}

}

</style>