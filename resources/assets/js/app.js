
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
// Vue.use(clipboard);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');


window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "52f8364eee4824042cf1",
    cluster: 'eu',
    encrypted: true,
    forceTLS: true
});

var notifications = [];
//...

$(document).ready(function () {
    if (Laravel.userId) {
        //...
        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });
    }
});


const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    comment: 'App\\Notifications\\NewComment',
    like: 'App\\Notifications\\NewLike'
};

$(document).ready(function () {
    // check if there's a logged in user
    if (Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, '#notifications');
        });
        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 10);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + '-panel').html(htmlElements.join(''));
        $('#notificationBtn').addClass('has-notifications')
    } else {
        $(target + '-panel').html('<li class="dropdown-header">No notifications...</li>');
        $('#notificationBtn').removeClass('has-notifications');
    }
}

// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    var notificationDesc = makeNotificationDesc(notification);
    return '<a href="' + to + '"><div class="notifcation"><img src="/storage/public/images/' + notification.data.profile_picture + '"><div class="notifcation-content"><p class="head">' + notificationText + '</p><p class="center">' + notificationDesc + '</p><p class="date">' + notification.created_at + '</p><section class="fix"></section></div></div></a>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if (notification.type === NOTIFICATION_TYPES.follow) {
        to = 'profile/' + notification.data.follower_id + to;
    } else if (notification.type === NOTIFICATION_TYPES.comment) {
        to = 'posts/' + notification.data.post_id + to;
    } else if (notification.type === NOTIFICATION_TYPES.like) {
        to = 'posts/' + notification.data.post_id + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += '<strong>' + name + '</strong> followed you';
    } else if (notification.type === NOTIFICATION_TYPES.comment) {
        const name = notification.data.commenter_name;
        text += '<strong>' + name + '</strong> commented on your post';
    } else if (notification.type === NOTIFICATION_TYPES.like) {
        const name = notification.data.liker_name;
        text += '<strong>' + name + '</strong> liked your post';
    }
    return text;
}

// get the notification description based on it's type
function makeNotificationDesc(notification) {
    var desc = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        desc += 'You got a new follow from <strong>' + name + '</strong>';
    } else if (notification.type === NOTIFICATION_TYPES.comment) {
        const name = notification.data.commenter_name;
        desc += 'Your post got a new comment from <strong>' + name + '</strong>';
    } else if (notification.type === NOTIFICATION_TYPES.like) {
        const name = notification.data.liker_name;
        desc += 'Your post got a new like from <strong>' + name + '</strong>';
    }
    return desc;
}


// Load more posts
// $(document).ready(function () {
//     var count = 2;
//     $('#load-more').click(function () {
//         count = count + 2;
//         $('.post-container').load('/getPosts/' + count)
//     })
// })


// $('#load-more').click(function (event) {
//     reload();
//     event.preventDefault();
//     var count = count + 2;
//     $.ajax({

//         url: '/getPosts/' + count,
//         type: 'get',
//         // data: $('.post-container').serialize(), // Remember that you need to have your csrf token included
//         dataType: 'text',
//         success: function (_response) {
//             $('.post-container').append(_response);
//             console.log();
//         },
//         error: function (response) {
//             // Handle error

//             console.log(response);
//         }
//     });
// });

