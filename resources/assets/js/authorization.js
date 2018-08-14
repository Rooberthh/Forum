let user = window.App.user;
let roles = window.App.roles;

module.exports = {
    owns(model, prop = 'user_id'){
        return model[prop] === user.id
    },

    isAdmin(){
        return user.isAdmin;
    },

    hasRole(role){
        return roles.indexOf(role) !== -1;
    },

    can(permission)
    {
        return user.can[permission] !== false;
    }



};
