import {axios} from '@/modules/axios/axios'

/**
 * @typedef {Object} UserInfos
 * @property {Number} id ID de l'utilisateur
 * @property {string} nom nom de l'utilisateur
 * @property {string} prenoms Prénoms de l'utilisateur
 * @property {string} email Adresse mail de l'utilisateur
 * @property {Arrondissement} arrondissement Arrondissement supervisé de l'utilisateur
 */

/**
 * @typedef {Object} Arrondissement
 * @property {Number} id ID de l'arrondissement
 * @property {string} nom nom de l'arrondissement
 * @property {string} commune URI de la commune
 * @property {boolean} rapportOuvertureRempli Spécifie si le rapport d'ouverture a déjà été soumis
 */

/**
 * Permet de récupérer les infos d'un utilisateur
 *
 * @return {Promise<UserInfos>}
 */
export function getUserInfos() {
    return axios.get('/api/me').then((response) => {
        // console.log(response.data)
        return {
            id: response.data.id,
            nom: response.data.nom,
            prenoms: response.data.prenoms,
            email: response.data.email,
            arrondissement: {
                id: response.data.arrondissementCouvert.id,
                nom: response.data.arrondissementCouvert.nom,
                commune: response.data.arrondissementCouvert.communeUri,
                rapportOuvertureRempli: response.data.arrondissementCouvert.rapportOuvertureRempli,
            },
        }
    })
}
