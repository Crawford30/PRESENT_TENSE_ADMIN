export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isSuperAdmin() {
        return this.user.type === 'superadmin';
    }


    isAdmin() {
        return this.user.type === 'admin';
    }

    isUser() {
        return this.user.type === 'user';
    }

    isAdminOrSuperAdmin() {
        if (this.user.type === 'admin' || this.user.type === 'superadmin') {
            return true;
        }

    }

    isAdminOrAuthor() {
        if (this.user.type === 'admin' || this.user.type === 'author') {
            return true;
        }

    }
    isAuthorOrUser() {
        if (this.user.type === 'user' || this.user.type === 'author') {
            return true;
        }

    }



}

