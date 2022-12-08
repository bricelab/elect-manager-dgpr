
import DefaultLayout from '@/layouts/DefaultLayout'

export const routes = [
    {
        path: '/',
        name: 'Default',
        component: DefaultLayout,
        // redirect: `/${SIDEBAR_MENU_ITEMS.HOME}`,
        redirect: '/home',
        children: [
            {
                name: 'Home',
                path: '/home',
                component: () => import('@/views/Home.vue'),
            },
            // {
            //     name: 'Appointments',
            //     path: `/${SIDEBAR_MENU_ITEMS.CALENDAR}`,
            //     component: () => import('@/views/calendar/Appointments.vue'),
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
