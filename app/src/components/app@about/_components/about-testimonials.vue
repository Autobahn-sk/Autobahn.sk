<template>
    <div class="full-width-screen bg-[#F9FBFC]">
        <div class="large-site-lauyout flex-col justify-center items-center pt-[96px] pb-[96px]">
            <h3 class="subtitle-32 text-center md:text-left">Čo hovoria naši zákazníci</h3>
            <div class="mt-[44px] flex justify-center items-center flex-row gap-6 flex-wrap md:flex-nowrap">
                <div class="bg-white w-[363px] h-auto pt-6 pb-6 pr-6 pl-6 rounded-2xl" v-for="(testimonial, index) in testimonialsData" :key="index"> 
                    <div class="flex justify-between w-full">
                        <h3 class="text-lg font-medium">{{testimonial.text}}</h3>
                        <svg width="36" height="25" viewBox="0 0 31 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.55106 21.8923C5.65195 21.8923 3.94275 21.1327 2.42346 19.6133C0.904176 18.0398 0.144531 15.7337 0.144531 12.6952C0.144531 9.22248 1.06695 6.40097 2.91181 4.23056C4.81091 2.00589 7.49679 0.893555 10.9695 0.893555C12.2174 0.893555 13.1941 0.974943 13.8995 1.13772V4.88168C13.1399 4.77316 12.1632 4.7189 10.9695 4.7189C9.12458 4.7189 7.63245 5.34289 6.49298 6.59088C5.40778 7.67609 4.78378 9.11398 4.621 10.9046C5.32639 10.0364 6.46586 9.60233 8.0394 9.60233C9.66721 9.60233 11.0508 10.1721 12.1903 11.3115C13.3298 12.3967 13.8995 13.8346 13.8995 15.6252C13.8995 17.4701 13.3027 18.9893 12.1089 20.1831C10.9152 21.3225 9.39593 21.8923 7.55106 21.8923ZM23.7477 21.8923C21.8487 21.8923 20.1395 21.1327 18.6202 19.6133C17.1008 18.0398 16.3412 15.7337 16.3412 12.6952C16.3412 9.22248 17.2636 6.40097 19.1085 4.23056C21.0076 2.00589 23.6935 0.893555 27.1661 0.893555C28.4141 0.893555 29.3908 0.974943 30.0962 1.13772V4.88168C29.3366 4.77316 28.3599 4.7189 27.1661 4.7189C25.3213 4.7189 23.8291 5.34289 22.6897 6.59088C21.6045 7.67609 20.9805 9.11398 20.8177 10.9046C21.5231 10.0364 22.6626 9.60233 24.2361 9.60233C25.8639 9.60233 27.2475 10.1721 28.387 11.3115C29.5265 12.3967 30.0962 13.8346 30.0962 15.6252C30.0962 17.4701 29.4994 18.9893 28.3056 20.1831C27.1119 21.3225 25.5926 21.8923 23.7477 21.8923Z" fill="#050B20"/>
                        </svg>
                    </div>
                    <div class="mt-4">   
                        <p>„{{testimonial.description}}“</p>
                    </div>
                    <div class="mt-8 flex">
                        <img class="rounded-full" :src="testimonial.image" alt="">
                        <div class="flex-col ml-4">
                            <h5 class="font-medium">{{testimonial.name}}</h5>
                            <p class="text-gray-400">{{testimonial.position}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-col gap-6">
                <button class="flex justify-center w-[60px] h-[40px] bg-white border-2 border-yellow-800 rounded-[30px] hover:bg-[#35394A]">
                    <svg class="mt-3" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_53_3380)">
                        <path d="M2.56006 6C2.56006 5.76 2.65339 5.56 2.84006 5.4L8.00006 0.240001C8.16006 0.0799999 8.35339 0 8.58006 0C8.80673 0 9.00673 0.0799999 9.18006 0.240001C9.35339 0.400001 9.44006 0.6 9.44006 0.84C9.44006 1.08 9.34672 1.28 9.16006 1.44L4.60006 6L9.16006 10.56C9.32006 10.72 9.40006 10.92 9.40006 11.16C9.40006 11.4 9.32006 11.6 9.16006 11.76C9.00006 11.92 8.80673 12 8.58006 12C8.35339 12 8.16006 11.92 8.00006 11.76L2.84006 6.6C2.65339 6.44 2.56006 6.24 2.56006 6Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_53_3380">
                        <rect width="12" height="12" fill="white" transform="matrix(1 0 0 -1 0 12)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </button>
                <button class="flex justify-center w-[60px] h-[40px] border-2 border-white rounded-[30px] hover:bg-[#35394A]">
                    <svg class="mt-3" width="12" height="12" transform="rotate(180)" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_53_3380)">
                        <path d="M2.56006 6C2.56006 5.76 2.65339 5.56 2.84006 5.4L8.00006 0.240001C8.16006 0.0799999 8.35339 0 8.58006 0C8.80673 0 9.00673 0.0799999 9.18006 0.240001C9.35339 0.400001 9.44006 0.6 9.44006 0.84C9.44006 1.08 9.34672 1.28 9.16006 1.44L4.60006 6L9.16006 10.56C9.32006 10.72 9.40006 10.92 9.40006 11.16C9.40006 11.4 9.32006 11.6 9.16006 11.76C9.00006 11.92 8.80673 12 8.58006 12C8.35339 12 8.16006 11.92 8.00006 11.76L2.84006 6.6C2.65339 6.44 2.56006 6.24 2.56006 6Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_53_3380">
                        <rect width="12" height="12" fill="white" transform="matrix(1 0 0 -1 0 12)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Leslie from "@/components/app@about/_img/leslie.png";
import Jenny from "@/components/app@about/_img/jenny.png";
import Courtney from "@/components/app@about/_img/courtney.png";    

export default {
    data() {
        return {
            testimonialsData: [
                {
                    text: "Skvelá práca",
                    description: "Úžasný dizajn, jednoduché prispôsobenie a dizajn kvalitný superlatívny účet na svojej cloudovej platforme pre optimalizovaný výkon. A to sme nemali na našich pôvodných návrhoch.",
                    name: "Leslie Alexander",
                    position: "Facebook",
                    image: Leslie,
                },
                {
                    text: "Úžasný dizajn",
                    description: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et. ",
                    name: "Jenny Wilson",
                    position: "UI/UX Designer",
                    image: Jenny,
                },
                {
                    text: "Dokonalá kvalita",
                    description: "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati.",
                    name: "Courtney Henry",
                    position: "Software Developer",
                    image: Courtney,
                },
            ]
        }
    }
}

</script>

<style scoped>

.large-site-lauyout{
    max-width: 1250px!important;
}

</style>