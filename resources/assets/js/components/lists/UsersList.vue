<template>
    <div>
        <table-component
            :data="users"
            sort-by="name"
            sort-order="asc"
            :pagination = "false"
        >
            <table-column show="name" label="Name"></table-column>
            <table-column show="email" label="Email"></table-column>
            <table-column show="reputation" label="Reputation" data-type="numeric"></table-column>
            <table-column show="confirmed" label="Confirmed" data-type="numeric"></table-column>
            <table-column show="locked" label="Locked" data-type="numeric"></table-column>
            <table-column label="Action" :sortable="false" :filterable="false">
                <template slot-scope="row">
                    <div v-if="! row.locked">
                        <a href="#" @click="lockUser(row.id)" class="btn btn-outline-warning btn-sm">Lock</a>
                    </div>
                    <div v-else>
                        <a href="#" @click="unlockUser(row.id)" class="btn btn-outline-warning btn-sm">Unlock</a>
                    </div>
                </template>
            </table-column>
        </table-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        methods: {
            lockUser(id)
            {
                axios.post('/locked-users/' + id);
                flash('User have been locked');

                location.reload();
            },
            unlockUser(id)
            {
                axios.delete('/locked-users/' + id);
                flash('User have been unlocked');

                location.reload();
            },
        },
        created(){
            axios.get('/api/users')
                .then(({data}) => this.users = data)
        }
    }
</script>

<style scoped>

</style>
