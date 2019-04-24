<template>
  <div>
    <b-button variant="danger" @click="logPosition" >Log position</b-button>
    <no-ssr>
      <l-map class="mini-map" :zoom=13 :center="position">
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="position" :draggable="draggable">
          <l-popup :content="popupContent"></l-popup>
        </l-marker>
      </l-map>
    </no-ssr>
  </div>
</template>

<script>
export default {
  data: () => ({
    position: [55.607741796855734, 13.018133640289308],
    draggable: true,
    popupContent: 'Sentian HQ'
  }),
  methods: {
    logPosition() {
      console.log(this.position);
    }
  }
};
</script>

<style src="leaflet/dist/leaflet.css">
</style>
<style >
.mini-map {
  width: 100%;
  height: 600px !important;
}
</style>