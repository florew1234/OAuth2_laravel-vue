import { defineStore } from 'pinia'
import { userLogin, userlogout, userRegister } from '@/api/auth'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    users: []
  }),

  actions: {
    async login(email, password) {
      await userLogin(email, password)
    },

    async register(name, email, password, password_confirmation) {
      await userRegister(name, email, password, password_confirmation)
    },

    async logout(id) {
      await userlogout(id)
    }
  }
})
