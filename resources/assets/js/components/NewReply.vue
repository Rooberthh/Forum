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
export default {

	name: 'NewReply',
	props: ['endpoint'],
	data () {
		return {
			body: ''
		};
	},

	computed: {
		signedIn(){
			return window.App.signedIn;
		}
	},

	methods: {
		 addReply() {
            axios.post(this.endpoint, { body: this.body })
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