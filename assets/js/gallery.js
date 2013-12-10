
var file_is_new = [];

// Ajax File Delete from Gallery Album
$('.remove-file').livequery('click', function(e){
    e.preventDefault();

    if(false == confirm("Are you sure you want to delete ?")) {
        return false;
    }

    var parent = $(this).parent(),
        li = $(parent).parent().parent(),
        key = $(this).data('key');

    // Check new add element or not
    if (typeof key == 'undefined') {
        removeContiner(li);
        return false;
    }

    $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        beforeSend: function() {
            $(parent).append('<span id="waiting" class="ax-loading">Loading...</span>');
        },
        complete: function() {
            $('#waiting').remove();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#waiting').html(errorThrown).addClass('ax-error');
        },
        success: function(data) {
            //console.log(data);
            if (data.status == 'success') {
                removeContiner(li);
            } else {
                $(parent).append('<span id="waiting" class="ax-loading ax-error">Try Again!</span>');
                //$('#waiting').html(data.message).addClass('ax-error');
            }
        }
    });

});

// Remove Image "li" element
function removeContiner(ele) {
    $(ele).fadeOut('800', function(){
        $(this).remove();
    });
}

