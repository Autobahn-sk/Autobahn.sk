<template>
    <div class="w-full flex justify-between">
        <p>Ukazuje {{shownResults}} z {{totalResults}} výsledkov</p>
        <div class="inline-flex">
            <p class="pr-2 text-[#818181]">Filtrovať:</p>
            <select name="select" id="select" class="cursor-pointer">
                <option value="Highest price">Podľa najdrahších</option>
                <option value="Lowest price">Podľa najlacnejších</option>
            </select>
        </div>
    </div>
</template>

<script>
import jsonData from '@/assets/mocks/part-cards.json';

export default {
    name: "PartFilters",
    data(){
        return {
            totalResults: 0,
            shownResults: 9
        }
    },
    created() {
        this.totalResults = jsonData.length;
    }
}

</script>