
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
import ar from 'vuetify/es5/locale/ar'

const opts = {
    lang: {
        locales: { ar},
        current: 'ar',
      },
      rtl: true
}

export default new Vuetify(opts)