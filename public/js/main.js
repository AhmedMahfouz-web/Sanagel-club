

function post() {
    if (document.querySelector(".add-post").style.opacity == "1" && document.querySelector(".add-post").style.visibility == "visible") {
        document.querySelector(".add-post").style.opacity = "0";
        document.querySelector(".add-post").style.visibility = "hidden";
        document.querySelector(".add-post").style.transform = "translateY(-60px)";
    } else {
        post_on();
    }
}

function profile() {
    if (document.querySelector(".profile-option").style.visibility == "visible") {
        document.querySelector(".profile-option").style.visibility = "hidden";
        document.querySelector(".profile-option").style.opacity = "0";
        document.querySelector(".profile-option").style.transform = "translateY(-15px)";
    } else {
        profile_on();
    }
}

function notifcation() {
    if (document.querySelector(".notifcation-panel").style.opacity == "1" && document.querySelector(".notifcation-panel").style.visibility == "visible") {
        document.querySelector(".notifcation-panel").style.opacity = "0";
        document.querySelector(".notifcation-panel").style.visibility = "hidden";
    } else {
        notifcation_on();
    }
}

function profile_on() {
    document.querySelector(".profile-option").style.visibility = "visible";
    document.querySelector(".profile-option").style.opacity = "1";
    document.querySelector(".profile-option").style.transform = "translateY(0px)";
    document.querySelector(".add-post").style.opacity = "0";
    document.querySelector(".add-post").style.visibility = "hidden";
    document.querySelector(".add-post").style.transform = "translateY(-60px)";
    document.querySelector(".notifcation-panel").style.opacity = "0";
    document.querySelector(".notifcation-panel").style.visibility = "hidden";
}

function notifcation_on() {
    document.querySelector(".notifcation-panel").style.opacity = "1";
    document.querySelector(".notifcation-panel").style.visibility = "visible";
    document.querySelector(".add-post").style.opacity = "0";
    document.querySelector(".add-post").style.visibility = "hidden";
    document.querySelector(".add-post").style.transform = "translateY(-60px)";
    document.querySelector(".profile-option").style.visibility = "hidden";
    document.querySelector(".profile-option").style.opacity = "0";
    document.querySelector(".profile-option").style.transform = "translateY(-30px)";
}

function post_on() {
    document.querySelector(".add-post").style.opacity = "1";
    document.querySelector(".add-post").style.visibility = "visible";
    document.querySelector(".add-post").style.transform = "translateY(0px)";
    document.querySelector(".profile-option").style.visibility = "hidden";
    document.querySelector(".profile-option").style.opacity = "0";
    document.querySelector(".profile-option").style.transform = "translateY(-30px)";
    document.querySelector(".notifcation-panel").style.opacity = "0";
    document.querySelector(".notifcation-panel").style.visibility = "hidden";
}

function edit_profile() {
    document.querySelector(".edit-profile").style.display = "none";
    document.querySelector(".view").style.display = "none";
    document.querySelector("#edit-form").style.display = "block";
}


function cancel_edit_profile() {
    document.querySelector(".edit-profile").style.display = "block";
    document.querySelector(".view").style.display = "block";
    document.querySelector("#edit-form").style.display = "none";
}


function rotate() {
    document.querySelector(".formom").style.transform = "rotateY(180deg)";
    document.querySelector(".login-form").style.opacity = "0";
}
function rotatee() {
    document.querySelector(".formom").style.transform = "rotateY(0deg)";
    document.querySelector(".login-form").style.opacity = "1";
}

function reload() {

    // for (let i = 0; i < document.getElementsByClassName("optiones").length; i++) {
    //     l = document.getElementsByClassName("love-btn")[i];
    //     l.addEventListener("click", function () {
    //         li = document.getElementsByClassName("love")[i];
    //         pl = document.getElementsByClassName("plove")[i];
    //         form = document.getElementsByClassName('like-form')[i];
    //         // method = document.getElementsByClassName('_method')[i].value;
    //         post_action = document.getElementsByClassName('post-action')[i];
    //         love(li, pl, form, post_action);
    //     });

    //     function love(li, pl, form, post_action) {
    //         if (li.classList.contains('far')) {
    //             li.classList.remove('far');
    //             li.classList.add('fas');
    //             pl.innerHTML = "Loved";

    //             event.preventDefault();
    //             var dataString = new FormData(form);
    //             $.ajax({
    //                 url: '/like',
    //                 type: 'POST',
    //                 beforeSend: function (xhr) {
    //                     var token = $('meta[name="csrf_token"]').attr('content');

    //                     if (token) {
    //                         return xhr.setRequestHeader('X-CSRF-TOKEN', token);
    //                     }
    //                 },
    //                 data: dataString, // Remember that you need to have your csrf token included
    //                 dataType: 'json',
    //                 success: function (response) {
    //                     post_action.innerHTML = response;
    //                     reload();

    //                     console.log(response);

    //                 },
    //                 error: function (response) {
    //                     // Handle error

    //                     console.log(response);
    //                     console.log(dataString)
    //                 }
    //             });
    //             reload();


    //         } else {
    //             li.classList.remove('fas');
    //             li.classList.add('far');
    //             pl.innerHTML = "Love";

    //             form.submit(function (event) {
    //                 event.preventDefault();

    //                 $.ajax({

    //                     url: '/like',
    //                     type: 'post',
    //                     data: form.serialize(), // Remember that you need to have your csrf token included
    //                     // dataType: 'text',
    //                     success: function (_response) {
    //                         post_action.html(_response);
    //                         reload();

    //                     },
    //                     error: function (response) {
    //                         // Handle error

    //                         console.log(response);
    //                     }
    //                 });
    //                 reload();

    //             });
    //         }
    //     }
    // };





    // document.getElementsByClassName("more").addEventListener("click", function () {
    //     // function more() {
    //     if (document.getElementsByClassName("optiones").style.visibility == "visible") {
    //         document.getElementsByClassName("optiones").style.opacity = "0";
    //         document.getElementsByClassName("optiones").style.visibility = "hidden";
    //         document.getElementsByClassName("optiones").style.width = "150%";
    //         document.getElementsByClassName("optiones").style.transform = "translateY(-25px)";
    //     } else {
    //         document.getElementsByClassName("optiones").style.opacity = "1";
    //         document.getElementsByClassName("optiones").style.visibility = "visible";
    //         document.getElementsByClassName("optiones").style.width = "250%";
    //         document.getElementsByClassName("optiones").style.transform = "translateY(0px)";
    //     }
    // });

    for (let i = 0; i < document.getElementsByClassName("optiones").length; i++) {
        m = document.getElementsByClassName("more")[i];
        m.addEventListener("click", function () {
            o = document.getElementsByClassName("optiones")[i];
            more(o);
        });
    }
    function more(o) {
        if (o.style.visibility == "visible") {
            o.style.opacity = "0";
            o.style.visibility = "hidden";
            o.style.width = "150%";
            o.style.transform = "translateY(-25px)";
        } else {
            o.style.opacity = "1";
            o.style.visibility = "visible";
            o.style.width = "250%";
            o.style.transform = "translateY(0px)";
        }
    }


    for (let g = 0; g < document.getElementsByClassName("optiones").length; g++) {
        e = document.getElementsByClassName("edit-btn")[g];
        e.addEventListener("click", function () {
            c = document.getElementsByClassName("content")[g];
            l = document.getElementsByClassName("left-action")[g];
            li = document.getElementsByClassName("likes")[g];
            co = document.getElementsByClassName("comments")[g];
            ef = document.getElementsByClassName("edit-form")[g];
            ebs = document.getElementsByClassName("ebs")[g];
            ebc = document.getElementsByClassName("ebc")[g];
            m = document.getElementsByClassName("more")[g];
            o = document.getElementsByClassName("optiones")[g];
            edit(c, l, li, co, ef, ebs, ebc, o, m);
        });
        function edit(c, l, li, co, ef, ebs, ebc, o, m) {
            c.style.display = "none";
            l.style.display = "none";
            li.style.display = "none";
            co.style.display = "none";
            ef.style.display = "block";
            ebs.style.display = "inline-block";
            ebc.style.display = "inline-block";
            o.style.opacity = "0";
            o.style.visibility = "hidden";
            o.style.width = "150%";
            o.style.transform = "translateY(-25px)";
            m.style.visibility = "hidden"
        };
    };

    for (let i = 0; i < document.getElementsByClassName('post-img').length; i++) {
        e = document.getElementsByClassName("edit-btn")[i];
        ebc = document.getElementsByClassName("ebc")[i];

        e.addEventListener("click", function () {
            pi = document.getElementsByClassName('post-img')[i];
            edit(pi);
        });
        ebc.addEventListener("click", function () {
            pi = document.getElementsByClassName("post-img")[i];
            undo_edit(pi);
        });

        function edit(pi) {
            pi.style.display = 'none';
        };
        function undo_edit(pi) {
            pi.style.display = "block";
        };

    }

    for (let h = 0; h < document.getElementsByClassName("optiones").length; h++) {
        ebc = document.getElementsByClassName("ebc")[h];
        ebc.addEventListener("click", function () {
            m = document.getElementsByClassName("more")[h];
            c = document.getElementsByClassName("content")[h];
            l = document.getElementsByClassName("left-action")[h];
            ef = document.getElementsByClassName("edit-form")[h];
            ebs = document.getElementsByClassName("ebs")[h];
            ebc = document.getElementsByClassName("ebc")[h];
            undo_edit(m, c, l, li, co, ef, ebs, ebc);
        });
        function undo_edit(m, c, l, li, co, ef, ebs, ebc) {
            m.style.visibility = "visible";
            c.style.display = "block";
            l.style.display = "inline-block";
            li.style.display = "inline-block";
            co.style.display = "inline-block";
            ef.style.display = "none";
            ebs.style.display = "none";
            ebc.style.display = "none";
        };
    }

    for (let f = 0; f < document.getElementsByClassName("comment-section").length; f++) {
        c = document.getElementsByClassName("comment")[f];
        c.addEventListener("click", function () {
            cs = document.getElementsByClassName("comment-section")[f];
            comment(cs);
        });
        function comment(cs) {
            if (cs.style.visibility == "visible") {
                cs.style.transform = "translateY(-85px)";
                cs.style.visibility = "hidden";
                cs.style.margin = "0 auto -80px"
            } else {
                cs.style.transform = "translateY(-4px)";
                cs.style.visibility = "visible";
                cs.style.margin = "0 auto 5px"
            };
        }
    }



    // ** Comments Functions **

    for (let i = 0; i < document.getElementsByClassName("optiones-comment").length; i++) {
        m = document.getElementsByClassName("more-comment")[i];
        m.addEventListener("click", function () {
            o = document.getElementsByClassName("optiones-comment")[i];
            more(o);
        });
        function more(o) {
            if (o.style.visibility == "visible") {
                o.style.opacity = "0";
                o.style.visibility = "hidden";
                o.style.width = "150%";
                o.style.transform = "translateY(-25px)";
            } else {
                o.style.opacity = "1";
                o.style.visibility = "visible";
                o.style.width = "300%";
                o.style.transform = "translateY(0px)";
            }
        }
    }


    for (let g = 0; g < document.getElementsByClassName("optiones-comment").length; g++) {
        e = document.getElementsByClassName("edit-btn-comment")[g];
        e.addEventListener("click", function () {
            c = document.getElementsByClassName("content-comment")[g];
            ef = document.getElementsByClassName("edit-form-comment")[g];
            ebs = document.getElementsByClassName("ebs-comment")[g];
            ebc = document.getElementsByClassName("ebc-comment")[g];
            m = document.getElementsByClassName("more-comment")[g];
            o = document.getElementsByClassName("optiones-comment")[g];
            edit(c, ef, ebs, ebc, o, m);
        });
        function edit(c, ef, ebs, ebc, o, m) {
            c.style.display = "none";
            ef.style.display = "block";
            ebs.style.display = "inline-block";
            ebc.style.display = "inline-block";
            o.style.opacity = "0";
            o.style.visibility = "hidden";
            o.style.width = "150%";
            o.style.transform = "translateY(-25px)";
            m.style.visibility = "hidden"
        };
    };

    for (let h = 0; h < document.getElementsByClassName("optiones-comment").length; h++) {
        ebc = document.getElementsByClassName("ebc-comment")[h];
        ebc.addEventListener("click", function () {
            m = document.getElementsByClassName("more-comment")[h];
            c = document.getElementsByClassName("content-comment")[h];
            ef = document.getElementsByClassName("edit-form-comment")[h];
            ebs = document.getElementsByClassName("ebs-comment")[h];
            ebc = document.getElementsByClassName("ebc-comment")[h];
            undo_edit(m, c, ef, ebs, ebc);
        });
        function undo_edit(m, c, ef, ebs, ebc) {
            m.style.visibility = "visible";
            c.style.display = "block";
            ef.style.display = "none";
            ebs.style.display = "none";
            ebc.style.display = "none";
        };
    }


    $('.love-btn').each(function (i) {
        $(this).on('click', function (event) {
            event.preventDefault();

            function form(i) {
                form = $('.like-form:eq(' + i + ')');
                return form;
            }
            function url(i) {
                url = $('.like-form:eq(' + i + ')');
                return url;
            }
            post_id = $('.post-id:eq(' + i + ')').val();
            likes = $('.likes:eq(' + i + ')');
            comments = $('.comments:eq(' + i + ')');
            heart = $('.love:eq(' + i + ')');
            love_txt = $('.plove:eq(' + i + ')');
            $.ajax({
                url: url(i).attr('action'),
                type: 'POST',
                data: form(i).serialize(),
                dataType: 'json',
                success: function (response) {
                    likes.text(response.likes + ' Like');
                    comments.text(response.comments + ' Comment');
                    heart.toggleClass('fas');
                    heart.toggleClass('far');
                    if (love_txt.text() == 'Love') {
                        love_txt.text('Loved');
                    } else {
                        love_txt.text('Love');
                    }
                    if ($('.like-form:eq(' + i + ')').attr('action') == 'http://sanagel-laravel.com/like') {
                        $('.like-form:eq(' + i + ')').attr('action', 'http://sanagel-laravel.com/like/' + post_id);
                        $('.like-form:eq(' + i + ')').append('<input name="_method" type="hidden" value="DELETE" class="_method' + post_id + '">');
                    } else {
                        $('.like-form:eq(' + i + ')').attr('action', 'http://sanagel-laravel.com/like');
                        $('._method' + post_id).remove();
                    }

                },
                error: function (response) {
                    console.log('error');
                }
            });

        }
        )
    });

    // })
}

// }


reload();

var count = 15
$('#load-more').click(function (event) {
    event.preventDefault();
    $.ajax({

        url: '/getPosts/' + count,
        type: 'get',
        // data: $('.post-container').serialize(), // Remember that you need to have your csrf token included
        dataType: 'text',
        success: function (_response) {
            if (_response) {
                $('.post-container').append(_response);
            } else {
                $('#load-more-div').html('<p id="no-posts">No more posts :(</p>');
            }
            reload();
            count = count + 15;

        },
        error: function (response) {
            // Handle error

            console.log(response);
        }
    });
    reload();
});


$('#load-more-profile').click(function (event) {
    event.preventDefault();
    $.ajax({

        url: '/getPostsProfile/' + count,
        type: 'get',
        // data: $('.post-container').serialize(), // Remember that you need to have your csrf token included
        dataType: 'text',
        success: function (_response) {
            $('.post-container').append(_response);
            reload();
            count = count + 15;

        },
        error: function (response) {
            // Handle error

            console.log(response);
        }
    });
    reload();
});


$('#load-more-profile-user').click(function (event) {
    event.preventDefault();
    var user = $('#user-id').val();
    $.ajax({

        url: '/getPostsProfile/' + user + '/' + count,
        type: 'get',
        // data: $('.post-container').serialize(), // Remember that you need to have your csrf token included
        dataType: 'text',
        success: function (_response) {
            $('.post-container').append(_response);
            count = count + 15;
            reload();

        },
        error: function (response) {
            // Handle error

            console.log(response);
        }
    });
    reload();
});

//  else {
//     li.classList.remove('fas');
//     // li.classList.add('far');
//     // pl.innerHTML = "Love";

//     form.submit(function (event) {
//         event.preventDefault();

//         $.ajax({

//             url: '/like',
//             type: 'post',
//             data: form.serialize(), // Remember that you need to have your csrf token included
//             // dataType: 'text',
//             success: function (_response) {
//                 post_action.html(_response);
//                 reload();

//             },
//             error: function (response) {
//                 // Handle error

//                 console.log(response);
//             }
//         });
//         reload();

//     });
// }
// });


