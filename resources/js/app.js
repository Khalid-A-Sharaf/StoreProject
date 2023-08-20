import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


Echo.private('App.Models.Admin.' + adminId)
    .notification((notification) => {
        toastr.success(notification.body);
    });
