import { createStore } from 'vuex'

import axios from 'axios'

export default createStore({
  state: {
    user: null,
    users: [],
  },
  mutations: {

//---------------------------------------------------
    //Users mutations
    resetUser(state) {
      state.user = null
    },
    setUser(state, loggedInUser) {
      state.user = loggedInUser
    },
    setUsers (state, users) {
      state.users = users
    },
    insertUser (state, newUser) {
      state.users.push(newUser)
    },
    updateUser (state, updateUser) {
      let idx = state.users.findIndex((t) => t.id === updateUser.id)
      if (idx >= 0) {
        state.users[idx] = updateUser
      }
    },
    deleteUser (state, deleteUser) {
      let idx = state.users.findIndex((t) => t.id === deleteUser.id)
      if (idx >= 0) {
        state.users.splice(idx, 1)
      }
    },

//---------------------------------------------------

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
    },
    async loadUsers (context) {
      try {
        let response = await axios.get('users')
        context.commit('setUsers', response.data.data)
        return response.data.data
      } catch (error) {
        context.commit('resetUsers', null)
        throw error
      }
    },
    async loadLoggedInUser (context) {
      try {
        let response = await axios.get('users/me')
        context.commit('setUser', response.data.data)
      } catch (error) {
        delete axios.defaults.headers.common.Authorization
        context.commit('resetUser', null)
        throw error
      }
    },
    async refresh (context) {
      let userPromise = context.dispatch('loadLoggedInUser')
      let projectsPromise = context.dispatch('loadProjects')
      let usersPromise = context.dispatch('loadUsers')

      await userPromise
      await projectsPromise
      await usersPromise
    },
  },
  getters:{
    users: (state) => {
      return state.users
    },
    totalUsers: (state) => {
      return state.users.length
    },
  },
})
