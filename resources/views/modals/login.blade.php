<login inline-template>
    <modal name="login" height="auto" maxWidth="800px" adaptive>
        <button type="button" class="close float-right p-2" aria-label="Close" @click="$modal.hide('login')">
            <span aria-hidden="true">&times;</span>
        </button>
        <form class="p-5" @submit.prevent="login">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" autocomplete="email" placeholder="example@example.com" value="{{ old('email') }}" required v-model="form.email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" required v-model="form.password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn is-green btn-block main-action-button" :class="loading ? 'loader' : '' ">Login</button>
            </div>

            <div class="mt-6" v-if="feedback">
                <span class="text-sm text-danger" v-text="feedback"></span>
            </div>
        </form>
    </modal>
</login>
