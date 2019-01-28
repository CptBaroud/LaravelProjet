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

    var modalIdea = '';
    var showComment = function (that) {
        //   console.log(that);
        let title = that.data('title'),
            date = that.data('date'),
            description = that.data('description'),
            imagepath = that.data('imagepath'),
            price = that.data('price'),
            perms = that.data('perms'),
            numberlike = that.data('numberlike'),
            hasalreadylike = that.data('hasalreadylike'),
            id = that.data('id'),

            maxHeight = $(window).height() - 100;

        if ($('.carouselGallery-wrapper').length === 0) {
            if (typeof imagepath !== 'undefined') {
                modalIdea = "<div class='carouselGallery-wrapper'>";
                modalIdea += "<div class='carouselGallery-modal'><span class='carouselGallery-left'><span class='icons icon-arrow-left6'></span></span><span class='carouselGallery-right'><span class='icons icon-arrow-right6'></span></span>";
                modalIdea += "<div class='container'>";
                modalIdea += "<div class='carouselGallery-scrollbox' style='max-height:" + maxHeight + "px;'><div class='carouselGallery-modal-image'>";
                modalIdea += "<img src='" + imagepath + "' alt='carouselGallery image'>";
                modalIdea += "</div>";
                modalIdea += "<div class='carouselGallery-modal-text' style='overflow-y: auto; overflow-x:auto;'>";
                modalIdea += "<span class='carouselGallery-modal-username font-weight-bold'>" + title + "</a> </span>";
                modalIdea += "</br>";
                modalIdea += "<span class='carouselGallery-modal-location'>" + date + "</span>";
                modalIdea += "<span class='carouselGallery-modal-location'>" + price + "</span>";
                modalIdea += "</span>";
                modalIdea += "<span class='carouselGallery-modal-imagetext' style='overflow-y: auto'>";
                modalIdea += "</br><p>" +  description + "</p>";
                if (hasalreadylike) {
                    modalIdea += "<a href='\\idea_box\\unlike\\" + id + "'>" + numberlike + "<input type='image' id='image' alt='' src='https://pngimage.net/wp-content/uploads/2018/06/pouce-vert-png-2.png' height='8%' width='8%'></a>";
                } else {
                    modalIdea += "<a href='/idea_box/like/" + id + "'>" + numberlike + "<input type='image' id='image' alt='' src='http://www.stickpng.com/assets/images/585e4e6ccb11b227491c339e.png' height='10%' width='10%'></a>";
                }if(perms ===  1){
                    modalIdea += "<a href='\\idea_box\\edit\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button></a>";
                    modalIdea += "<a href='\\idea_box\\save\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Save</button></a>";
                    modalIdea += "<a href='\\idea_box\\delete\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Delete</button></a>";
                } else if(perms === 2){
                    modalIdea += "<a href='\\idea_box\\report\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Report</button></a>";

                }
                modalIdea += "</span></div></div>";
                modalIdea += "</div></div></div></div></div></div>";
                $('body').append(modalIdea).fadeIn(2500);
            }
        }
    };

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

});
