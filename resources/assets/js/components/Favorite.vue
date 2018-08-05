<template>
	<button type="submit" :class="classes" @click="toggle">
		<span v-text="favoritesCount"></span>
		<i class="fas fa-heart"></i>
	</button>
</template>

<script>
export default {
	props: [
	'reply'
	],
  data () {
    return {
    	favoritesCount: this.reply.favoritesCount,
    	isFavorited: this.reply.isFavorited
    }
  },

  methods: {
  	toggle()
  	{
  		if(this.isFavorited)
  		{
  			this.destroy();
  		} else {
  			this.create();
  		}
  	},

    create() {
      axios.post(this.endpoint);
        this.isFavorited = true;
        this.favoritesCount++;
    },
    destroy() {
      axios.delete(this.endpoint);
      this.isFavorited = false;
      this.favoritesCount--;
    }
  },
  computed: {
  	classes() {
  		return ['btn', this.isFavorited ? 'text-danger' : 'btn-link', 'btn-link-default'];
  	},

    endpoint(){
      return '/replies/'+ this.reply.id +'/favorites';
    }
  }
};
</script>

<style lang="css" scoped>
    .btn-link-default{
        text-decoration: none;
        color: grey;
        background: transparent;
        outline: none transparent;
     }
</style>
