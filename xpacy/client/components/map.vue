<template>
  <span>
    <!-- <b-button variant="danger" @click="logPosition" >Log position</b-button> -->
    <no-ssr>
      <l-map class="mini-map" :style="miniMap" :zoom=13 :center="position">
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="position" :draggable="draggable">
          <l-popup :content="popupContent"></l-popup>
        </l-marker>
      </l-map>
    </no-ssr>
  </span>
</template>

<script>
export default {
  props: {
    width: {
      type: Number,
      required: true
    },
    height: {
      type: Number,
      required: true
    }
  },
  data: () => ({
    position: [55.607741796855734, 13.018133640289308],
    draggable: false,
    popupContent: 'Sentian HQ'
  }),
  computed: {
    miniMap () {
        console.log(this.width)
    return `width:${this.width}px !important; height:${this.height}px !important;`
    }
  },
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
    z-index: 0;
    position: absolute !important;
}
</style>