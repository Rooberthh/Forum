<template>
    <div>
        <div class="level mb-5">
            <img :src="avatar" alt="profile image" width="50" height="50" class="mr-3">

            <h1>
                {{ user.name }}
                <small v-text="reputation"></small>
            </h1>
        </div>

        <form v-if="canUpdate" method="post" enctype="multipart/form-data">
            <image-upload name="avatar" @loaded="onLoad"></image-upload>
        </form>

    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        name: "AvatarForm",
        props: [
            'user',
        ],
        components: {
            ImageUpload
        },
        data() {
            return {
                avatar: this.user.avatar_path
            }
        },
        computed: {
            canUpdate(){
                return this.authorize(user => user.id === this.user.id);
            },
            reputation()
            {
                return this.user.reputation + 'xp';
            }
        },

        methods: {
            onLoad(avatar)
            {
                this.avatar = avatar.src;
                this.presist(avatar.file);
            },

            presist(avatar)
            {
                let data = new FormData();
                data.append('avatar', avatar);
                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then( () => {
                        this.$modal.show('updated-user');
                    });
            },
        }
    }
</script>

