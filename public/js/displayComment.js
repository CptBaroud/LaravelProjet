jQuery(function ($) {

    var updateArrows = function () {
        $('.carouselGallery-right').removeClass('disabled');
        $('.carouselGallery-left').removeClass('disabled');
        var curIndex = $('.carouselGallery-carousel.active').data('index');
        updateArrows.nbrOfItems = updateArrows.nbrOfItems || $('.carouselGallery-carousel').length - 1;

        curIndex === updateArrows.nbrOfItems && $('.carouselGallery-right').addClass('disabled');
        curIndex === 0 && $('.carouselGallery-left').addClass('disabled');
    }
    $('.carouselGallery-carousel').on('click', function (e) {
        scrollTo = $('body').scrollTop();
        $('body').addClass('noscroll');
        $('body').css('position', 'fixed');
        $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');
        $(this).addClass('active');
        showComment($(this));
        updateArrows();
    });

    var modalComment = '';
    var showComment = function (that) {
            //   console.log(that);
            let title = that.data('title'),
            date = that.data('date'),
            imagepath = that.data('imagepath'),
            action = that.data('action'),
            numberlike = that.data('numberlike'),
            hasalreadylike = that.data('hasalreadylike'),
            id = that.data('id'),
            perms = that.data('perms'),

            maxHeight = $(window).height() - 100;

            if ($('.carouselGallery-wrapper').length === 0) {
                if (typeof imagepath !== 'undefined') {
                    $.getJSON({
                        url: 'http://127.0.0.1:3000/comments/images/' + id,
                        headers: {
                            TOKEN: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiJncnZuIiwiZW1haWwiOiJndXJ2YW4uc2V2ZW5vQGdtYWlsLmNvbSIsImlhdCI6MTU0ODM3MTY5NX0.eZDR5KcDNGjkdIp5szD43ojc3buSDeTP9Lwbevp5R9Y"
                        },
                        success: function (data) {
                            console.log(data);
                            modalComment = "<div class='carouselGallery-wrapper'>";
                            modalComment += "<div class='carouselGallery-modal'><span class='carouselGallery-left'><span class='icons icon-arrow-left6'></span></span><span class='carouselGallery-right'><span class='icons icon-arrow-right6'></span></span>";
                            modalComment += "<div class='container'>";
                            modalComment += "<div class='carouselGallery-scrollbox' style='max-height:" + maxHeight + "px; overflow-y: auto'><div class='carouselGallery-modal-image'>";
                            modalComment += "<img src='" + imagepath + "' alt='carouselGallery image'>";
                            modalComment += "</div>";
                            modalComment += "<div class='carouselGallery-modal-text' style='overflow-y: auto; overflow-x:auto '>";
                            modalComment += "<span class='carouselGallery-modal-username font-weight-bold'>" + title + "</a> </span>";
                            modalComment += "</br>";
                            modalComment += "<span class='carouselGallery-modal-location'>" + date + "</span>";
                            modalComment += "</span></br>";
                            modalComment += "<span class='carouselGallery-modal-imagetext' style='overflow-y: auto'>";
                            modalComment += "<form action='/activities/comment/images/" + id + "' method='post' enctype='multipart/form-data' class='form-control form-control-sm'>";
                            modalComment += "<input type='text' name='comment' id='comment' class='form-control' placeholder='Comment'><input type='hidden' value='" + action + "' name='_token'><button type='submit' class='btn btn-sm btn-primary'>Add Comment</button></form></br>";

                            for (var i = 0; i < data.length; i++) {
                                modalComment += "<p class='font-weight-light'><strong>" + data[i].user_name + "</strong> : " + data[i].comment + "    ";
                                if (perms === 1) {
                                    if (hasalreadylike) {
                                        modalComment += "<a href='\\activities\\comment\\unlike\\" + data[0].id_comment + "'>" + data[i].nbr_likes + "<input type='image' id='image' alt='' src='https://pngimage.net/wp-content/uploads/2018/06/pouce-vert-png-2.png' height='8%' width='8%'></a>"
                                    } else {
                                        modalComment += "<a href='\\activities\\comment\\like\\" + data[0].id_comment + "'>" + numberlike + "<input type='image' id='image' alt='' src='http://www.stickpng.com/assets/images/585e4e6ccb11b227491c339e.png' height='10%' width='10%'></a>"
                                    }
                                    modalComment += "<a href='\\activities\\comment\\delete\\" + data[0].id_comment + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Delete</button></a>";
                                } else if (perms === 2) {
                                    if (hasalreadylike) {
                                        modalComment += "" + data[i].nbr_likes + "<input type='image' id='image' alt='' src='http://www.stickpng.com/assets/images/585e4e6ccb11b227491c339e.png' height='10%' width='10%'>"
                                    } else {

                                        modalComment += "<a href='/activities/comment/like/'>" + numberlike + "<input type='image' id='image' alt='' src='http://www.stickpng.com/assets/images/585e4e6ccb11b227491c339e.png' height='10%' width='10%'></a>"
                                    }
                                    modalComment += "<a href='\\activities\\" + id + "\\images\\showComment\\report\\"+ data[0].id_comment +"'> <button type='button' class='btn btn-sm btn-outline-secondary'>Report</button></a>";
                                } else if(perms ===0){
                                    if (hasalreadylike) {
                                        modalComment += "<a href='\\activities\\comment\\unlike\\" + data[0].id_comment + "'>" + data[i].nbr_likes + "<input type='image' id='image' alt='' src='https://pngimage.net/wp-content/uploads/2018/06/pouce-vert-png-2.png' height='8%' width='8%'></a>"
                                    } else {
                                        modalComment += "<a href='\\activities\\comment\\like\\" + data[0].id_comment + "'>" + numberlike + "<input type='image' id='image' alt='' src='http://www.stickpng.com/assets/images/585e4e6ccb11b227491c339e.png' height='10%' width='10%'></a>"
                                    }
                                }
                                modalComment += "</p>";
                                modalComment += "</br>";
                                if (perms === 1) {
                                    modalComment += "<a href='\\activities\\image\\delete\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-primary'>Delete</button></a>";
                                } 
                            }
                            if (perms === 2) {
                                modalComment += "<a href='\\activities\\" + id + "\\images\\report'> <button type='button' class='btn btn-sm btn-outline-primary'>Report</button></a>";
                            }

                            modalComment += "</span></div></div>";
                            modalComment += "</div></div></div></div></div></div>";
                            $('body').append(modalComment).fadeIn(2500);
                        },
                        fail: console.error
                    }
                    );
}
}
}
;

$(`body`).on('click', '.carouselGallery-wrapper', function (e) {
    if ($(e.target).hasClass('.carouselGallery-wrapper')) {
        removeModal();
    }
});
$(`body`).on('click', '.carouselGallery-modal .iconscircle-cross', function (e) {
    removeModal();
});

var removeModal = function () {
    $('body').find('.carouselGallery-wrapper').remove();
    $('body').removeClass('noscroll');
    $('body').css('position', 'static');
    $('body').animate({scrollTop: scrollTo}, 0);
};

// Avoid break on small devices
var carouselGalleryScrollMaxHeight = function () {
    if ($('.carouselGallery-scrollbox').length) {
        maxHeight = $(window).height() - 100;
        $('.carouselGallery-scrollbox').css('max-height', maxHeight + 'px');
    }
}
    $(window).resize(function () { // set event on resize
        clearTimeout(this.id);
        this.id = setTimeout(carouselGalleryScrollMaxHeight, 100);
    });
    document.onkeydown = function (evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            removeModal();
        }
    };

})
;
