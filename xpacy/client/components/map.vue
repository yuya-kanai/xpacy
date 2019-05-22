<template>
  <span>
    <!-- <b-button variant="danger" @click="logPosition" >Log position</b-button> -->
    <no-ssr>
      <l-map ref="map" class="mini-map" :style="miniMap" :zoom=13 :center="position">
        <l-tile-layer url="http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="position">
        </l-marker>
      </l-map>
    </no-ssr>
  </span>
</template>

<script>
let L
if (process.client) {
  L = require('leaflet')
  delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});
}


export default {
  props: {
    width: {
      type: Number,
      required: true
    },
    height: {
      type: Number,
      required: true
    },
    position: {
      type: Array,
      default: ()=> {
         return [35.6762, 139.6503]
      }
    }
  },
  data: () => ({
    draggable: false,
    popupContent: 'Sentian HQ'
  }),
  computed: {
    miniMap () {
      if(typeof this.$refs !== 'undefined'){
        if(typeof this.$refs.map !== 'undefined'){
          this.$refs.map.mapObject.panTo(this.position)
        }
      }
      return `width:${this.width}px !important; height:${this.height}px !important;`
    },
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
    position: absolute !important;
}
</style>