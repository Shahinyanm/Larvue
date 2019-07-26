<template>
    <div class="d-flex flex-column vote-controls mr-4">
        <a :title="title('up')" class="vote-up text-center" :class="classes">
            <i class="fas fa-caret-up"></i>
        </a>

        <span class="votes-count text-center">{{count}}</span>
        <a :title="title('down')" class="vote-down text-center" :class="classes">
            <i class="fas fa-caret-down"></i>
        </a>

        <favorite v-if="name==='question'" :question="model"></favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
    import Favorite from './Favorite'
    import Accept from './Accept'

    export default {
        name: "Vote",
        components: {
            Favorite,
            Accept
        },
        props: ['name', 'model'],
        data() {
            return {
                count: this.model.votes_count,

        }
        },
        computed: {
            classes() {
                return this.signedIn ? '' : 'off';
            }
        },
        methods: {
            title(voteType) {
                let titles = {
                    up: `This ${this.name} is useful`,
                    down: `This ${this.name} is not useful`,
                };

                return titles[voteType];
            }
        }
    }
</script>

<style scoped>

</style>