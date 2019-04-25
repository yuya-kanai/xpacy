import Cookies from 'js-cookie'

// State
export const state = () => ({
  locale  : process.env.appLocale,
  locales : {
    en      : 'EN',
    'zh-CN' : '中文',
    es      : 'ES'
  }
})

// Getters
export const getters = {
  locale  : state => state.locale,
  locales : state => state.locales
}

// Mutations
export const mutations = {
  SET_LOCALE(state, {locale}) {
    state.locale = locale
  }
}

// Actions
export const actions = {
  setLocale({commit}, {locale}) {
    commit('SET_LOCALE', {locale})

    Cookies.set('locale', locale, {expires : 365})
  }
}
