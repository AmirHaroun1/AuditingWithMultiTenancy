import Vue from 'vue'
import VueI18n from 'vue-i18n'
import en from './locales/en.json'
import ar from './locales/ar.json'
Vue.use(VueI18n)

const messages = {
  en,
  ar
}

let lang = 'ar';

export default new VueI18n({
  locale: lang,
  fallbackLocale: lang,
  messages: messages
})