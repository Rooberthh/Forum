<template>
	<div>
		<div v-if="signedIn">
            <div class="form-group">
              <textarea name="body" id="body" class="form-control"
              placeholder="Have something to say?"
              row="5" v-model="body" required></textarea>
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
                body: ''
            };
        },
        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });
                    }
                }
            });
        },

        methods: {
             addReply() {
                axios.post(this.endpoint, { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted.');
                        this.$emit('created', data);
                   });
               }
        }
    };
</script>

<style lang="css" scoped>
</style>
