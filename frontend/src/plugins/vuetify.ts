// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { mdi } from 'vuetify/lib/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Vuetify
import { createVuetify } from 'vuetify'

export default createVuetify(
    {
        components,
        directives,
        icons: {
            defaultSet: 'mdi',
            sets: {
                mdi,
            }
        },
    }
)
