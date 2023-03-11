function delete_user(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Deleted Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}

function restore_user(url,id){
    $.ajax(
        {
            url: url,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Restore',
                    text: 'Item Restores Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}
function delete_user_Permanent(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Permanent Deleted.',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}
function delete_support(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Deleted Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}

function restore_support(url,id){
    $.ajax(
        {
            url: url,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Restore',
                    text: 'Item Restores Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}
function delete_support_Permanent(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Permanent Deleted.',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}

function delete_language(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Deleted Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}

function restore_language(url,id){
    $.ajax(
        {
            url: url,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Restore',
                    text: 'Item Restores Successfully',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}
function delete_language_Permanent(url,id){
    $.ajax(
        {
            url: url,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#utable').dataTable().fnDraw();
                new PNotify({
                    title: 'Item Deleted',
                    text: 'Item Permanent Deleted.',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
            },
            error: function (data) {
                console.log("error");
            }
        });

}
