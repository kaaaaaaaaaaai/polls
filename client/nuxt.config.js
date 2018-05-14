require('dotenv').config();

module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: "%s eeee-client",
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    script: [
        // { src: '~/static/app.js' }
        { src: 'https://use.fontawesome.com/releases/v5.0.7/js/all.js', defer: true }

    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** Run ESLint on save
    */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },
  axios: {
      baseURL:process.env.FRONT_API_URL,
  },
  //  cache: true,
  env:{
      apiUrl: process.env.FRONT_API_URL || 'http://api.domain.com',
  },
  modules: [
      // Simple usage
      'nuxt-buefy',
      "@nuxtjs/axios",
      // "@fortawesome/vue-fontawesome",
      // "@fortawesome/fontawesome-free-solid",
      // "@fortawesome/fontawesome"
  ]
}
