
//Add Employee form
$('body').on('submit', '#formAddEmployee', function(e) {
    e.preventDefault();
    employeeAction(this);
});

//Edit Employee form
$('body').on('submit', '#formEditEmployee', function(e) {
    e.preventDefault();
    employeeAction(this);
});

function employeeAction(elm) {
    $("#response_message").html('');

    $.ajax({
        url: $(elm).attr('action'),
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        data: $(elm).serialize(),
        success: function(response) {
            $("#response_message").html('<div class="alert alert-success">'+ response.message +'</div>');
            setTimeout(function() { location.reload(); }, 3000);
        },
        error: function(err){
            $("#response_message").html('<div class="alert alert-danger">'+ err.responseJSON.message +'</div>');
        }
    });
}