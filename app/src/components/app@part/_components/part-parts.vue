<template>
    <div>
        <div class="mb-10 flex justify-center flex-wrap md:flex-nowrap grid-rows-2">
            <div>
                <Categories 
                    :data="data" 
                    @update-category="updateSelectedCategory" 
                />
            </div>
            <div class="flex flex-wrap gap-3 justify-center ml-0 md:ml-5 md:justify-start items-center w-5/6 mt-6 md:mt-0">
                <div class="mr-4 ml-4 mt-2 w-full flex-row">
                    <Filters />
                </div>
                <PartCard
                    class="mt-3"
                    v-for="(item) in filteredData"
                    :key="item.id"
                    :item="item"
                />
                <Pagination />
            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import PartsData from "@/assets/mocks/part-cards.json";
import PartCard from "./part-card.vue";
import Footer from "@/components/app/_layout/_components/footer.vue";
import Categories from "./part-categories.vue";
import Filters from "./part-filters.vue";
import Pagination from "@/components/app@_components/pagination.vue";

export default defineComponent({
    components: {
        PartCard,
        Categories,
        Filters,
        Pagination,
        Footer
    },
    data() {
        return {
            data: PartsData,
            selectedCategory: null
        };
    },
    computed: {
        filteredData() {
            if (!this.selectedCategory) {
                return this.data;
            }
            if (!this.selectedCategory === 0) {
                return this.data;
            }
            else {
                return this.data.filter(item => item.tag === this.selectedCategory);
            }
        }
    },
    methods: {
        updateSelectedCategory(category) {
            this.selectedCategory = category;
        }
    }
});
</script>
