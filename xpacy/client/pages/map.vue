<template>
  <div>
    <!-- <b-button variant="danger" @click="logPosition" >Log position</b-button> -->
    <no-ssr>
      <l-map class="mini-map" :zoom=23 :center="position">
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
  props: {
    position: {
      type:Array,
      default:()=>{return [
        53.607741796855734, 12.018133640289308
      ]}
    }
  },
  data: () => ({
    draggable: true,
    popupContent: 'Sentian HQ'
  }),
  mounted:()=>  {
      console.log('nya',this.position);

    this.logPosition()
  },
  methods: {
    logPosition() {
      console.log('nya',this.position);
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