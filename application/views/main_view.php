<div class="panel-heading">
    <div class="row">
        <div class="col-md-10">
            <h3 class="panel-title"></h3>
        </div>
        <div class="col-md-2" align="right">
            <button type="button" name="add" id="addEmployee" class="btn btn-success btn-xs">Добавить задачу</button>
        </div>
    </div>
</div>

<table id="employeeList" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя пользователя</th>
        <th>Email</th>
        <th>Текст задачи</th>
        <th>Статус</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
</table>


<!-- Modal edit/add/delete-->

<div id="employeeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="employeeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" id="employeeForm" class="col-12">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group"
                    <label for="taskAuthor" class="control-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="taskAuthor" name="taskAuthor" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="taskEmail" class="control-label">Email</label>
                    <input type="email" class="form-control" id="taskEmail" name="taskEmail" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription" class="control-label">Текст задачи</label>
                    <textarea class="form-control" rows="5" id="taskDescription" name="taskDescription" required></textarea>
                </div>
                <?php if($_SESSION['login']){ ?>
                    <div class="form-group">
                        <label for="taskStatus" class="control-label">Статус</label>
                        <select class="form-control" name="taskStatus" id="taskStatus">
                            <option value="0"></option>
                            <option value="1">Выполнено</option>
                        </select>
                    </div>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="taskId" id="taskId" />
                <input type="hidden" name="action" id="action" value="" />
                <input type="submit" name="save" id="save" class="btn btn-info" value="" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
    </div>
    </form>
</div>
</div>

<div class="alert alert-success" id="success-alert">
    <strong>Success! </strong> Product have added to your wishlist.
</div>

<div class="alert alert-danger" id="alert-danger">
    <strong>Ошибка!</strong> Функция не доступна.
</div>
<script>
    $(document).ready(function() {
        <?php if($_SESSION['login']){ ?>
        employeeData.columns([0]).visible(false);
        <?php } else { ?>
        employeeData.columns([0, 5, 6]).visible(false);
        <?php } ?>
    });
</script>
