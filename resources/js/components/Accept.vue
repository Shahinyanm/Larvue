<template>
    <div>

        <a v-if="canAccept" title="Mark this answer as best Answer"
           :class="classes"
           @click.prevent="create"
        >
            <i class="fas fa-check"></i>
        </a>

        <a v-if="accepted" title="The question owner accepted this answer as the best."
           :class="classes"
        >
            <i class="fas fa-check"></i>
        </a>

    </div>
</template>

<script>
    export default {
        name: "Accept",
        props: ['answer'],
        data() {
            return {
                isBest: this.answer.is_best,
                id: this.answer.id
            }
        },
        methods: {
            create() {
                axios.post(`/answers/${this.id}/accept`)
                    .then(res => {
                        this.$toast.success(res.data.message,'success',{timeout:3000, position:'bottomLeft'})
                        this.isBest =true;
                    })
            }
        },
        computed: {
            canAccept() {
                return this.authorize('accept',this.answer);
            },
            accepted() {
                return !this.canAccept && this.isBest
            },
            classes() {
                return [
                    'mt-2', 'text-center',
                    this.isBest ? 'vote-accepted' : ''
                ]
            },

        },
    }
</script>

<style scoped>

</style>