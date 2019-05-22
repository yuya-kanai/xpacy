<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
    <div class="btn-group dropup">
      <button type="button" class="btn btn-secondary-outline btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Tokyo
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" @click="shout('tokyo')">Tokyo</a>
        <a class="dropdown-item" href="#">Singapore</a>
        <a class="dropdown-item" href="#">Chiang Mai</a>
      </div>
    </div>
    <div class="btn-group dropup">
      <button type="button" class="btn btn-secondary-outline btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Month
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Month</a>
        <a class="dropdown-item" href="#">Week</a>
        <a class="dropdown-item" href="#">Day</a>
      </div>
    </div>

      <button :aria-label="$t('toggle_navigation')" class="navbar-toggler" type="button"
              data-toggle="collapse" data-target="#navbarToggler"
              aria-controls="navbarToggler" aria-expanded="false"
      >
        <span class="navbar-toggler-icon"/>
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
        </ul>

        <h2 class="navbar-nav ml-auto">
          $250
        </h2>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  data: () => ({
    appName: process.env.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    shout(word){
      this.$store.dispatch('price/set_restaurant_price')
      this.$store.commit('price/set_restaurant')
      console.log(word)
      console.log(this.$store.state.price.restaurant_price)
      console.log(this.$store.getters['price/restaurant'])
      // store.commit('increment')
    },
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
