<template>
  <div :id="'reply-'+id" class="card mb-2 border-0">
      <div class="card-body reply ml-3">
          <div class="level">
              <small class="flex">
                  <span v-if="isBest" class="reply-marked-success mr-1">
                      Best Reply
                  </span>

                  <a :href="'/profiles/'+ reply.owner.name"
                     v-text="name">
                  </a>

                  <span v-text="ago"></span>
                  <a href="#" v-if="authorize('owns', reply) || authorize('can', 'moderate')" class="action-link" @click="editing = true">| Edit </a>

                  <a href="#" class="action-link" @click="markBestReply"
                          v-show="! isBest && ! editing"  v-if="authorize('owns', reply.thread) || authorize('can', 'moderate')">
                      | Mark as best reply
                  </a>

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
              <div class="level">
              <div class="flex">
              <button class="btn btn-primary btn-sm mx-1">Update</button>
              <button class="btn btn-danger btn-sm mx-1" @click="editing = false" type="button">Cancel</button>
              </div>


              <button class="btn btn-link" @click="destroy">Delete Reply</button>
              </div>
              </form>
          </div>
          <div class="body-text" v-else v-html="body"></div>
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
