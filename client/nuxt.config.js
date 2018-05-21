require('dotenv').config();

module.exports = {
  /*
  ** Headers of the page
  */
  head: {
      titleTemplate: '%s Polly-投票箱-',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Polly-投票箱-は、匿名で投票をする＆投票を受け取れるサービスです。投票箱は5秒で作成完了。URLをTwitterやInstagramに投稿して、いろんな人に投票してしよう！' },
      { hid: 'twitter:description', name: 'twitter:description', content: 'Polly-投票箱-は、匿名で投票をする＆投票を受け取れるサービスです。投票箱は5秒で作成完了。URLをTwitterやInstagramに投稿して、いろんな人に投票してしよう！' },
      { hid: 'twitter:title', name: 'twitter:title', content: "Polly-投票箱-" },
      { hid: 'twitter:image', name: 'twitter:image', content: `${process.env.FRONT_API_URL}/img/ogp.jpg` },
      { hid: 'twitter:card', name: 'twitter:card', content: "summary_large_image" },
      { hid: 'twitter:url', name: 'twitter:url', content: "" },
      { hid: 'twitter:site', name: 'twitter:site', content: "" },
      { hid: 'twitter:domain', name: 'twitter:domain', content: "" },
      { hid: 'twitter:title', name: 'twitter:title', content: "Polly-投票箱-" },
      { hid: 'og:url', name: 'og:url', content: `${process.env.CLIENT_DOMAIN}` },
      { hid: 'og:image', name: 'og:image', content: `${process.env.FRONT_API_URL}/img/ogp.jpg` },
      { hid: 'og:description', name: 'og:description', content: 'Polly-投票箱-は、匿名で投票をする＆投票を受け取れるサービスです。投票箱は5秒で作成完了。URLをTwitterやInstagramに投稿して、いろんな人に投票してしよう！' },
      { hid: 'og:locale', name: 'og:locale', content: 'ja_JP' },
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
      credentials: true,
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
      ['@nuxtjs/google-analytics', {
          id: 'UA-119527059-1'
      }]
      // "@fortawesome/vue-fontawesome",
      // "@fortawesome/fontawesome-free-solid",
      // "@fortawesome/fontawesome"
  ],
  plugins: [{ src: '~/plugins/nuxt-client-init.js', ssr: false }]
}
