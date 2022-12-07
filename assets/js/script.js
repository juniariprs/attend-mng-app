$('.btn-edit-hour').click(function() {
    let dataEncode = atob($(this).attr('data-hour'));
    let dataHour = $.parseJSON(dataEncode);
    
    $('#edit-description').text(dataHour.description);
    $('#edit-id').val(dataHour.hour_id);
    $('#edit-start').val(dataHour.start);
    $('#edit-finished').val(dataHour.finished);
});

$('#form-edit-hour').submit(function() {
    let form = document.getElementById('form-edit-hour');
    let url = $(this).attr('action');
    let data = new FormData(form);

    let dataReturn = sendAjax(url, data);
    let targetParent = $('#hour-' + dataReturn.hour_id);
    targetParent.find('.hour-start').text(dataReturn.start);
    targetParent.find('.hour-finished').text(dataReturn.finished);
    targetParent.find('a.btn-edit-hour').attr('data-hour', btoa(JSON.stringify(dataReturn)));

    $('#edit-hour').modal('hide');
}); 

$()