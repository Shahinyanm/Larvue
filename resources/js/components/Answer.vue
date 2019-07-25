<script>
    export default {
        props: ['answer'],
        data() {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null,
            }
        },
        methods: {
            edit() {
                this.beforeEditCache = this.body;
                this.editing = true;
            },
            cancel() {
                this.body = this.beforeEditCache;
                this.editing = false
            },
            update() {
                axios.put(`${this.questionId}/answers/${this.id}`, {
                    body: this.body,
                })
                    .then(res => {
                        console.log(res)
                        this.editing = false;
                        this.bodyHtml = res.data.body_html;
                        alert(res.data.message)
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },
            destroy() {
                if (confirm("Are you sure?")) {

                    axios.delete(this.endpoint)
                        .then(res => {
                            $(this.$el).fadeOut(500,()=>{
                                alert(res.data.message)
                            })
                        })
                        .catch(err => {
                            console.log(err.response)
                        })
                }
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10;
            },
            endpoint(){
                return `${this.questionId}/answers/${this.id}`
            }
        }
    }
</script>

<style scoped>

</style>