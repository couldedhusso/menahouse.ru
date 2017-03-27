
$(document).ready(function () {

    var $grid = $('.img-grid').masonry({
        itemSelector: '.grid-item',
        // columnWidth: 160

        IsAnimated: true,
        itemSelector: '.grid-item',
        // columnWidth: 250
    });


    $grid.on('click', '.grid-item', function () {

        $grid.find('.grid-item--gigante').removeClass('grid-item--gigante');
        // change size of item via class
        $(this).toggleClass('grid-item--gigante');

        // trigger layout
        $grid.masonry();
    });

});
