<template>
  <div>
    <div >
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t('register') }}
        </router-link>
    </div>

    <div class="text-center">
        <img src="~/static/map.png" class="img-responsive rounded-circle" alt="map" width="460" height="345">
      <div class="title">
        Expatso
      </div>
      <div>
        <span class="subtitle m-4">
          Tokyo
        </span>
        <span class="subtitle m-4">
          $500
        </span>
        <span class="subtitle m-4">
          Month
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'simple',

  head () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: process.env.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.subtitle {
  font-size: 45px;
}
</style>
