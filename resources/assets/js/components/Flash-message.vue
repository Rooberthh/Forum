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
            console.log("hihihihih");
            console.log(this.message);
            if(this.message)
            {
                this.body = this.message;
                this.show = true;
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

