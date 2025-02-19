<template>
    <div class="mt-6 md:w-2/3">
        <h2 class="text-2xl font-medium">História vývoju cien </h2>
        <div class="mt-4 flex items-center">
            <p class="text-[#767676]">Kúpou auta dnes, ušetríte</p>
            <div class="ml-4 border drop-shadow-sm py-1 pr-4 pl-4 rounded-lg">
                <h6 class="text-purple font-bold text-lg">$1250</h6>
            </div>
        </div>
        <v-chart class="w-full h-[350px]" :option="chartOptions" autoresize />
        <div>
            <p class="text-[#767676]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus accumsan dignissim pulvinar. Aenean nec tempor nulla. Quisque condimentum vel nisi lacinia dignissim. Quisque semper massa at mi hendrerit vulputate et sed ligula. Donec eget commodo enim. In porttitor pellentesque risus. Sed pretium sed nisi sit amet posuere.</p>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { LineChart } from "echarts/charts";
import { GridComponent, TooltipComponent } from "echarts/components";
import VChart from "vue-echarts";
import adsData from "@/assets/mocks/ad-cards.json";

use([CanvasRenderer, LineChart, GridComponent, TooltipComponent]);

export default defineComponent({
    components: { VChart },
    setup() {
        const car = adsData[0];
        const chartData = car?.chart || [];

        const chartOptions = ref({
        xAxis: { type: "category", data: chartData.map((p) => p.year) },
        yAxis: { type: "value" },
        tooltip: { trigger: "axis" },
        series: [
            {
            data: chartData.map((p) => p.price),
            type: "line",
            areaStyle: { color: "rgba(99, 102, 241, 0.2)" },
            lineStyle: { color: "#6366F1" },
            symbol: "circle",
            symbolSize: 8,
            },
        ],
    });

    return { chartOptions };
    },
});
</script>