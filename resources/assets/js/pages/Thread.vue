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
                locked: this.thread.locked
		    };
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
                axios.delete(this.endpoint);
                this.locked = false;
            },
            create()
            {
                axios.post(this.endpoint);
                this.locked = true;
            }
        },
        computed: {
            endpoint()
            {
                return '/locked-threads/'+ this.thread.slug;
            }
        }
	};
</script>

<style lang="css" scoped>
</style>
