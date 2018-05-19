<template>
    <section class="section">
        <div class="box">
            <nav class="level is-mobile ">
                <div class="level-item has-text-centered">
                    <nuxt-link :to="{name:'create'}" >
                        <div class="is-hidden-mobile">
                            <img src="/search.png" class="siteDescription--image"/>
                            <p class="m-top is-size-3">つくる</p>
                        </div>
                        <div class="is-hidden-desktop is-hidden-tablet">
                            <figure class="image is-48x48">
                                <img src="/search.png"/>
                            </figure>
                                <p class="m-top is-size-6-mobile has-text-weight-bold">つくる</p>
                        </div>
                    </nuxt-link>
                </div>
                <div class="level-item has-text-centered">
                    <div class="is-hidden-mobile">
                        <img src="/email.png" class="siteDescription--image"/>
                        <!--<i class="fas fa-retweet fa-5x"></i>-->
                        <p class="m-top is-size-3">しぇあする</p>
                    </div>
                    <div class="is-hidden-desktop is-hidden-tablet">
                        <figure class="image is-48x48">
                            <img src="/email.png"/>
                        </figure>
                            <p class="m-top is-size-6-mobile has-text-weight-bold">しぇあ</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div class="is-hidden-mobile">
                        <img src="/report.png" class="siteDescription--image"/>
                        <!--<i class="fas fa-hourglass-start fa-5x"></i>-->
                        <p class="m-top is-size-3">けっかをみる</p>
                    </div>
                    <div class="is-hidden-desktop is-hidden-tablet">
                        <figure class="image is-48x48">
                            <img src="/report.png"/>
                        </figure>
                            <p class="m-top is-size-6-mobile has-text-weight-bold">けっか</p>
                    </div>
                </div>
            </nav>
        </div>
    </section>
</template>

<script>
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
    export default {
        name: "site-description",
        components:{
            FontAwesomeIcon
        }
    }
</script>

<style scoped>
    .siteDescription--image{
        width: 100px;
        margin-bottom: 20px;

    }
    .m-top{
        padding-top: 10px;
    }
</style>