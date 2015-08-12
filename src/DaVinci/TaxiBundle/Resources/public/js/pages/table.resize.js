require(['jquery'], function () {
    $(document).ready(function () {

        var switched = false;
        var updateTables = function () {
        // //     // if (($(window).width() < 760) && !switched) {
        // //     //     switched = true;
        // //     //     $("table.responsive").each(function (i, element) {
        // //     //         splitTable($(element));
        // //     //     });
        // //     //     return true;
        // //     // }
        // //     // else if (switched && ($(window).width() > 760)) {
        // //     //     switched = false;
        // //     //     $("table.responsive").each(function (i, element) {
        // //     //         unsplitTable($(element));
        // //     //     });
        // //     // }
            if (($(window).width() < 760) && !switched) {
                switched = true;
                $("table.responsive").each(function (i, element) {
                    splitTable($(element));
                });
                return true;
            }
            else if (switched && ($(window).width() > 760)) {
                switched = false;
                $("table.responsive").each(function (i, element) {
                    unsplitTable($(element));
                });
            }
        };


        function splitTable(original)
        {
            original.wrap("<div class='table-wrapper' />");

            var copy = original.clone();
            copy.find("td:not(:last-child), th:not(:last-child)").css("display", "none");
            copy.removeClass("responsive");

            original.closest(".table-wrapper").append(copy);
            copy.wrap("<div class='pinned' />");
            original.wrap("<div class='scrollable' />");

            setCellHeights(original, copy);
        }
        ;

        function unsplitTable(original) {
            original.closest(".table-wrapper").find(".pinned").remove();
            original.unwrap();
            original.unwrap();
        }
        ;

        function setCellHeights(original, copy) {
            var tr = original.find('tr'),
                    tr_copy = copy.find('tr'),
                    heights = [];

            tr.each(function (index) {
                var self = $(this),
                        tx = self.find('td');

                tx.each(function () {
                    var height = $(this).outerHeight(true);
                    heights[index] = heights[index] || 0;
                    if (height > heights[index] && index > 1)
                        heights[index] = height;
                });

            });

            tr_copy.each(function (index) {
                $(this).height(heights[index]);
            });
        }
        ;

        if ($(window).width() < 760) {
                switched = true;
                $("table.responsive").each(function (i, element) {
                    splitTable($(element));
                });
        }

        $(window).load(updateTables);
        // $(window).on("redraw", function () {
        //     switched = false;
        //     updateTables();
        // }); // An event to listen for
        $(window).on("resize", updateTables);

    });
});