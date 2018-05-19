<template>
  <div>
    <site-description/>
    <!--<section class="section">-->
      <!--<p class="title is-1 is-spaced">とれんど</p>-->
    <!--</section>-->
      <section class="hero p-left-5">
        <h1 class="title is-1 is-spaced"> # Trend</h1>
      </section>
      <section class="section">
        <div class="columns is-mobile is-multiline is-centered">
          <div v-for="(value, key, index) in trendPolls" :key="index" class="column is-12-mobile is-3-desktop is-6-tablet">
              <nuxt-link :to="{name:'poll-id', params:{id:value.id}}">
                <div class="box">
                    <p><img :src="`http://localhost:8000/poll_img/${value.id}.jpg`" /></p>
                    <p>this poll title is : {{value.title}}</p>
                </div>
              </nuxt-link>
          </div>
        </div>
      </section>
      <section class="section">
          <p class="title is-1 is-spaced">しんちゃく</p>
      </section>
      <section class="section">
        <div class="columns  is-multiline is-mobile is-centered">
          <div v-for="(value, key, index) in recentPolls" :key="index" class="column is-12-mobile is-3-desktop">
              <nuxt-link :to="{name:'poll-id', params:{id:value.id}}">
                  <div class="box">
                      <p><img :src="`http://localhost:8000/poll_img/${value.id}.jpg`" /></p>
                      <p>this poll title is : {{value.title}}</p>
                  </div>
              </nuxt-link>
          </div>
        </div>
      </section>
  </div>
</template>

<style scoped>
  .p-left-5{
    padding-left: 5px;
  }
</style>

<script>
import AppLogo from '~/components/AppLogo.vue'
import SiteDescription from '~/components/SiteDescription.vue'
import { mapState } from 'vuex'

export default {
  components: {
    AppLogo, SiteDescription
  },
  computed: mapState([
        "trendPolls",
        "recentPolls"
    ]),
  mounted(){
      console.log("adwdawd");
      this.$store.dispatch("GET_TREND_POLL")
      this.$store.dispatch("GET_RECENT_POLL")
  },
}
</script>

<style>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
