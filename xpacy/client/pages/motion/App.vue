<template>
  <div class="landing">

          <Gallery class="landing__content"/>

  </div>
</template>

<script>
import Gallery from './Gallery'

export default {

  components: { Gallery },
  data () {
    return {
      currentTab: -1,
    }
  },

  computed: {
  },

  mounted () {
    this.currentTab = 1
    document.body.style.backgroundColor = 'ghostwhite'
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Lato');

* {
  box-sizing: border-box;
  font-family: 'Lato', 'helvetica neue', sans-serif;
}

.landing {
  background-color: ghostwhite;
  padding: 20px;
  overflow-x: hidden;
}

.landing__title {
  font-size: 48px;
  margin: 1rem 0;
  text-align: center;
}

.landing__subtitle {
  font-size: 1.1rem;
  text-align: center;
  color: gray;
}

.landing__main {
  position: relative;
  width: 100%;
  height: 656px;
}

.landing__content {
  position: absolute;
  background-color: white;
  left: 0;
  right: 0;
  width: 100%;
  border: 1px solid #e5e5e5;
  padding: 1rem;
  border-radius: .5rem;
  display: inline-block;
}

.landing__docs-link {
  text-align: center;
  margin-bottom: .7rem;
}
</style>
