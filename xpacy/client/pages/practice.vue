<template>
  <div class="flex-container">
    <Navbar/>
    <div class="gallery-container">
      <Gallery ref="food" class="gallery" :photos="photos"/>
    </div>
    <div class="gallery-container">
      <Gallery class="gallery"/>
    </div>
    <div class="gallery-container">
      <Gallery class="gallery"/>
    </div>
    <!-- <Map/> -->
    <BottomBar class="bottom-bar-container"/>
  </div>
</template>


<script>
import Navbar from '~/components/Navbar'
import Gallery from './motion/Gallery'
import BottomBar from '../components/BottomBar'
import axios from 'axios'

axios.defaults.baseURL = process.env.apiUrl

export default {
  components: {
    Gallery,
    Navbar,
    BottomBar
  },
  data: () => ({
    position: [55.607741796855734, 13.018133640289308],
    draggable: true,
    popupContent: 'Sentian HQ',
    photosArr: []
  }),
  computed:{
    photos: function () {
      return this.photosArr 
    }
  },
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
        
      ]
    axios.get('/foods')
    .then((res) => {
      self.data = res
      let apiArr = res.data.map((data)=>{
        let src = data.image_url
        // var img = new Image();
        console.log(src)
        // img.src = src
        return {
          ...data,
          src: src,
          width: 540,
          height: 350,
        }
      })
      console.log('original',self.photosArr)

      console.log('new',apiArr)
      this.$refs.food.handleResize()
      this.$refs.food.sizesNormalized
      self.photosArr = apiArr 
      // this.photosArr.concat(apiArr)
      // for(let i = 0; i<apiArr.length() ;i++){
      //   this.$set(this.photosArr, 0, apiArr[0])
      // }
      // this.$set(this.photosArr, 1, apiArr[1])
      // this.$set(this.photosArr, 2, apiArr[2])
      // this.$set(this.photosArr, 3, apiArr[3])
      // this.$set(this.photosArr, 4, apiArr[4])
      // this.$set(this.photosArr, 5, apiArr[5])
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
    overflow: hidden;
}

body {
    height: 100%;
    margin: 0;
}

.flex-container {
  display: -webkit-box;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  flex-direction: column;
  width:100%;
  height:100%;
  position: absolute;
}

.gallery-container {
  flex-grow:1; 
  transition-property: flex-grow,background-color;
  transition-duration: 0.5s;
  background-color: black;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.gallery-container:hover {
  background-color: white;
  flex-grow:5; 
}
.gallery-inactive {
  position: absolute;
  transition-property: opacity;
  transition-duration: 0.5s;
  opacity: 1;
  text-align: center;
  font-size:80px;
  color:white;
  padding: 200px;
  left:0px;right: 0px;
  background-image: url(https://github.com/posva/vue-motion/raw/master/docs/static/cat1.jpg);
  filter:grayscale(90%);
  z-index: 1; 
  background-size: cover;
  background-position: center center;
}

.gallery-inactive:hover {
  opacity: 0;
}

.gallery {
  transition-property: filter;
  transition-duration: 0.8s;
  filter:grayscale(90%);
  z-index: 0; 
}

.gallery:hover {
  filter:grayscale(0%)
}

.bottom-bar-container {
  flex-grow:1; 
  transition-property: flex-grow;
  transition-duration: 0.5s;
  background-color: black;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
</style>