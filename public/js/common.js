function saveInfo(url,method,formData){
    let request = $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: formData,
    });
    request.done(function(data) {
        $('#ajaxModal').modal('toggle');
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
        })
    });
    request.fail(function (jqXHR, textStatus, errorThrown) {
        Swal.fire('Failed!', "There was something wrong"+ textStatus, "warning");
    });
}


function deleteInfo(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            let request = $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json',
            });
            request.done(function (data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                );
            });
            request.fail(function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Failed!', "There was something wrong", "warning");
            });
        }
    });
}

function myAjax(url,method,data=''){
    let result = '';
    let request = $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: data,
        async: false
    });
    request.done(function(ret) {
        return result = ret;
    });
    request.fail(function (jqXHR, textStatus, errorThrown) {
        Swal.fire('Failed!', "There was something wrong"+ textStatus, "warning");
    });
    return result;
}


function getRowData(id,column=''){

    let location = window.location.origin + window.location.pathname;
    let url =location+`/${id}`;

    if (column){
        url =location+`/${id}/edit/${column}`;
    }

    return myAjax(url, 'GET');
}

