<template>
  <div class="flex-container">
    <Navbar/>
    <div style="flex-grow:1; background-color: white;">
      <Gallery :photos="photosArr"/>
    </div>
    <div style="flex-grow:1; background-color: white; ">
      <Gallery/>
    </div>
    <div style="flex-grow:1; background-color: white">
      <Gallery/>
    </div>
    <!-- <Map/> -->
  </div>
</template>


<script>
import Navbar from '~/components/Navbar'
// import Map from '~/components/Map'
import Gallery from './motion/Gallery'
import axios from 'axios'

axios.defaults.baseURL = process.env.apiUrl

export default {
  components: {
    Gallery,
    Navbar,
  },
  data: () => ({
    position: [55.607741796855734, 13.018133640289308],
    draggable: true,
    popupContent: 'Sentian HQ',
    photosArr:[]
  }),
  created(){
    const self = this
          const base = 'https://github.com/posva/vue-motion/raw/master/docs/static/'
          self.photosArr = [
        {
          width: 300,
          height: 450,
          src: `${base}cat1.jpg`,
        },
        {
          width: 500,
          height: 390,
          src: `${base}cat2.jpg`,
        },
        {
          width: 500,
          height: 330,
          src: `${base}cat3.jpg`,
        },
        {
          width: 491,
          height: 251,
          src: `${base}cat4.jpg`,
        },
        {
          width: 447,
          height: 500,
          src: `${base}cat5.jpg`,
        },
        {
          width: 320,
          height: 154,
          src: 'https://media.giphy.com/media/JEVqknUonZJWU/giphy.gif',
        },
      ]
    axios.get('/foods')
    .then((res) => {
      self.data = res
      let something = res.data.map((data)=>{
        let src = data.image_url
        var img = new Image();
        img.src = src
        console.log('bababa')
        return {
          src: src,
          width: 40,
          height: 50,
        }
      })
      console.log(res)
      console.log('asss',self.photosArr)

       console.log('hey',res.data.map((data)=>{
        let src = data.image_url
        var img = new Image();
        img.src = src
        console.log('bababa')
        return {
          src: src,
          width: 264,
          height: 330,
        }
      }))
      // this.photosArr = something
      this.$set(this.photosArr, 3, something[0])
      // console.log('asss',self.photosArr)
    })
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