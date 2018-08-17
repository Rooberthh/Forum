<template>
	<a href="#" :class="classes" @click="subscribe" v-text=" this.active ? 'Unsubscribe' : 'Subscribe'"></a>
</template>

<script>
export default {

  props: ['active'],

  computed: {
  	classes(){
  		return ['action-link', this.active ? 'subscribe-active' : ''];
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
