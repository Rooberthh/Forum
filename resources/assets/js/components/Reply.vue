<template>
  <div :id="'reply-'+id" class="card mt-3 mb-4" :class="isBest ? 'border-success' : ''">
      <div class="card-body">
          <div class="level">
              <small class="flex">
                  <a :href="'/profiles/'+ reply.owner.name"
                     v-text="name">
                  </a>

                  <span v-text="ago"></span>
              </small>

              <div v-if="signedIn">
                  <favorite :reply="reply"></favorite>
              </div>
          </div>

          <div v-if="editing">
              <form @submit.prevent="update">
              <div class="form-group">
                <wysiwyg name="body" v-model="body"></wysiwyg>
              </div>

              <button class="btn btn-primary btn-sm">Update</button>
              <button class="btn btn-danger btn-sm" @click="editing = false" type="button">Cancel</button>
              </form>
          </div>
          <div v-else v-html="body"></div>
          <button class="btn btn-link pl-0" @click="markBestReply"
                  v-show="! isBest && ! editing"  v-if="authorize('owns', reply.thread) || authorize('can', 'moderate')">
              Best Reply
          </button>
      </div>

        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('can', 'moderate')">
                <button class="btn btn-info btn-xs mr-2 btn-sm" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
        </div>
  </div>
</template>

<script>
import Favorite from './Favorite.vue';
import moment from 'moment';

export default {
    props: ['reply'],
    components: {
      Favorite
    },
  	data() {
  		return {
  			editing: false,
  			body: this.reply.body,
            id: this.reply.id,
            isBest: this.reply.isBest,
  		}
  	},
    computed: {
      ago(){
        return moment(this.reply.created_at).fromNow() + '...';
      },

      name() {
          return this.reply.owner.name + ' (' + this.reply.owner.reputation + ' XP)';
      }
    },

    created() {
        window.events.$on('best-reply-selected', id =>{
            this.isBest = (id === this.reply.id);
        });
    },
  	methods: {
  		update()
  		{
  			axios.patch('/replies/' + this.id, {
  				body: this.body
  			})
            .catch(error => {
                flash(error.response.data, 'danger');
            });

  			this.editing = false;

  			flash('Reply have been updated!');
  		},
  		destroy()
  		{
  			axios.delete('/replies/' + this.id);

            this.$emit('deleted', this.id);

            flash('Reply have been deleted!');
  		},
  		markBestReply()
        {
            axios.post('/replies/' + this.id + '/best');

            window.events.$emit('best-reply-selected', this.id);

            flash('The reply have been marked as best', 'info');
        }
  	}
};
</script>

<style lang="css" scoped>
</style>
