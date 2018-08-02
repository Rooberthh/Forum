<script>
	import Replies from '../components/Replies.vue';
	import SubscribeButton from '../components/SubscribeButton.vue';
	export default {
		props: ['thread'],

		components: {
			Replies,
			SubscribeButton
		},
		data () {
		    return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                title: this.thread.title,
                pinned: this.thread.pinned,
                body: this.thread.body,
                form: {},
                editing: false
		    };
		},
        created(){
		    this.resetForm();
        },
        methods: {
		    toggleLock()
            {
                if(this.locked)
                {
                    this.destroy();
                } else {
                    this.create();
                }
            },
            destroy()
            {
                axios.delete(this.lockedEndpoint);
                this.locked = false;
            },
            create()
            {
                axios.post(this.lockedEndpoint);
                this.locked = true;
            },

            update()
            {
                axios.patch(this.editEndpoint, this.form).then(() =>{
                    this.editing = false;
                    this.title = this.form.title;
                    this.body = this.form.body;
                    flash('Your thread have been updated.');
                });
            },
            resetForm()
            {
                this.form = {
                    title: this.thread.title,
                    body: this.thread.body
                };

                this.editing = false;
            },

            togglePin()
            {
		        let uri = `/pinned-threads/${this.thread.slug}`;

		        axios[this.pinned ? "delete" : "post"](uri);

                this.pinned = ! this.pinned;
            }
        },
        computed: {
            lockedEndpoint()
            {
                return '/locked-threads/'+ this.thread.slug;
            },

            editEndpoint()
            {
                return '/threads/'+ this.thread.channel.slug + '/' + this.thread.slug;
            }
        }
	};
</script>

<style lang="css" scoped>
</style>
