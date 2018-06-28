<template>
  <div :id="'reply-'+id" class="card mt-3 mb-4">
      <div class="card-header">
        <div class="level">
          <h5 class="flex">
              <a :href="'/profiles/'+ data.owner.name"
                  v-text="data.owner.name">
              </a>
              <span v-text="ago"></span>
            </h5>

            <div v-if="signedIn">
              <favorite :reply="data"></favorite>
            </div>

          </div>
      </div>
      <div class="card-body">
        <div v-if="editing">
          <div class="form-group">
            <textarea class="form-control" v-model="body"></textarea>
          </div>

          <button class="btn btn-primary btn-sm" @click="update">Update</button>
          <button class="btn btn-info btn-sm" @click="editing = false">Cancel</button>
        </div>

        <div v-else v-text="body">
        </div>
      </div>

        <div class="card-footer level" v-if="canUpdate">
          <button class="btn btn-info btn-xs mr-2 btn-sm" @click="editing = true">Edit</button>
          <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
        </div>
  </div>
</template>

<script>
import Favorite from './Favorite.vue';
import moment from 'moment';

export default {
	props: ['data'],
  name: 'Reply',

    components: {
      Favorite
    },
  	data() {
  		return {
  			editing: false,
  			body: this.data.body,
        id: this.data.id
  		}
  	},
    computed: {
      ago(){
        return moment(this.data.created_at).fromNow() + '...';
      },
      signedIn(){
        return window.App.signedIn;
      },

      canUpdate(){
        return this.authorize(user => this.data.user_id == user.id);
      }
    },
  	methods: {
  		update()
  		{
  			axios.patch('/replies/' + this.data.id, {
  				body: this.body
  			})
            .catch(error => {
                flash(error.response.data, 'danger');
            });

  			this.editing = false;

  			flash('Updated!');
  		},
  		destroy()
  		{
  			axios.delete('/replies/' + this.data.id);
        this.$emit('deleted', this.data.id);
  		}
  	}
};
</script>

<style lang="css" scoped>
</style>
