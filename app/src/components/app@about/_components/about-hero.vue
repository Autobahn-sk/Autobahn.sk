<template>
    <div>
        <Header />
        <div class="mt-[96px]">
            <div class="w-full">
                <h1 class="text-4xl font-bold w-40%">Vážime si našich klientov a Chceme, aby mali pekné skúsenosť</h1>
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