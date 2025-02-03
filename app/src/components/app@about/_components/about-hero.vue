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