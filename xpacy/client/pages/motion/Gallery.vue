<template>
  <div>
    <div class="controls">
      <button type="button" class="btn btn-outline-light" @click="previous">Previous</button>
      <!-- <input v-model="current" type="range" min="0" :max="photos.length - 1"/> -->
      <button type="button" class="btn btn-outline-light" @click="next">Next</button>
    </div>
    <div class="demo">
      <Motion :values="sizesNormalized"
        tag="div"
        class="demo-inner"
      >
        <template scope="resizes">
          <PhotosContainer
              class="container"
              :sizes="sizes"
              :current="current"
              :style="{ width: `100%`, left:`${width/2 - resizes.layout.width/2}px`, height: `${resizes.layout.height}px` }"
          >
            <template scope="pcProps">
                              <div class="gradient"/>
              <div class="photos"
                   :style="{ left: `${pcProps.left}px` }"
              >
                <img v-for="(photo, i) in photos"
                     :key="i"
                     class="photo"
                     :style="{
                        width: `${resizes.pictures[i].width}px`, 
                        height: `${resizes.pictures[i].height}px`,
                        filter: `grayscale(${current==i?10:50}%)`
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

const base = 'https://github.com/posva/vue-motion/raw/master/docs/static/'

export default {

  components: { Motion, PhotosContainer },
  data () {
    return {
      current: 1,
      width: this.width,
    }
  },

  computed: {
    sizes () {
      const current = this.photos[this.current]
      return this.photos.map(photo => ({
        width: photo.width * (current.height / photo.height),
        height: current.height,
      }))
    },
    sizesNormalized () {
      return this.sizes.reduce((res, size, i) => {
        res.pictures[i] = size
        return res
      }, {
        layout: {
          width: this.photos[this.current].width,
          height: this.photos[this.current].height,
        },
        pictures: [],
      })
    },
    photos () {
      return [
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
    leftSpace (sizes) {
      const lefts = Array(this.photos.length)

      let cumulated = 0
      for (let i = this.current; i < this.photos.length; ++i) {
        lefts[i] = cumulated
        cumulated += sizes[`w${i}`]
      }

      if (this.current > 0) {
        cumulated = 0
        for (let i = this.current - 1; i >= 0; --i) {
          cumulated -= sizes[`w${i}`]
          lefts[i] = cumulated
        }
      }
      return lefts
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
  right:0;
  top:0;bottom: 0;
  width:50%;
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
  display: flex;
  padding: 30px;
  width:80%;
  background-color:dimgrey;
}

.controls button {
  flex: 1;
}
.controls input {
  flex: 3;
}
</style>
