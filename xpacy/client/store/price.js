
// State
export const state = () => ({
  restaurant_price  : 0,
  housing_price : 0,
  transport_price : 0,
})

// Getters
export const getters = {
  restaurant  : state => state.restaurant_price,
  housing : state => state.housing_price,
  transport : state => state.transport_price // !== null
}

// Mutations
export const mutations = {
  set_restaurant(state) {
    state.restaurant ++
  },
  set_housing(state, housing) {
    state.token = housing
  },
  set_transport(state, transport) {
    state.token = transport
  },
}

// Actions
export const actions = {
  set_restaurant_price({commit}) {
    commit('set_restaurant')
  }
}
