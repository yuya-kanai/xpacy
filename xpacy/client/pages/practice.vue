<template>
  <div class="flex-container">
    <Navbar/>
    <div style="flex-grow:1; background-color: white;">
      <Gallery/>
    </div>
    <div style="flex-grow:1; background-color: white; ">
      <Gallery/>
    </div>
    <div style="flex-grow:1; background-color: white">
      <Gallery/>
    </div>
    <Map/>
  </div>
</template>


<script>
import Navbar from '~/components/Navbar'
import Map from '~/components/Map'
import Gallery from './motion/Gallery'
export default {
  components: {
    Gallery,
    Navbar,
    Map
  },
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
html {
    height: 100%;
}

body {
    height: 100%;
    margin: 0;
}

.flex-container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  flex-direction: column;
  width:100%;
  position: absolute;
}
</style>