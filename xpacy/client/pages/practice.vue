<template>
  <div class="flex-container">
    <Navbar/>
    <div style="flex-grow:1; background-color: red"/>
    <div style="flex-grow:1; background-color: green"/>
    <div style="flex-grow:1; background-color: blue"/>
  </div>
</template>


<script>
import Navbar from '~/components/Navbar'
export default {
  components: {
    Navbar
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
  background-color: aqua;
  flex-direction: column;
  height:100%;
  width:100%;
  position: absolute;
}
.mini-map {
  width: 100%;
  height: 600px !important;
}
</style>