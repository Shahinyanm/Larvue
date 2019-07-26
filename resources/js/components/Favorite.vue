<template>
        <a title="Click to mark as Favorite(Click again to undo"
           :class="classes"
        >
            <i class="fas fa-star"></i>
            <span class="favorites-count">{{count}}</span>
        </a>

</template>

<script>
    export default {
        name:'Favorite',
        props: ['question'],
        data() {
            return {
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
                signedIn: true,
            }
        },
        computed:{
            classes(){
                return [
                    'favorite', 'mt-2','text-center',
                    ! this.signedIn? 'off' : (this.isFavorited? favorited : '')
                ];
            }
        }
    }
</script>

<style scoped>

</style>