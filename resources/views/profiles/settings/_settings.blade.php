<aside class="menu">
    <p class="menu-label">Profile</p>
    <div class="list-group">
        <a href="{{ route('profile', $user->name) }}"
           class="list-group-item list-group-item-action settings-list-item">Profile
        </a>
        <a href="{{ route('settings.account', $user->name) }}"
           class="list-group-item list-group-item-action settings-list-item active">Account
        </a>
        <a href="{{ route('settings.stats', $user->name) }}" class="list-group-item list-group-item-action settings-list-item">My Stats</a>
    </div>
</aside>
