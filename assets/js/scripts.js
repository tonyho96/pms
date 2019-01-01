var isAutoLoad = false;
function printLabel() {
    $("#showgrid-container").print({
        globalStyles: true,
        mediaPrint: true,
        stylesheet: null,
        noPrintSelector: ".no-print",
        iframe: true,
        append: null,
        prepend: null,
        manuallyCopyFormValues: true,
        deferred: $.Deferred(),
        timeout: 750,
        title: '',
        doctype: '<!doctype html>'
    });
}
function reRenderSlot($obj) {
    var isNull = $obj.data('is-null');
    if (isNull) {
        $obj.html('<a href="#"><u>NULL</u></a>');
        return;
    }

    var project = $obj.data('project-name');
    var unit = $obj.data('unit-name');
    var room = $obj.data('room-name');
    var item = $obj.data('item-name');
    var comment = $obj.data('comment');
    var imageUrl = $obj.data('image-url');


    $obj.html(
        '<a href="#">' +
        '<img src="' + imageUrl + '" style="">' +
        '<p>' + project + '</p>' +
        '<p>' + unit + '</p>' +
        '<p>' + room + '</p>' +
        '<p>' + item + '</p>' +
        '<p>' + comment + '</p>' +
        '</a>'
    );
}

function renderSelectBox($obj, data) {
    var html = "<option selected> -- Select -- </option>";
    for (var id in data) {
        html += "<option value='" + id + "'>" + data[id] + "</option>"
    }
    $obj.html(html);
}

function checkToEnableSubmitButton() {
    if ($('.choose-picture:checked').length) {
        $("#submit-item").removeAttr('disabled');
        $("#save-label").removeAttr('disabled');
    }
    else {
        $("#submit-item").attr('disabled', 'disabled');
        $("#save-label").attr('disabled', 'disabled');
    }

    if ($('#is-null').is(':checked')) {
        $("#submit-item").removeAttr('disabled');
    }
}

function updateLabelList() {
    var actionUrl = 'painttrack/includes/db.php';
    var data = {
        'action-page': 'ajax-get-labels'
    };

    $.post(actionUrl, data, function(response) {
        var labelObj = $('#select-label');
        renderSelectBox(labelObj, response);
    }, 'json');
}

jQuery(document).ready(function($){
    $('#select-project').change(function () {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);

        var unitSelectObj = $('#select-unit');
        unitSelectObj.attr('disabled', 'disabled');

        var projectId = $(this).val();
        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'project-id': projectId,
            'action-page': 'ajax-get-units'
        };

        $.post(actionUrl, data, function (response) {
            renderSelectBox(unitSelectObj, response);
            unitSelectObj.removeAttr('disabled');

            if (isAutoLoad) {
                var unitId = slotObj.data('unit-id');
                $('#select-unit').val(unitId).trigger('change');
            }
        }, 'json');
    });

    $('#select-unit').change(function () {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);

        var roomSelectObj = $('#select-room');
        roomSelectObj.attr('disabled', 'disabled');

        var unitId = $(this).val();
        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'unit-id': unitId,
            'action-page': 'ajax-get-rooms'
        };

        $.post(actionUrl, data, function (response) {
            renderSelectBox(roomSelectObj, response);
            roomSelectObj.removeAttr('disabled');

            if (isAutoLoad) {
                var roomId = slotObj.data('room-id');
                $('#select-room').val(roomId).trigger('change');
            }
        }, 'json');
    });

    $('#select-room').change(function () {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);

        var itemSelectObj = $('#select-item');
        itemSelectObj.attr('disabled', 'disabled');

        var roomId = $(this).val();
        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'room-id': roomId,
            'action-page': 'ajax-get-items'
        };

        $.post(actionUrl, data, function (response) {
            renderSelectBox(itemSelectObj, response);
            itemSelectObj.removeAttr('disabled');

            if (isAutoLoad) {
                var itemId = slotObj.data('item-id');
                $('#select-item').val(itemId).trigger('change');
            }
        }, 'json');
    });

    $('#select-item').change(function () {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);

        $('#picture-list').html('');

        var itemId = $(this).val();
        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'item-id': itemId,
            'action-page': 'ajax-get-item-data'
        };

        $.post(actionUrl, data, function (response) {
            var html = "";
            for (var i = 1; i <= 4; i++) {
                var fieldName = "picture" + i;
                if (response[fieldName] && response[fieldName].length > 0) {
                    html += "<label>" +
                        "   <input type='radio' class='choose-picture choose-picture-"+ i +"' data-picture-pos='"+ i +"' name='choose-picture'>" +
                        "   <img src='"+ response[fieldName] +"' style='height: 100px;width: auto;'>" +
                        "</label>";
                }
            }
            if (!html.length) {
                html = "Empty data";
            }
            $('#picture-list').html(html);
            $('#picture-list').find(".choose-picture:first-child").prop('checked', true);
            if (isAutoLoad) {
                var imagePos = slotObj.data('image-pos');
                $('#picture-list').find(".choose-picture-" + imagePos).prop('checked', true);
            }
            isAutoLoad = false;
            checkToEnableSubmitButton();
        }, 'json');
    });

    $("#submit-item").click(function(e) {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);


        slotObj.data('project-id', $('#select-project').val());
        slotObj.data('project-name', $('#select-project option:selected').html());

        slotObj.data('unit-id', $('#select-unit').val());
        slotObj.data('unit-name', $('#select-unit option:selected').html());

        slotObj.data('room-id', $('#select-room').val());
        slotObj.data('room-name', $('#select-room option:selected').html());

        slotObj.data('item-id', $('#select-item').val());
        slotObj.data('item-name', $('#select-item option:selected').html());

        slotObj.data('comment', $('#comment').val());
        slotObj.data('is-null', $('#is-null').is(':checked'));

        var imageUrl = "";
        var imageSlot = 1;
        var chosenPicture = $('.choose-picture:checked');
        if (chosenPicture.length) {
            imageUrl = chosenPicture.parent().find('img').attr('src');
            imageSlot = chosenPicture.data('picture-pos');
        }

        slotObj.data('image-url', imageUrl);
        slotObj.data('image-pos', imageSlot);

        reRenderSlot(slotObj);
    });

    $('.slot-item').click(function () {
        var $obj = $(this);
        $("#slot-id").val($(this).attr('id'));

        $('#select-unit').html('');
        $('#select-room').html('');
        $('#select-item').html('');
        $('#picture-list').html('');
        $('#comment').html('');

        $("#addLabelModal").modal('show');
        checkToEnableSubmitButton();

        var projectId = $obj.data('project-id');
        var comment = $obj.data('comment');

        $('#select-project').val(-1);
        if (projectId) {
            isAutoLoad = true;
            $('#select-project').val(projectId).trigger('change');
            $('#comment').val(comment);
        }
    });

    $('#is-null').click(function () {
        checkToEnableSubmitButton();
    });

    $('#save-label').click(function () {
        $('#saveLableModel').modal('show');
    });

    $('#save-label-btn').click(function() {
        var name = $('#label-name').val();
        var itemId = $('#select-item').val();
        var imagePos = $('.choose-picture:checked').data('picture-pos');
        var comment = $('#comment').val();

        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'name': name,
            'item-id': itemId,
            'image-pos': imagePos,
            'comment': comment,
            'action-page': 'ajax-save-label'
        };
        $.post(actionUrl, data, function (response) {
            updateLabelList();
        }, 'json');
    });
    
    $('#apply-label-btn').click(function() {
        var slotId = $("#slot-id").val();
        var slotObj = $("#" + slotId);

        var labelId = $('#select-label').val();
        var actionUrl = 'painttrack/includes/db.php';
        var data = {
            'label-id': labelId,
            'action-page': 'ajax-get-label-data'
        };

        $.post(actionUrl, data, function (response) {
            slotObj.data('project-id', response.project_id);
            slotObj.data('project-name', response.project_name);

            slotObj.data('unit-id', response.unit_id);
            slotObj.data('unit-name', response.unit_name);

            slotObj.data('room-id', response.room_id);
            slotObj.data('room-name', response.room_name);

            slotObj.data('item-id', response.item_id);
            slotObj.data('item-name', response.item_name);

            slotObj.data('comment', response.comment);
            slotObj.data('is-null', false);

            slotObj.data('image-url', response.image_url);
            slotObj.data('image-pos', response.image_pos);

            reRenderSlot(slotObj);
        }, 'json');
    });
});


function view() {
    var option = $('#label_types').find(":selected");
    $('#viewtemplate').attr('src', option.data('template-url'));
    $('#viewtemplate').show();
}

$(window).on('load', function() {
    $('#btn-print').prop('disabled', false);
});
