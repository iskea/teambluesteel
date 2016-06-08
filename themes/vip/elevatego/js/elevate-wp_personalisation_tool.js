/**
 * Elevate WP  v1.0.0
 */

//PRODUCT PAGE - VERTICAL TABS CAROUSEL
$(window).load(function () {

    /* Step 2 - setting maximum selection limit */
    var maxSelection = 3;
    var countMaxed = false;
    var countChecked = function () {
        var n = $(".personalisation-tool input[type=checkbox]:checked").length;
        if (n >= maxSelection) {
            $(".personalisation-tool input[type=checkbox]").not(":checked").attr("disabled", "true").parent().addClass("disabled");
            countMaxed = true;
        }
        else if (n < maxSelection && countMaxed) {
            $(".personalisation-tool input[type=checkbox]").not(":checked").removeAttr("disabled").parent().removeClass("disabled");
        }
    };
    $(".personalisation-tool input[type=checkbox]").on("click", countChecked);

    /* Step 3 - Drag and drop */
    var dragSrcEl = null;

    function handleDragStart(e) {
        this.style.opacity = '0.6';  // this / e.target is the source node.

        dragSrcEl = this;

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault(); // Necessary. Allows us to drop.
        }
        this.classList.add('over');  // this / e.target is previous target element.
        e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

        return false;
    }

    function handleDragEnter(e) {
        // this / e.target is the current hover target.
        this.classList.add('over');
    }

    function handleDragLeave(e) {
        this.classList.remove('over');  // this / e.target is previous target element.
    }

    function handleDrop(e) {
        // this / e.target is current target element.
        this.style.opacity = '1';
        if (e.stopPropagation) {
            e.stopPropagation(); // stops the browser from redirecting.
        }

        // Don't do anything if dropping the same column we're dragging.
        if (dragSrcEl != this) {
            // Set the source column's HTML to the HTML of the column we dropped on.
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
        }
        // alert($(this).html());





        return false;
    }

    function handleDragEnd(e) {
        var priority = 1;
        // this/e.target is the source node.
        this.style.opacity = '1';
        [].forEach.call(cols, function (col) {
            col.classList.remove('over');
        });

        $(".pt-dnd-priority.source").each(function () {
            // variable assignment
            var obj = $(this).find("input[type=checkbox]");
            if($(this).find("input[type=checkbox]").attr("id")!= undefined){
                // alert(obj.attr("id"));
                // alert(obj.attr("id").split("_")[1]);
                obj.attr("id", "q2_" + obj.attr("id").split("_")[1]);
                obj.attr("name", "q2");
                obj.attr("value", "q2_" + obj.attr("id").split("_")[1]);
                obj.attr("checked","true");

            }
        });

        $(".pt-dnd-priority.target").each(function () {
            // variable assignment
            var obj = $(this).find("input[type=checkbox]");
            if($(this).find("input[type=checkbox]").attr("id")!= undefined) {
                // alert(obj.attr("id"));
                // alert(obj.attr("id").split("_")[1]);

                priority = obj.parents('.target').attr("id");
                priority = priority.substr(priority.length - 1);

                obj.attr("id", "p_" + obj.attr("id").split("_")[1]);
                obj.attr("name", "p_" + obj.attr("id").split("_")[1]);
                obj.attr("value", priority);
                obj.attr("checked","true");
            }
        });
    }

    var cols = document.querySelectorAll('.pt-dnd .pt-dnd-priority');
    [].forEach.call(cols, function (col) {
        col.addEventListener('dragstart', handleDragStart, false);
        col.addEventListener('dragenter', handleDragEnter, false)
        col.addEventListener('dragover', handleDragOver, false);
        col.addEventListener('dragleave', handleDragLeave, false);
        col.addEventListener('drop', handleDrop, false);
        col.addEventListener('dragend', handleDragEnd, false);
    });
});

