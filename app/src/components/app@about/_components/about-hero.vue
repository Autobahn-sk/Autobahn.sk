<template>
    <div>
        <Header />
        <div class="mt-[96px] large-site-lauyout justift-center items-center m-auto">
            <div class="flex-wrap md:flex-nowrap inline-flex items-center justify-between">
                <div class="w-full text-center md:text-left items-center">
                    <h1 class="text-4xl font-bold">Vážime si našich klientov a Chceme, aby mali pekné skúsenosť</h1>
                </div>
                <div class="w-full text-center md:text-left">
                    <p class="mt-6 md:mt-0 font-light">Lorem ipsum dolor sit amet consectetur. Convallis integer enim eget sit urna. Eu duis lectus amet
                        vestibulum varius. Nibh tellus sit sit at lorem facilisis. Nunc vulputate ac interdum aliquet
                        vestibulum in tellus.
                    </p>
                    <p class="mt-6 font-light">Sit convallis rhoncus dolor purus amet orci urna. Lobortis vulputate vestibulum consectetur donec
                        ipsum egestas velit laoreet justo. Eu dignissim egestas egestas ipsum. Sit est nunc pellentesque at
                        a aliquam ultrices consequat. Velit duis velit nec amet eget eu morbi. Libero non diam sit viverra
                        dignissim. Aliquam tincidunt in cursus euismod enim.
                    </p>
                </div>
            </div>
            <div class="container mx-auto mt-12 flex flex-wrap md:flex-nowrap gap-6">
                <div class="flex flex-col gap-6 w-full md:w-auto">
                    <img class="w-full h-auto rounded-3xl aspect-square object-cover md:w-[166px] md:h-[258.09px]" src="../_img/about-image1.png" alt="About Us Image 1">
                    <img class="w-full h-auto rounded-3xl aspect-square object-cover md:w-[166px] md:h-[166.81px]" src="../_img/about-image2.png" alt="About Us Image 2">
                </div>
                <div class="flex justify-center w-full md:w-auto">
                    <img class="w-full h-auto rounded-3xl aspect-square object-cover md:w-[475.76px] md:h-[453.1px]" src="../_img/about-image3.png" alt="About Us Image 3">
                </div>
                <div class="flex flex-col gap-6 w-full md:w-auto">
                    <img class="w-full h-auto rounded-3xl aspect-square object-cover md:w-[475.76px] md:h-[251.72px]" src="../_img/about-image4.png" alt="About Us Image 4">
                    <div class="flex gap-3">
                        <img class="w-1/2 h-auto aspect-square rounded-3xl object-cover md:w-[176.21px] md:h-[176.21px]" src="../_img/about-image5.png" alt="About Us Image 5">
                        <img class="w-1/2 h-auto aspect-square rounded-3xl object-cover md:w-[276.06px] md:h-[176.21px]" src="../_img/about-image6.png" alt="About Us Image 6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Header from "@/components/app/_layout/_components/header.vue";

export default defineComponent({
    components: {
        Header
    }
})


</script>