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
        showModal($(this));
        updateArrows();
    });

    $('showActivity').on('click',function (e) {
        scrollTo = $('body').scrollTop();
        $('body').addClass('noscroll');
        $('body').css('position', 'fixed');
        $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');-
        $(this).addClass('active');
        showModal($(this));
        updateArrows();
    });

    $('showComment').on('click',function (e) {
        scrollTo = $('body').scrollTop();
        $('body').addClass('noscroll');
        $('body').css('position', 'fixed');
        $('.carouselGallery-col-1, .carouselGallery-col-2').removeClass('active');
        $(this).addClass('active');
        showComment($(this));
        updateArrows();
    });

    var modalHtml = '';
    let showModal = function (that) {
        //   console.log(that);
        var username = that.data('username'),
            location = that.data('location'),
            imagetext = that.data('imagetext'),
            imagepath = that.data('imagepath'),
            price = that.data('price'),
            hasalreadylike = that.data('hasalreadylike'),
            numberlike = that.data('numberlike'),
            perms = that.data('perms'),
            id = that.data('id'),

        maxHeight = $(window).height() - 100;

        if ($('.carouselGallery-wrapper').length === 0) {
            if (typeof imagepath !== 'undefined') {
                modalHtml = "<div class='carouselGallery-wrapper'>";
                modalHtml += "<div class='carouselGallery-modal'><span class='carouselGallery-left'><span class='icons icon-arrow-left6'></span></span><span class='carouselGallery-right'><span class='icons icon-arrow-right6'></span></span>";
                modalHtml += "<div class='container'>";
                modalHtml += "<div class='carouselGallery-scrollbox' style='max-height:" + maxHeight + "px'><div class='carouselGallery-modal-image'>";
                modalHtml += "<img src='" + imagepath + "' alt='carouselGallery image'>";
                modalHtml += "</div>";
                modalHtml += "<div class='carouselGallery-modal-text' style='overflow-y: auto'>";
                modalHtml += "<span class='carouselGallery-modal-username'>" + username + "</a> </span>";
                modalHtml += "</br>";
                modalHtml += "<span class='carouselGallery-modal-location'>" + location + "</span>";
                modalHtml += "<span class='carouselGallery-modal-location'>" + price + "</span>";
                modalHtml += "</br>";
                modalHtml += "</span>";
                modalHtml += "<span class='carouselGallery-modal-imagetext' style=' overflow-y: auto'>";
                modalHtml += "<p>" + imagetext + "</p>";
                modalHtml += "<p> Number of registered : "+ numberlike +" </p>";
                modalHtml += "</br>";
                modalHtml += "</br>";
                modalHtml += "<a href='activities/"+id+"'><button type='button' class='btn btn-sm btn-outline-success'>See more</button></a>";
                modalHtml += "</br>";
                modalHtml += "</br>";
                if(hasalreadylike){
                    modalHtml += "<a href='/activities/unlike/" + id + "'>"  + "<button type='button' class='btn btn-sm btn-outline-success'>Registered</button></a>"
                }else{
                    modalHtml += "<a href='activities\\like\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Register</button></a>";
                }if(perms === 1){
                    modalHtml += "<a href='activities\\edit\\" + id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button></a>";
                    modalHtml += "<a href='activities\\delete\\"+ id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Delete</button></a>";
                     modalHtml += "<a href='activities\\download_users\\"+ id + "'> <button type='button' class='btn btn-sm btn-outline-secondary'>Download</button></a>";
                     modalHtml += "<a href='\\activities\\report\\"+id+"'><button type='button' class='btn btn-sm btn-outline-secondary'>Report</button>"
                }else if(perms === 2){
                    modalHtml += "<a href='\\activities\\download_users\\"+id+"'><button type='button' class='btn btn-sm btn-outline-secondary'>Download User registered</button>"
                    modalHtml += "<a href='\\activities\\report\\"+id+"'><button type='button' class='btn btn-sm btn-outline-secondary'>Report</button>"
                }

                modalHtml += "</span></div></div></div></div></div>";
                $('body').append(modalHtml).fadeIn(2500);
            }
        }
    };

});
