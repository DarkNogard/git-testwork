<?php

class Controller_Ajax extends Controller
{

	function __construct()
	{
		$this->model = new Model_Ajax();
		$this->view = new View();
	}

    function action_index()
    {


        if(!empty($_POST['action']) && $_POST['action'] == 'listEmployee') {
            $this->model->employeeList();
        }
        if(!empty($_POST['action']) && $_POST['action'] == 'addEmployee') {
            $this->model->addEmployee();
        }
        if(!empty($_POST['action']) && $_POST['action'] == 'getEmployee') {
            $this->model->getEmployee();
        }
        if(!empty($_POST['action']) && $_POST['action'] == 'updateEmployee') {
            $this->model->updateEmployee();
        }
        if(!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
            $this->model->deleteEmployee();
        }

        $this->view->generate('ajax_view.php', 'ajax_view.php');

    }
}
