<template>
    <div class="flex items-center flex-row">
        <div v-html="icon"></div>
        <div class="ml-2 gap-12 flex">
            <h6 class="w-[107px]" >{{ carInfo }}</h6>
            <p >{{ carInfoData }}</p>
        </div>
    </div>
</template>

<script>
export default{
    props: {
        icon: {
            type: String,
            required: true,
        },
        carInfo: {
            type: String,
            required: true,
        },
        carInfoData: {
            type: String,
            required: true,
        },
    },
}
</script>
