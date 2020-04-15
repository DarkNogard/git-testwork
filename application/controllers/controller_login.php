<?php

class Controller_Login extends Controller
{

    function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index()
    {
        if(isset($_POST['login']) && isset($_POST['password']))
        {

            $data = $this->model->successLogin();
            if($data) {
                header('Location: /');
                $data["login_status"] = "access_granted";
            } else {
                $data["login_status"] = "access_denied";
            }
        }
        else
        {
                $data["login_status"] = "";
        }
        if(isset($_POST['action'])) {
            session_start();
            session_unset();
        }


        $this->view->generate('login_view.php', 'template_view.php', $data);
    }

}
