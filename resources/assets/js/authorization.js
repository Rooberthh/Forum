let user = window.App.user;
let roles = window.App.roles;

module.exports = {
    owns(model, prop = 'user_id'){
        return model[prop] === user.id
    },

    isAdmin(){
        return user.isAdmin;
    },

    isRole(role){
        return roles.indexOf(role) !== -1;
    },

};
