<template>
  <div>
  <nav class="navbar is-transparent">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <div class="is-size-4">投票箱</div>
      </a>
      <div class="navbar-burger burger" data-target="navbarExampleTransparentExample" @click="isMenuActive = !isMenuActive" :class="{'is-active': isMenuActive}">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu" :class="{'is-active': isMenuActive}" >
      <div class="navbar-start">
          <nuxt-link :to="{name:'/'}" class="navbar-item">
          Home
          </nuxt-link>
        <div class="navbar-item has-dropdown is-hoverable">
        </div>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="field is-grouped">
            <p class="control">
              <nuxt-link :to="{name:'create'}" class="button is-primary">
                <span class="icon">
                <i class="fas fa-plus-circle"></i>
              </span>
                <span>Create</span>
              </nuxt-link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <nuxt/>

  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          (๑•̀ㅂ•́)و✧ 蚊がマジうざい　٩(•౪• ٩)
        </p>
      </div>
    </div>
  </footer>
  </div>
</template>

<script>
  export default {
      data(){
          return {
              isMenuActive:false
          }
      }
  }
</script>
<style>
html {
  font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  background-color: #f9f9f9;
}

*, *:before, *:after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}
</style>
