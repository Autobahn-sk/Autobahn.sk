<template>
  <div class="mt-6 w-full md:w-2/3">
    <h2 class="text-2xl font-medium">Poloha</h2>
    <p class="mt-4 mb-4">Kopčianska 92, 851 01 Bratislava, Slovensko.</p>
    <a class="text-purple hover:text-[#1B3DDF]" href="">Navigovať</a>
    <div ref="mapContainer" class="ol-map mt-6"></div>
    <hr class="mt-8 border-[#E1E1E1]">
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import "ol/ol.css";
import Map from "ol/Map";
import View from "ol/View";
import TileLayer from "ol/layer/Tile";
import OSM from "ol/source/OSM";
import Feature from "ol/Feature";
import Point from "ol/geom/Point";
import Style from "ol/style/Style";
import Icon from "ol/style/Icon";
import VectorLayer from "ol/layer/Vector";
import VectorSource from "ol/source/Vector";
import { fromLonLat } from "ol/proj"; 
import markerIcon from "@/components/app@ad/_img/marker.png";
import jsonData from "@/assets/mocks/ad-cards.json"; 

export default {
  setup() {
    const mapContainer = ref(null);

    onMounted(() => {
      try {
        if (!jsonData.length || !jsonData[0].map) {
          throw new Error("Chýbajú súradnice v JSON");
        }

        const latitude = jsonData[0].map.latitude;
        const longitude = jsonData[0].map.longitude;

        const map = new Map({
          target: mapContainer.value,
          layers: [
            new TileLayer({
              source: new OSM(),
            }),
          ],
          view: new View({
            center: fromLonLat([longitude, latitude]),
            zoom: 13,
          }),
        });

        const marker = new Feature({
          geometry: new Point(fromLonLat([longitude, latitude])),
        });

        marker.setStyle(
          new Style({
            image: new Icon({
              anchor: [0.5, 1],
              src: markerIcon,
            }),
          })
        );

        const markerLayer = new VectorLayer({
          source: new VectorSource({
            features: [marker],
          }),
        });

        map.addLayer(markerLayer);
      } catch (error) {
        console.error("❌ Error", error);
      }
    });

    return { mapContainer };
  },
};
</script>

<style>
.ol-map {
  width: 100%;
  height: 400px;
  border-radius: 12px;
  overflow: hidden;
}

.ol-map canvas {
  border-radius: 12px;
}
</style>