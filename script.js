$(function() {
    $(".draggable").draggable({
        helper: "clone"
    });

    $("#canvas").droppable({
        accept: ".draggable",
        drop: function(event, ui) {
            let type = ui.helper.data("type");
            let newElement;

            switch (type) {
                case "text":
                    newElement = $('<input type="text" placeholder="Text Field" class="dropped">');
                    break;
                case "checkbox":
                    newElement = $('<input type="checkbox" class="dropped">');
                    break;
                case "button":
                    newElement = $('<button class="dropped">Button</button>');
                    break;
            }

            newElement.css({
                position: 'absolute',
                top: ui.offset.top - $(this).offset().top,
                left: ui.offset.left - $(this).offset().left
            });

            $("#canvas").append(newElement);
        }
    });

    $("#canvas").on("click", ".dropped", function() {
        $(this).attr("contenteditable", "true");
    });
});
