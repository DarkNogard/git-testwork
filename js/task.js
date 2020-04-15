$(document).ready(function(){
    employeeData = $('#employeeList').DataTable({
        "responsive": true,
        "lengthChange": false,
        "processing":true,
        "serverSide":true,
        "bFilter": false,
        "order":[],
        "ajax":{
            url:"/ajax",
            type:"POST",
            data:{action:'listEmployee'},
            dataType:"json"
        },
        "columnDefs":[
            {
                "targets":[0, 3, 5, 6],
                "orderable":false,
            },
        ],
        "pageLength": 10,
        "language": {
            "processing": "<img src='http://www.sarabitravel.com/loading.gif' width='80px' style='margin-top: 40px'>",
            "lengthMenu": "Показать _MENU_ записей",
            "info": "Показано с _START_ по _END_ из _TOTAL_ записей",
            "infoEmpty": "Нет записей",
            "infoFiltered": "",
            "infoPostFix": "",
            "loadingRecords": "Загрузка записей...",
            "zeroRecords": "Извините - ничего не найдено",
            "emptyTable": "В таблице отсутствуют данные",
            "paginate": {
                "first": "Первая",
                "previous": "&#60;",
                "next": "&#62;",
                "last": "Последняя"
            },
        }
    });


    $('#addEmployee').click(function(){
        $('#employeeModal').modal('show');
        $('#employeeForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Добавить задание");
        $('#action').val('addEmployee');
        $('#save').val('Сохранить');
    });
    $("#employeeList").on('click', '.update', function(){
        var taskId = $(this).attr("id");
        var action = 'getEmployee';
        $.ajax({
            url:'/ajax',
            method:"POST",
            data:{taskId:taskId, action:action},
            dataType:"json",
            success:function(data){
                $('#employeeModal').modal('show');
                $('#taskId').val(data.id);
                $('#taskAuthor').val(data.author);
                $('#taskEmail').val(data.email);
                $('#taskStatus').val(data.status);
                $('#taskDescription').val(data.description);
                $('.modal-title').html("<i class='fa fa-plus'></i> Редактирование задачи");
                $('#action').val('updateEmployee');
                $('#save').val('Сохранить');
            }
        })
    });
    $("#employeeModal").on('submit','#employeeForm', function(event){
        event.preventDefault();
        $('#save').attr('disabled','disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"/ajax",
            method:"POST",
            data:formData,
            success:function(data){
                $('#employeeForm')[0].reset();
                $('#employeeModal').modal('hide');
                $('#save').attr('disabled', false);
                if(data==='error'){
                    error();
                } else {
                    employeeData.ajax.reload();
                    success();
                }
            }
        })
    });
    $("#employeeList").on('click', '.delete', function(){
        var taskId = $(this).attr("id");
        var action = "empDelete";
        if(confirm("Вы уверены, что хотите удалить это задание?")) {
            $.ajax({
                url:"/ajax",
                method:"POST",
                data:{taskId:taskId, action:action},
                success:function(data) {
                    if(data==='error'){
                        error();
                    } else {
                        employeeData.ajax.reload();
                    }
                }
            })
        } else {
            return false;
        }
    });

    $("#exit").on('click', function(){
        $.ajax({
            url:"/login",
            method:"POST",
            data:{action:'exit'},
            success:function() {
                location.replace(location.href);
            }
        })
    })

    function success() {
        var action = $("#action").val();
        if(action==='updateEmployee') {$("#success-alert").html("Задание успешно обновлено");}
        else if
        (action==='addEmployee') {$("#success-alert").html("Задание успешно добавлено");}
        $("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    }

    function error() {
        $("#alert-danger").fadeTo(3000, 500).slideUp(500, function(){
            $("#alert-danger").slideUp(500);
        });
    }

});