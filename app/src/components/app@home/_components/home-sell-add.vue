<template>
    <div class="sell-add-images flex flex-wrap justify-center my-24 justify-between">
        <div class="find-car-background flex flex-col justify-center p-8 sm:p-10 md:w-[49%] w-ful">
            <div>
                <h3 class="text-white text-3xl font-bold">Hladáte si svoje nové auto ?</h3>
            </div>
            <div class="my-5">
                <p class="text-white text-balance text-pretty">Našim zákazníkom sa snažíme poskytovať
                výnimočné služby.</p> 
            </div>
            <div>
                <button>Začnite hneď</button>
            </div>
        </div>
        <div class="sell-car-background flex mt-6 md:mt-0 flex-col justify-center p-8 sm:p-10 md:w-[49%] w-full">
                <div>
                    <h3 class="text-white text-3xl font-bold">Hladáte si svoje nové auto ?</h3>
                </div>
                <div class="my-5">
                   <p class="text-white text-balance text-pretty">Našim zákazníkom sa snažíme poskytovať
                    výnimočné služby.</p> 
                </div>
                <div>
                    <button>Začnite hneď</button>
                </div>
            </div>
    </div>
</template>

<style scoped>

.find-car-background{
    background-image: url('../_img/audi.png');
    background-position: center;
    background-size: cover;
    height: 380px;
    border-radius: 16px;

}

.sell-car-background{
    background-image: url('../_img/bmw.png');
    background-position: center;
    background-size: cover;
    height: 380px;
    border-radius: 16px;
}

.sell-add-images h3 {
    width: 60%;
    line-height: 44.5px;
}

.sell-add-images p {
    width: 70%;
    line-height: 27.4px;
}

.sell-add-images button {
    background: white;
    width: 157px;
    height: 59px;
    border-radius: 12px;
}

.sell-add-images button::after {
    display: inline-block;
    content: "";
    width: 14px;
    height: 14px;
    background-image: url('@/components/app@_components/_img/arrowBlack.svg');
    background-repeat: no-repeat;
    background-size: contain;
    margin-left: 10px;
}

</style>