import {defineStore} from 'pinia'
import {getUserInfos} from "@/services/user-services";

export const useUserStore = defineStore('user-store', {
    state: () => {
        return {
            id: 0,
            nom: '',
            prenoms: '',
            email: '',
            arrondissement: {},
            candidats: [],
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
            // return this.arrondissement.postesTotal
            return this.arrondissement.postesVote.length
        },
        arrondissementPostesRemontes() {
            // return this.arrondissement.postesRemontes
            return this.arrondissement.postesVote.filter((pv) => pv.estRemonte).length
        },
        arrondissementPostesRestant() {
            // return this.arrondissement.postesTotal - this.arrondissement.postesRemontes
            return this.arrondissementPostesTotal - this.arrondissementPostesRemontes
        },
        arrondissementIncidentsSignales() {
            return this.arrondissement.incidentsSignales
        },
        centresVote() {
            return this.arrondissement.centresVote
        },
        postesVote() {
            return this.arrondissement.postesVote
        },
        sortedCandidats() {
            return this.candidats.sort((a, b) => {
                if (a.position < b.position) {
                    return -1;
                }
                if (a.position > b.position) {
                    return 1;
                }
                return 0;
            })
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
            this.candidats = data.candidats

            this.isInitialized = true
        }
    }
})
