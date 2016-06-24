// get the project id value from the cookie

var value = "; " + document.cookie;
var parts = value.split("; " + 'proj_id' + "=");
if (parts.length == 2) {
	var proj_id = parts.pop().split(";").shift();
}

$(document).on('submit', "#assign_form", function(e) {
	var person_id = $("#assign_sel").val();
	e.preventDefault();
    ajaxcall_assign('/projects/assign', {
        'proj_id': proj_id,
        'person_id': person_id
    }, function(output) {
		//alert(output);
		$('#content').load('../load.php');
    });
});

function ajaxcall_assign(url, data, callback) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        datatype: 'json',
        success: function(data) {
            callback(data);
        },
 		beforeSend: function() {
			$('#content').html('');
		},
        complete: function() {
            //alert('ajax call complete');
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText); // an error occurred
        }
    });
};

function ajaxcall_remove(url, data, callback) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        datatype: 'json',
        success: function(data) {
            callback(data);
        },
 		beforeSend: function() {
			$('#content').html('');
		},
        complete: function() {
            //alert('ajax call complete');
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText); // an error occurred
        }
    });
};

function go(link) {
	//alert(link.parent().parent().find('td:first').text());
	var person_id = link.parent().parent().find('td:first').text();
    ajaxcall_remove('/projects/assign/remove', {
        'proj_id': proj_id,
        'person_id': person_id
    }, function(output) {
		//alert(output);
		$('#content').load('../load.php');
    });
    return false;
};