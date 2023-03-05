export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isSuperAdmin() {
        return this.user.type === 'super_admin';
    }


    isAdmin() {
        return this.user.type === 'admin';
    }

    isUser() {
        return this.user.type === 'user';
    }

    isAdminOrSuperAdmin() {
        if (this.user.type === 'admin' || this.user.type === 'super_admin') {
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

