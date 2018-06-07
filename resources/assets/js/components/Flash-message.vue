<template>
    <div class="alert alert-success flash-message" role="alert" v-show="show">
      <strong>Sucess!</strong> {{ body }}
      </button>
    </div>
</template>

<script type="text/javascript">
    export default {
        props:['message'],

        data()
        {
            return {
                body: '',
                show: false
            }
        },
        created()
        {
            if(this.message)
            {
                this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });
        },

        methods: {
            flash(message) {
                this.body = this.message;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style type="text/css">
    .flash-message {
        position: fixed;
        bottom: 25px;
        right: 25px;
    }
</style>

