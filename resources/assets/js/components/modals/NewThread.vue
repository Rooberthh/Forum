<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    body: '',
                    channel_id: ''
                },
                errors: {}
            }
        },
        methods: {
            addThread(){
                axios.post('/threads', this.form)
                .then(() => location.reload())
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
