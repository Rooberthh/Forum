<aside class="menu">
    <p class="menu-label">Profile</p>
    <div class="list-group">
        <a href="{{ route('profile', $user->name) }}"
           class="list-group-item list-group-item-action font-weight-bold">Profile
        </a>
        <a href="{{ route('settings.account', $user->name) }}"
           class="list-group-item list-group-item-action font-weight-bold">Account
        </a>
        <a href="{{ route('settings.stats', $user->name) }}" class="list-group-item list-group-item-action font-weight-bold">My Stats</a>
    </div>
</aside>
