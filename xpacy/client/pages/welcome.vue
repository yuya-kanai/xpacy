<template>
  <div>
    <div >
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'map' }">
          {{ $t('map') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t("register") }}
        </router-link>
        <button @click="getCountries">Country</button>
    </div>

    <div class="text-center">
        <img src="~/static/map.png" class="img-responsive rounded-circle" alt="map" width="460" height="345">
      <div class="title">
        Xpacy
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
import axios from 'axios'

export default {
  layout: 'simple',

  head () {
    return { title: this.$t('home') }
  },

  data: () => (
  {
    title: process.env.appName,
    URL_BASE : process.env.apiUrl
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
  methods: {
    getCountries () {
      // Submit the form via a POST request
      //let URL_BASE = process.env.APP_URL
      console.log(this.URL_BASE + '/country')
      axios.get(this.URL_BASE + '/country')
      .then((res) => {
        console.log(res) 
      })
      //this.form.get('/country')
      //  .then(({ data }) => { console.log(data) })
    }
  } 
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
