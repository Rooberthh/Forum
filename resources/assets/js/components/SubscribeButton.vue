<template>
	<button :class="classes" @click="subscribe" v-text=" this.active ? 'Unsubscribe' : 'Subscribe'"></button>
</template>

<script>
export default {

  props: ['active'],

  computed: {
  	classes(){
  		return ['btn', this.active ? 'btn-link' : 'btn-link', 'subscribe-button'];
  	}
  },

  methods:
  {
  	subscribe()
  	{
      let requestType = this.active ? 'delete' : 'post';

  		axios[requestType](location.pathname + '/subscriptions');

      this.active = ! this.active;
  	}
  }
};
</script>

<style scoped>
    .subscribe-button {
        padding-left: 0;
    }
</style>
