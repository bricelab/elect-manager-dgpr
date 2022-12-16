import {axios} from '@/modules/axios/axios'

/**
 * @typedef {Object} Incident
 * @property {Number} id ID de l'enregistrement
 * @property {string} heure URI de l'arrondissement
 * @property {string} details Point des événements d'ouverture
 */

/**
 * Permet d'envoyer un rapport d'ouverture de scrutin par arrondissement
 *
 * @param {Incident} rapportOuverture
 * @return {Promise<Incident>}
 */
export function signalerIncident({heure, details}) {
    return axios.post('/api/incidents', {
        heure,
        details,
    }).then((response) => {
        return {
            id: response.data.id,
            heure,
            details,
        }
    })
}
