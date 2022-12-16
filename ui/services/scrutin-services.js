import {axios} from '@/modules/axios/axios'

/**
 * @typedef {Object} RapportOuverture
 * @property {Number} id ID de l'enregistrement
 * @property {string} arrondissement URI de l'arrondissement
 * @property {string} ouverture Point des événements d'ouverture
 * @property {string} incidents Incidents observés à l'ouverture
 * @property {string} difficultes Difficultés rencontrée à l'ouverture
 */

/**
 * @typedef {Object} Incident
 * @property {Number} id ID de l'enregistrement
 * @property {string} heure URI de l'arrondissement
 * @property {string} details Point des événements d'ouverture
 */

/**
 * @typedef {Object} RemonteeResultat
 * @property {Number} posteVote ID de l'enregistrement
 * @property {string} inscrits URI de l'arrondissement
 * @property {string} votants Point des événements d'ouverture
 * @property {string} nuls Point des événements d'ouverture
 * @property {Array} suffrages Point des événements d'ouverture
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

/**
 * Permet de signaler un incident lors du scrutin par arrondissement
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

/**
 * Permet de remonter les résultats à la fermeture des postes de vote par arrondissement
 *
 * @param {RemonteeResultat} result
 * @return {Promise<Object>}
 */
export function remonterResultats({posteVote, inscrits, votants, nuls, suffrages}) {
    return axios.post('/api/remonter-resultats', {
        posteVote,
        inscrits,
        votants,
        nuls,
        suffrages,
    }).then((response) => {
        return {
            status: 'OK',
        }
    })
}
