@if(auth()->check())
<modal height="auto" name="updated-user" width="400">
    <div class="container">
        <i class="fas fa-check text-success mb-3"></i>

        <div class="text-center mb-3">
            <h2 class="display-5">Nailed it!</h2>
            <p>Your profile have been updated</p>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <button class="btn btn-danger mx-2 px-4" @click="$modal.hide('updated-user')">Close</button>
            <button class="btn btn-primary mx-2 px-4" @click="$modal.hide('updated-user')">Ok</button>
        </div>
    </div>
</modal>
@endif
