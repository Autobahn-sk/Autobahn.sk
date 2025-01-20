<template>
    <div class="flex flex-col min-h-screen">
        <div class="flex justify-center flex-wrap md:flex-nowrap grid-rows-2 flex-grow">
            <div>
                <Categories 
                    :data="data" 
                    @update-category="updateSelectedCategory" 
                />
            </div>
            <div class="flex flex-wrap gap-3 justify-center ml-0 md:ml-5 md:justify-start items-center w-5/6 mt-6 mb-20 md:mt-0 flex-grow">
                <div class="flex-row mr-4 ml-4 mt-2 w-full">
                    <Filters />
                </div>
                <div class="flex flex-wrap gap-3 justify-center mt-3">
                    <PartCard
                        class="mt-3 flex-row"
                        v-for="(item) in paginatedData"
                        :key="item.id"
                        :item="item"
                    />
                </div>
                <div class="mt-20 mb-6 w-full flex justify-center">
                    <Pagination 
                        :currentPage="currentPage" 
                        :totalPages="totalPages" 
                        @change-page="changePage"
                    />
                </div>
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
            selectedCategory: null,
            currentPage: 1,
            itemsPerPage: 9
        };
    },
    computed: {
        filteredData() {
            if (!this.selectedCategory) {
                return this.data;
            }
            return this.data.filter(item => item.tag === this.selectedCategory);
        },
        paginatedData() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.filteredData.slice(startIndex, endIndex);
        },
        totalPages() {
            return Math.ceil(this.filteredData.length / this.itemsPerPage);
        }
    },
    methods: {
        updateSelectedCategory(category) {
            this.selectedCategory = category;
            this.currentPage = 1;
        },
        changePage(page) {
            this.currentPage = page;
        }
    }
});
</script>