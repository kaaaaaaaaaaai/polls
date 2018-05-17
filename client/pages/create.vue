<template>
    <section class="section">
        <div class="columns  is-multiline is-centered">
            <div class="column is-10">
                <div class="box">
                    <section class="section">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label is-size-3">Polly Title </label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-large" type="text" placeholder="Question.....">
                                </p>
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="columns  is-multiline is-centered">
            <div class="column is-6-desktop mobile">
                <div class="box pollBox">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label is-size-3 has-text-grey-dark">Title 1</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-large" type="text" placeholder="here.....">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-6-desktop mobile">
                <div class="box pollBox">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label is-size-3 has-text-grey-dark">Title 2</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-large" type="text" placeholder="here.....">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-6-desktop mobile">
                <div class="box pollBox">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label is-size-3 has-text-grey-dark">Title 3</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-large" type="text" placeholder="here.....">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-6-desktop mobile">
                <div class="box pollBox">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label is-size-3 has-text-grey-dark">Title 4</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-large" type="text" placeholder="here.....">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns  is-multiline is-centered">
                <div class="column is-4">
                <a>
                    <div class="box">
                        <section class="section">
                            <span class="label is-size-2 has-text-grey-dark has-text-centered">Create</span>
                        </section>
                    </div>
                </a>
                </div>
        </div>
    </section>

</template>

<script>
    import { mapState, mapGetters } from 'vuex'
    export default {
        name: "create"
    }
</script>

<style scoped>

</style>