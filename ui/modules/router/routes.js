
import DefaultLayout from '@/layouts/DefaultLayout'

export const routes = [
    {
        path: '/',
        name: 'Default',
        component: DefaultLayout,
        // redirect: `/${SIDEBAR_MENU_ITEMS.HOME}`,
        redirect: '/accueil',
        children: [
            {
                name: 'Home',
                path: '/accueil',
                component: () => import('@/pages/Home.vue'),
            },
            {
                name: 'RapportOuverture',
                // path: `/${SIDEBAR_MENU_ITEMS.CALENDAR}`,
                path: `/rapport-d-ouverture`,
                component: () => import('@/pages/RapportOuverture.vue'),
            },
            {
                name: 'RapportIncidents',
                // path: `/${SIDEBAR_MENU_ITEMS.CALENDAR}`,
                path: `/rapport-d-incident`,
                component: () => import('@/pages/RapportIncidents.vue'),
            },
            {
                name: 'RemonteesResultats',
                // path: `/${SIDEBAR_MENU_ITEMS.CALENDAR}`,
                path: `/remontees-resultats`,
                component: () => import('@/pages/RemonteesResultats.vue'),
            },
            // {
            //     name: 'Login',
            //     // path: `/${SIDEBAR_MENU_ITEMS.CALENDAR}`,
            //     path: `/login`,
            //     component: () => import('@/views/Login.vue'),
            // },
            // {
            //     name: 'DossierMedical',
            //     path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}`,
            //     redirect: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/patients`,
            //     children: [
            //         {
            //             name: 'ListePatients',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/patients`,
            //             component: () => import('@/views/dossier-medical/patients/ListePatients.vue'),
            //         },
            //         {
            //             name: 'NewPatient',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/patients/new`,
            //             component: () => import('@/views/dossier-medical/patients/NewPatient.vue'),
            //         },
            //         {
            //             name: 'ListeConsultations',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/:patient/consultations/liste`,
            //             component: () => import('@/views/dossier-medical/consultations/ListeConsultations'),
            //         },
            //         {
            //             name: 'StartConsultation',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/:patient/consultations/start`,
            //             component: () => import('@/views/dossier-medical/consultations/StartConsultation'),
            //         },
            //         {
            //             name: 'ViewConsultation',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/:patient/consultations/:consultation/details`,
            //             component: () => import('@/views/dossier-medical/patients/ListePatients.vue'),
            //         },
            //         {
            //             name: 'ViewConsultation',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/:patient/consultations/:consultation/update`,
            //             component: () => import('@/views/dossier-medical/patients/ListePatients.vue'),
            //         },
            //         {
            //             name: 'CloseConsultation',
            //             path: `/${SIDEBAR_MENU_ITEMS.DOSSIER_MEDICAL}/:patient/consultations/:consultation/close`,
            //             component: () => import('@/views/dossier-medical/patients/ListePatients.vue'),
            //         },
            //     ]
            // },
        ]
    },
]
