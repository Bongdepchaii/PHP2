<?php

class ColorController extends Controller
{
    public function index()
    {
        $color = $this->model('color');
        $data = $color->all();
        $title = "Quản lí màu sắc";
        $this->view("products/color", [
            'title' => $title,
            'colors' => $data
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            // var_dump($_POST);
            // var_dump($name);

            if (!empty($name)) {
                $color = $this->model('color');
                $color->create(array(
                    'name' => $name
                ));
                $_SESSION['success'] = "add successful";
                $this->redirect('/color');
            }
        }
        $_SESSION['error'] = "add failed";
        $this->redirect('/color');
    }
    public function update($id)
    {
        $color = $this->model('color');
        $data = $color->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("products/color/edit", [
                'color' => $data
            ]);
        } else {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $color = $this->model('color');
                $isSuccess = $color->update(
                    array(
                        'name' => $name,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "upadted successful";
                }
                $this->redirect('/color');
            }
        }
    }
    public function delete($id)
    {
        $color = $this->model('color');
        $isSuccess = $color->delete($id);
        if ($isSuccess) {
            $_SESSION['success'] = "delete successful";
        }
         $this->redirect('/color');
    }
}