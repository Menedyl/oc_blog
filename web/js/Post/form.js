$(document).ready(function () {

    var images = $('.image');

    var $formImage = $("div#appbundle_post_images");
    var indexImage = images.length;


    if (indexImage < 1) {
        addImage($formImage);
    }

    if (indexImage > 1) {
        images.each(function (index) {
            if (index > 0) {
                addDeleteLink($(this), true);
            }
        });
    }

    $("#add_image").click(function () {
        addImage($formImage);
        return false;
    });


    function addImage($formImage) {


        var fieldsImage = $formImage.attr("data-prototype")
            .replace(/__name__/g, indexImage + 1);


        var $fieldsImage = $(fieldsImage);


        $formImage.append($fieldsImage);

        if (indexImage !== 0) {
            addDeleteLink($fieldsImage);
        }


        indexImage++;
    }


    function addDeleteLink($fields, add) {

        var $deleteLink = $('<a href="#" class="btn btn-danger del_field">Supprimer</a>');

        if (!add) {
            $fields.children().append($deleteLink);
        } else {
            $fields.append($deleteLink);
        }

        $deleteLink.click(function () {
            $fields.remove();
            return false;
        });
    }


})
;