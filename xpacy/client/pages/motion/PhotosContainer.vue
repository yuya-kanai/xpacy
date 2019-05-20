<template>
  <Motion tag="div"
          :value="left"
  >
    <template scope="props">
      <slot :left="props.value"></slot>
    </template>
  </Motion>
</template>

<script>
import { Motion } from 'vue-motion'

export default {

  components: { Motion },
  props: ['sizes', 'current'],

  computed: {
    left () {
      let cumulated = 0
      for (let i = 0; i < this.current; ++i) {
        cumulated += this.sizes[i].width
      }
      return -cumulated
    },
  },
}
</script>
