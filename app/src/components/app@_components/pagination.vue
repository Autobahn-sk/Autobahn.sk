<template>
    <div class="flex gap-6 justify-center items-center text-center">
        <button 
            @click="changePage(currentPage - 1)" 
            :disabled="currentPage === 1"
            class="flex justify-center border border-[#E1E1E1] rounded-full px-6 py-3.5 bg-[#F9FBFC] hover:bg-[#E3E3E3] rotate-180"
        >
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_207_2431)">
                    <path d="M8.95002 6.66941L4.19626 11.4271C4.04886 11.5747 3.87074 11.6484 3.66192 11.6484C3.4531 11.6484 3.26885 11.5747 3.10916 11.4271C2.94947 11.2796 2.86963 11.0952 2.86963 10.8739C2.86963 10.6526 2.95561 10.4682 3.12758 10.3207L7.32858 6.11619L3.12758 1.91168C2.95561 1.76415 2.86963 1.57975 2.86963 1.35846C2.86963 1.13717 2.94947 0.952759 3.10916 0.805232C3.26885 0.657705 3.4531 0.583942 3.66192 0.583942C3.87074 0.583942 4.04886 0.657705 4.19626 0.805232L8.95002 5.56296C9.12199 5.71049 9.20797 5.8949 9.20797 6.11619C9.20797 6.33748 9.12199 6.52189 8.95002 6.66941Z" fill="#050B20"/>
                </g>
                <defs>
                    <clipPath id="clip0_207_2431">
                        <rect width="11.0276" height="11.0645" fill="white" transform="matrix(1 0 0 -1 0.506836 11.6484)"/>
                    </clipPath>
                </defs>
            </svg>
        </button>

        <div class="flex gap-3 justify-center items-center">
            <button 
                v-for="page in visiblePages" 
                :key="page"
                :class="{'active': currentPage === page, 'text-black': currentPage !== page}"
                @click="changePage(page)"
                class="cursor-pointer py-2 px-3 rounded-full"
            >
                {{ page }}
            </button>
        </div>

        <button 
            @click="changePage(currentPage + 1)" 
            :disabled="currentPage === totalPages"
            class="flex justify-center border border-[#E1E1E1] rounded-full px-6 py-3.5 bg-[#F9FBFC] hover:bg-[#E3E3E3]"
        >
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_207_2431)">
                    <path d="M8.95002 6.66941L4.19626 11.4271C4.04886 11.5747 3.87074 11.6484 3.66192 11.6484C3.4531 11.6484 3.26885 11.5747 3.10916 11.4271C2.94947 11.2796 2.86963 11.0952 2.86963 10.8739C2.86963 10.6526 2.95561 10.4682 3.12758 10.3207L7.32858 6.11619L3.12758 1.91168C2.95561 1.76415 2.86963 1.57975 2.86963 1.35846C2.86963 1.13717 2.94947 0.952759 3.10916 0.805232C3.26885 0.657705 3.4531 0.583942 3.66192 0.583942C3.87074 0.583942 4.04886 0.657705 4.19626 0.805232L8.95002 5.56296C9.12199 5.71049 9.20797 5.8949 9.20797 6.11619C9.20797 6.33748 9.12199 6.52189 8.95002 6.66941Z" fill="#050B20"/>
                </g>
                <defs>
                    <clipPath id="clip0_207_2431">
                        <rect width="11.0276" height="11.0645" fill="white" transform="matrix(1 0 0 -1 0.506836 11.6484)"/>
                    </clipPath>
                </defs>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        currentPage: {
            type: Number,
            required: true
        },
        totalPages: {
            type: Number,
            required: true
        }
    },
    computed: {
        visiblePages() {
            const pageRange = 2;
            let pages = [];

            for (let i = Math.max(1, this.currentPage - pageRange); i <= Math.min(this.totalPages, this.currentPage + pageRange); i++) {
                pages.push(i);
            }

            if (this.currentPage - pageRange > 1) {
                pages.unshift('...');
            }

            if (this.currentPage + pageRange < this.totalPages) {
                pages.push('...');
            }

            return pages;
        }
    },
    methods: {
        changePage(page) {
            if (page === '...') return;
            this.$emit('change-page', page);
        }
    }
};
</script>

<style scoped>
.active {
    background-color: #050B20;
    color: white;
    border-radius: 50%;
    padding-right: 15px;
    padding-left: 15px;
}
</style>