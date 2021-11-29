import { createStore } from 'vuex'

import axios from 'axios'

export default createStore({
  state: {
    user: null
  },
  mutations: {
    resetUser(state) {
      state.user = null
    },
    setUser(state, loggedInUser) {
      state.user = loggedInUser
    }
  },
  actions: {
    async login (context, credentials) { 
      try { 
        let response = await axios.post('login', credentials) 
        axios.defaults.headers.common.Authorization =  
                   "Bearer " + response.data.access_token 
        response = await axios.get('users/me') 
        context.commit('setUser', response.data.data) 
      } catch (error) { 
        delete axios.defaults.headers.common.Authorization 
        context.commit('resetUser', null) 
        throw error 
      } 
    }, 
    async logout (context) { 
      try { 
        await axios.post('logout') 
      } 
      finally { 
        delete axios.defaults.headers.common.Authorization 
        context.commit('resetUser', null) 
      }
    }
  }
})
