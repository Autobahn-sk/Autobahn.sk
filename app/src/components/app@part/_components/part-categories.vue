<template>
    <div class="border border-[#E9E9E9] w-auto md:w-[348px] rounded-xl p-5">
        <h2 class="font-bold text-lg">Kategórie</h2>
        <div>
            <div 
                class="inline-flex justify-between w-full mt-5" 
                v-for="category in categories" 
                :key="category.name">
                <p>{{ category.name }}</p>
                <a 
                    href="#" 
                    @click.prevent="filterCategory(category.name)">
                    ( {{ category.count }} )
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PartCategories",
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            categoriesList: [
                { name: "Doplnky" },
                { name: "Body Kit" },
                { name: "Exteriér" },
                { name: "Interiér" },
                { name: "Motor" },
                { name: "Oleje a Filtre" },
                { name: "Podvozok" },
                { name: "Výfuk" }
            ]
        };
    },
    computed: {
        categories() {
            const categoryCounts = this.data.reduce((acc, item) => {
                acc[item.tag] = (acc[item.tag] || 0) + 1;
                return acc;
            }, {});

            return this.categoriesList.map(category => ({
                name: category.name,
                count: categoryCounts[category.name] || 0
            }));
        }
    },
    methods: {
        filterCategory(category) {
            this.$emit("update-category", category);
        }
    }
};
</script>