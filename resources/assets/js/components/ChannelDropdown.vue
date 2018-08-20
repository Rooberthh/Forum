<template>
    <li class="dropdown" :class="{open: toggle}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
        >
            Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="input-wrapper">
                <input type="text"
                       class="form-control"
                       v-model="filter"
                       placeholder="Filter Channels..."/>
            </div>

            <ul class="list-group channel-list">
                <li class="list-group-item" v-for="channel in filteredChannels">
                    <a :href="`/threads/${channel.slug}`" v-text="channel.name">
                    </a>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                channels: [],
                toggle: false,
                filter: ''
            }
        },

        created(){
            axios.get('/api/channels').then(({ data }) => (this.channels = data));
        },

        computed: {
            filteredChannels() {
                return this.channels.filter(channel => {
                   return channel.name
                       .toLowerCase()
                       .startsWith(this.filter.toLocaleLowerCase());
                });
            }
        }
    }
</script>

<style scoped>
    .input-wrapper {
        padding: 0.3rem 0.3rem;
    }

    .channel-list {
        max-height: 400px;
        overflow: auto;
        margin-bottom: 0;
    }

    .list-group-item {
        border-radius: 0;
        border-left: 0;
        border-right: 0;
    }

    .dropdown-menu {
        padding: 0;
    }
</style>
