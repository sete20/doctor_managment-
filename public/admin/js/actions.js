// ADD FORM
$('#form').on('submit',function(e) {

    e.preventDefault();

    tinyMCE.triggerSave();

    var url     = $(this).attr('action');
    var method  = $(this).attr('method');

    $.ajax({

        xhr: function() {
        var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);
                $('.progress-bar').width(percentComplete+'%');
                $('#progress-status').html(percentComplete+'%');
              }
            }, false);
            return xhr;
        },

        url: url,
        type: method,
        dataType: 'JSON',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,

        beforeSend : function(){
                $('#submit').prop('disabled',true);
                $('.progress-info').show();
                $('.progress-bar').width('0%');
                resetErrors();
            },
        success:function(data){

            $('#submit').prop('disabled',false);
            $('#submit').text();

            if (data[0] == true){
                successfully(data);
                resetForm();
                resetErrors();
            }else{
                displayMissing(data);
            };

        },
       error: function(data){

         $('#submit').prop('disabled',false);
         displayErrors(data);

        },
    });

});

// Update
$('#updateForm').on('submit',function(e) {

    e.preventDefault();
    tinyMCE.triggerSave();

    var url     = $(this).attr('action');
    var method  = $(this).attr('method');

    $.ajax({

        xhr: function() {
        var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);
                $('.progress-bar').width(percentComplete+'%');
                $('#progress-status').html(percentComplete+'%');
              }
            }, false);
            return xhr;
        },

        url: url,
        type: method,
        dataType: 'JSON',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,

        beforeSend : function(){
                $('#submit').prop('disabled',true);
                $('.progress-info').show();
                $('.progress-bar').width('0%');
                resetErrors();
            },
        success:function(data){
          $('#submit').prop('disabled',false);
          $('#submit').text();

          if (data[0] == true){
              successfully(data);
          }else{
              displayMissing(data);
          };
        },
       error: function(data){
         $('#submit').prop('disabled',false);
         displayErrors(data);
        },
    });

});

// Alerts & Others
function displayErrors(data)
{
    console.log($.parseJSON(data.responseText));

    var getJSON = $.parseJSON(data.responseText);

    jQuery.each(getJSON.errors, function(index, value)
    {
        if (value.length !== 0){
            $('[data-name="'+index+'"]').parent().addClass('has-error');
            $('[data-name="'+index+'"]').closest('.form-group').find('.help-block').html(value);
        }
    });

    var output= "<div class='alert alert-danger'><ul>";
    for (var error in getJSON.errors){
        output += "<li>" + getJSON.errors[error] + "</li>";
    }
    output += "</ul></div>";

   $('#result').slideDown('fast', function(){
        $('#result').html(output);
        $('.progress-info').hide();
        $('.progress-bar').width('0%');
    }).delay(5000).slideUp('slow');

    $('.progress-info').hide();
    $('.progress-bar').width('0%');
}

function displayMissing(data)
{
    console.log(data);
    toastr["error"](data[1]);
    $('.progress-info').hide();
    $('.progress-bar').width('0%');
    $('#kt_table_1').DataTable().ajax.reload();
}

function successfully(data)
{
    toastr["success"](data[1]);
    $('.progress-info').hide();
    $('.progress-bar').width('0%');
    $('#dataTable').DataTable().ajax.reload();

}

function resetForm()
{
    // Clear Inputs
    $('.form-control').each(function() {
        $(this).val('');
    });

    // Clear tinyMCE Editor
    $('textarea').each(function(k, v) {
        tinyMCE.get(k).setContent('');
    });

    // Clear Select2
    $(".select2").select2();
}

function resetErrors()
{
    $('.has-error').each(function() {
        $(this).removeClass('has-error');
    });

    $('.help-block').each(function() {
        $(this).text('');
    });
}

// DATATABLE
function CheckAll()
{
  var isChecked = $('input[name=ids]').first().prop('checked');
  $('input[name=ids]').prop('checked', ! isChecked );
}

function getFormData($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

$(document).ready(function(){

    $('#search').click(function(){

        var $form = $("#formFilter");
        var data = getFormData($form);

        console.log(data);
        $('#dataTable').DataTable().destroy();

        tableGenerate(data);

    });

    $('.filter-cancel').click(function(){

        document.getElementById("formFilter").reset();

        $('#dataTable').DataTable().destroy();

        $('.select2').val(null).trigger('change');

        tableGenerate();

    });
});
