<template>
	<div>
		<div v-if="signedIn">
            <div class="form-group">
                <wysiwyg name="body" v-model="body" placeholder="Have something to say?" :shouldClear="completed"></wysiwyg>
            </div>
            <button type="submit" class="btn btn-primary"
            @click="addReply"
            >Reply</button>
        </div>
		<p class="text-center" v-else>
			Please <a href="/login">sign in</a>
			to be able to reply to threads</p>

    </div>
</template>

<script>
    import 'at.js';
    import 'jquery.caret';
    export default {

        name: 'NewReply',
        props: ['endpoint'],
        data () {
            return {
                body: '',
                completed: false
            };
        },
        methods: {
             addReply() {
                axios.post(this.endpoint, { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';
                        this.completed = true;

                        flash('Your reply has been posted.');

                        this.$emit('created', data);
                   });
               }
        }
    };
</script>

<style lang="css" scoped>
</style>
