import {defineStore} from 'pinia'
import {getUserInfos} from "@/services/user/user_services";

export const useUserStore = defineStore('user-store', {
    state: () => {
        return {
            id: 0,
            nom: '',
            prenoms: '',
            email: '',
            arrondissement: {},
            isInitialized: false,
        }
    },
    getters: {
        fullName() {
            return this.prenoms + ' ' + this.nom
        },
        arrondissementName() {
            return this.arrondissement.nom
        },
        rapportOuvertureRempli() {
            return this.arrondissement.rapportOuvertureRempli
        },
        arrondissementPostesTotal() {
            return this.arrondissement.postesTotal
        },
        arrondissementPostesRemontes() {
            return this.arrondissement.postesRemontes
        },
        arrondissementPostesRestant() {
            return this.arrondissement.postesTotal - this.arrondissement.postesRemontes
        },
    },
    actions: {
        async initialize() {
            this.isInitialized = false

            const data = await getUserInfos()

            this.id = data.id
            this.nom = data.nom
            this.prenoms = data.prenoms
            this.email = data.email
            this.arrondissement = data.arrondissement

            this.isInitialized = true
        }
    }
})
