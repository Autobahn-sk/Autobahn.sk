<template>
    <div class="flex gap-4">
        <button class="w-[156px] h-[135px] hover:bg-gray-50 border border-solid border-[#E9E9E9] rounded-[12px] flex flex-col items-center justify-center">
            <img class="w-auto h-16 object-contain" :src="BrandImage" alt="BrandImage">
            <h5 class="text-base mt-2">{{ BrandName }}</h5>
        </button>
    </div>
</template>

<script>

export default {
    name: 'Brands',
    props: {
        BrandName: {
            type: String,
            required: true
        },
        BrandImage: {
            type: String,
            required: true
        }
    }
}

</script>