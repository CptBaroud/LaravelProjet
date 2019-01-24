jQuery(function($) {

    var updateArrows = function(){
        $('.carouselGallery-right').removeClass('disabled');
        $('.carouselGallery-left').removeClass('disabled');
        var curIndex = $('.carouselGallery-carousel.active').data('index');
        updateArrows.nbrOfItems = updateArrows.nbrOfItems || $('.carouselGallery-carousel').length -1;

        curIndex === updateArrows.nbrOfItems && $('.carouselGallery-right').addClass('disabled');
        curIndex === 0 && $('.carouselGallery-left').addClass('disabled');
    }
    $('.carouselGallery-carousel').on('click', function(e){
        scrollTo = $('body').scrollTop();
        $('body').addClass('noscroll');
        $('body').css('position', 'fixed');
        $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');
        $(this).addClass('active');
        showComment($(this));
        updateArrows();
    });

    var modalComment ='';
    var showComment = function (that) {
        //   console.log(that);
        let title = that.data('title'),
            date = that.data('date'),
            imagetext = that.data('imagetext'),
            imagepath = that.data('imagepath'),
            comment = that.data('comment'),
            id = that.data('id'),


            maxHeight = $(window).height() - 100;

        if ($('.carouselGallery-wrapper').length === 0) {
            if (typeof imagepath !== 'undefined') {
                $.getJSON({
                    url: 'http://127.0.0.1:3000/comments/id/' + id,
                    headers: {
                        TOKEN: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiJncnZuIiwiZW1haWwiOiJndXJ2YW4uc2V2ZW5vQGdtYWlsLmNvbSIsImlhdCI6MTU0ODM3MTY5NX0.eZDR5KcDNGjkdIp5szD43ojc3buSDeTP9Lwbevp5R9Y"
                    },
                    success: function(data) {
                        modalComment = "<div class='carouselGallery-wrapper'>";
                        modalComment += "<div class='carouselGallery-modal'><span class='carouselGallery-left'><span class='icons icon-arrow-left6'></span></span><span class='carouselGallery-right'><span class='icons icon-arrow-right6'></span></span>";
                        modalComment += "<div class='container'>";
                        modalComment += "<div class='carouselGallery-scrollbox' style='max-height:" + maxHeight + "px'><div class='carouselGallery-modal-image'>";
                        modalComment += "<img src='" + imagepath + "' alt='carouselGallery image'>";
                        modalComment += "</div>";
                        modalComment += "<div class='carouselGallery-modal-text'>";
                        modalComment += "<span class='carouselGallery-modal-username'>" + title + "</a> </span>";
                        modalComment += "</br>";
                        modalComment += "<span class='carouselGallery-modal-location'>" + date + "</span>";
                        modalComment += "</br>";
                        modalComment += "</span>";
                        modalComment += "<span class='carouselGallery-modal-imagetext'>";
                        modalComment += "<p>" + imagetext + "</p>";
                        modalComment += "<a href='activities\\like\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Like</button></a>";
                        modalComment += "<a href='activities\\edit\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button></a>";
                        modalComment += "<a href='activities\\delete\\"+ id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Delete</button></a>";
                        modalComment += "</span></div></div>";
                        for (var i = 0; i < data.length; i++)
                            modalComment += "<div><p>" + data[i].comment + "</p></div>";
                        modalComment += "</div></div></div>";
                        $('body').append(modalComment).fadeIn(2500);
                    },
                    fail: console.error
                });
            }
        }
    };

    $(`body`).on( 'click','.carouselGallery-wrapper', function(e) {
        if($(e.target).hasClass('.carouselGallery-wrapper')){
            removeModal();
        }
    });
    $(`body`).on('click', '.carouselGallery-modal .iconscircle-cross', function(e){
        removeModal();
    });

    var removeModal = function(){
        $('body').find('.carouselGallery-wrapper').remove();
        $('body').removeClass('noscroll');
        $('body').css('position', 'static');
        $('body').animate({scrollTop: scrollTo}, 0);
    };

    // Avoid break on small devices
    var carouselGalleryScrollMaxHeight = function() {
        if ($('.carouselGallery-scrollbox').length) {
            maxHeight = $(window).height()-100;
            $('.carouselGallery-scrollbox').css('max-height',maxHeight+'px');
        }
    }
    $(window).resize(function() { // set event on resize
        clearTimeout(this.id);
        this.id = setTimeout(carouselGalleryScrollMaxHeight, 100);
    });
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            removeModal();
        }
    };

});
