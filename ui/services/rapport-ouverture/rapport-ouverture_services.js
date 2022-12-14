import axios from '@/modules/axios/axios';

/**
 * @typedef {Object} RapportOuverture
 * @property {Number} id ID de l'enregistrement
 * @property {string} arrondissement URI de l'arrondissement
 * @property {string} ouverture Point des événements d'ouverture
 * @property {string} incidents Incidents observés à l'ouverture
 * @property {string} difficultes Difficultés rencontrée à l'ouverture
 */

/**
 * Permet d'envoyer un rapport d'ouverture de scrutin par arrondissement
 *
 * @param {RapportOuverture} rapportOuverture
 * @return {Promise<RapportOuverture>}
 */
export function envoyerRapportOuverture({arrondissement, ouverture, incidents, difficultes}) {
    return axios.post('/api/rapport-ouverture', {
        arrondissement,
        ouverture,
        incidents,
        difficultes,
    }).then((response) => {
        return {
            id: response.data.id,
            arrondissement,
            ouverture,
            incidents,
            difficultes,
        }
    })
}
