<template>
  <div
    @mouseover="hover = true"
    @mouseleave="hover = false"
  >
    <div class="controls">
      <!-- <button type="button" class="btn btn-light" @click="previous">Previous</button> -->
      <input v-model="current" class="slider" type="range" min="0" :max="photos.length - 1"/>
      <!-- <button type="button" class="btn btn-light" @click="next">Next</button> -->
    </div>
    <div class="demo">
      <Motion ref="motionDiv"
        :values="sizesNormalized"
        tag="div"
        class="demo-inner"
      >
        <template scope="resizes">
          <Map 
            :width="width/2 - resizes.layout.width/2"
            :height="resizes.pictures[current].height"
            :position="positionCurrent"
            style="{ width:`0px`;  margin-right: `20px`;}"
          />
          <PhotosContainer
              class="container"
              :sizes="sizes"
              :current="current"
              :style="{ width: `100%`, left:`${width/2 - resizes.layout.width/2}px`, height: `${resizes.layout.height}px` }"
          >
            <template scope="pcProps">
      <Motion ref="motionDiv"
        :value="priceCurrent"
        tag="div"
        >
              <div  slot-scope="props" class="gradient">
                ${{Math.floor(props.value)}}
                </div>
                </Motion>
              <div class="photos"
                   :style="{ left: `${pcProps.left}px` }"
              >
                <img v-for="(photo, i) in photos"
                     :key="i"
                     class="photo"
                     :style="{
                        width: `${resizes.pictures[i]?resizes.pictures[i].width:200}px`, 
                        height: `${resizes.pictures[i]?resizes.pictures[i].height:200}px`,
                        filter: `grayscale(${current==i?10:70}%)`
                      }"
                     :src="photo.src"
                     @touchstart="next"/>
              </div>
            </template>
          </PhotosContainer>
        </template>
      </Motion>
    </div>
  </div>
</template>

<script>
import { Motion } from 'vue-motion'
import PhotosContainer from './PhotosContainer'
import Map from '~/components/Map'

// const base = 'https://github.com/posva/vue-motion/raw/master/docs/static/'

export default {

  components: { Motion, PhotosContainer, Map },
  props: {
    photos: {
      type:Array,
      default:function(){return [
        {
          price: 20,
          position: [18.99159,98.99159],
          width: 500,
          height: 300,
          src: '0.png',
        },
        {
          price: 34,
          position: [18.99159,93.90159,],
          width: 500,
          height: 390,
          src: '1.png',
        },
        {
          price: 41,
          position: [18.39159,99.99159,],
          longitude: 98.99159,
          latitude: 16.99159,
          width: 500,
          height: 330,
          src: '3.png',
        },
        {
          price: 44,
          position: [18.29159,98.99159],
          longitude: 98.99159,
          latitude: 17.99159,
          width: 491,
          height: 301,
          src: '4.png',
        },
        {
          price: 65,
          position: [18.99159,98.99159],
          longitude: 98.99159,
          latitude: 14.99159,
          width: 447,
          height: 500,
          src: '5.png',
        },
        {
          price: 134,
          position: [18.99159,98.99159],
          longitude: 98.99159,
          latitude: 19.99159,
          width: 320,
          height: 204,
          src: '6.png',
        },
      ]}
    }
  },
  data () {
    return {
      current: 1,
      width: this.width,
      hover: false,
    }
  },
  computed: {
    priceCurrent () {
      const current = this.photos[this.current]
      return current.price
    },
    positionCurrent () {
      const current = this.photos[this.current]
      return current.position
    },
    sizes () {
      const current = this.photos[this.current]
      return this.photos.map(photo => ({
        width: photo.width * (current.height / photo.height),
        height: current.height,
      }))
    },
    sizesNormalized () {
      let normalized = this.sizes.reduce((res, size) => {
        res.pictures.push(size)
        return res
      }, {
        layout: {
          width: this.photos[this.current].width,
          height: this.photos[this.current].height
        },
        pictures: [],
      })
      return normalized
    },
  },
  mounted: function () {
      this.handleResize()
      window.addEventListener('resize', this.handleResize)
  },
  beforeDestroy: function () {
    window.removeEventListener('resize', this.handleResize)
  },

  methods: {
    mouseLeft () {
    },
    next () {
      if (++this.current >= this.photos.length) {
        this.current = 0
      }
    },
    previous () {
      if (--this.current < 0) {
        this.current = this.photos.length - 1
      }
    },
    handleResize: function() {
      this.width = window.innerWidth;
    },
  }
}
</script>

<style scoped>
.demo {
  display: flex;
  align-items: center;
}

.btn {
  margin: 20px;
}
.gradient {
  position: absolute;
  font-size: 200px;
  justify-content: center;
  color:white;
  right:0;
  top:0;bottom: 0;
  width:70%;
  background-image: linear-gradient(to right,transparent, black,black);
  z-index: 1;
}

.demo-inner {
  width: 100%;
}

.container {
  position: relative;
  overflow: hidden;
  margin: auto;
  max-width: 100%;
}

.photos {
  position: absolute;
  white-space: nowrap;
}

.controls {
  float:right;
  right:0;
  bottom:0;
  position:absolute;
  z-index: 3004;
  display: flex;
  padding: 40px;
  width:30%;
  /* background-image: linear-gradient(to right, transparent, rgba(20,65,132,0.8)); */
  mix-blend-mode: hard-light;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 10px;
  border-radius: 5px;   
  background: #d3d3d3;
  outline: none;
  opacity: 0.9;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 30px;
  height: 30px;
  border-radius: 50%; 
  opacity: 1;
  background: rgb(84, 175, 76);
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgb(84, 175, 101);
  cursor: pointer;
}

.controls button {
  flex: 1;
}

.controls input {
  flex: 3;
}
</style>

