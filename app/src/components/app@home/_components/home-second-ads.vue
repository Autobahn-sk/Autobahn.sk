<template>
    <div class="bg-black full-width-screen w-screen">
      <div class="ad-site-layout md:pt-32 pt-20">
        <h2 class="subtitle subtitle-40 font-bold text-white">
          <strong>Obľúbené značky</strong>
        </h2>
        <div class="mt-12">
            <div class="inline-flex flex justify-between w-full">
                <div class="select-bar-white flex gap-9 text-white">
                    <a class="active">BMW</a>
                    <a>Audi</a>
                    <a>Ford</a>
                    <a>Mercedes Benz</a>
                </div>
                <div class="flex inline-flex display-none md:display-block">
                    <a href="" class="text-white mr-2">Zobraziť všetky</a>
                    <svg class="mt-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.2511 0.149414H5.19056C4.98804 0.149414 4.82416 0.313293 4.82416 0.515814C4.82416 0.718336 4.98804 0.882215 5.19056 0.882215H12.3666L0.534839 12.714C0.391707 12.8571 0.391707 13.089 0.534839 13.2321C0.606388 13.3036 0.700161 13.3394 0.793899 13.3394C0.887638 13.3394 0.981376 13.3036 1.05296 13.2321L12.8847 1.4003V8.57638C12.8847 8.77891 13.0486 8.94278 13.2511 8.94278C13.4537 8.94278 13.6175 8.77891 13.6175 8.57638V0.515814C13.6175 0.313293 13.4536 0.149414 13.2511 0.149414Z" fill="white"/>
                    </svg>
                </div>
            </div>
            <hr class="mt-3 bg-light-black border-none h-[0.06rem]" />
        </div>
        <div class="mt-12">
          <Ad />
        </div>
        <div class="add-cards-buttons my-20 flex inline-flex gap-6">
            <button class="flex justify-center">
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
            <button class="flex justify-center">
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
import { defineComponent } from 'vue';
import Ad from '@/components/app@_components/ad-card-black.vue';

export default defineComponent({
components: {
    Ad
},
mounted() {
    const links = document.querySelectorAll('.select-bar-white a');

    links.forEach(function (link) {
        link.addEventListener('click', function () {
        links.forEach(function (l) {
            l.classList.remove('active');
        });
        link.classList.add('active');
      });
     });
    }
});
</script>
  
<style scoped>
  
.ad-site-layout {
  max-width: 1200px; 
  margin: 0 auto; 
}

.select-bar-white a:hover {
  cursor: pointer;
  color: #E9E9E9;
}

.select-bar-white a.active {
  text-decoration-line: underline;
  text-decoration-color: white;
  text-underline-offset: 17px;
  text-decoration-thickness: 3px;
}

.add-cards-buttons  button {
  border: solid 2px #ffff;
  border-radius: 30px;
  width: 60px;
  height: 40px;
}

.add-cards-buttons  button:focus {
  background-color: #35394A;
}

@media screen and (max-width: 1270px) {
      .ad-site-layout {
        margin-left: 31px;
        margin-right: 31px;
      }

      .select-bar-white {
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        position: relative;
      }

      .select-bar-whiter a {
        display: inline-block;
        position: relative;
      }

      .select-bar::-webkit-scrollbar {
        display: none;
      }
}

</style>