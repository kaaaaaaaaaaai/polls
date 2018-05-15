<template>
    <section class="section">
        <div class="box">
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <img src="/search.png" class="siteDescription--image"/>
                        <p class="heading m-top is-size-3">つくる</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <!--<i class="fas fa-angle-right fa-4x"></i>-->
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <img src="/email.png" class="siteDescription--image"/>
                        <!--<i class="fas fa-retweet fa-5x"></i>-->
                        <p class="heading m-top is-size-3">しぇあする</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <!--<i class="fas fa-angle-right fa-4x"></i>-->
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <img src="/report.png" class="siteDescription--image"/>
                        <!--<i class="fas fa-hourglass-start fa-5x"></i>-->
                        <p class="heading m-top is-size-3">けっかをみる</p>
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
</style>