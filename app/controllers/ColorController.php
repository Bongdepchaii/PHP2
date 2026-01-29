<?php

class ColorController extends Controller
{
    public function index()
    {
        $colorModel = $this->model('Color');
        $data = $colorModel->all();
        $title = "Quản lí màu sắc";
        // $colorModel->update(
        //     array(
        //         'name' => 'test' . mt_rand(1, 100),
        //     ),
        //     1
        // );
        $this->view("color/index", [
            'title' => $title,
            'colors' => $data
        ]);
    }

    public function create()
    {
        $this->view('color/add');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            var_dump($_POST);
            var_dump($name);

            if (!empty($name)) {
                $colorModel = $this->model('color');
                $colorModel->create(array(
                    'name' => $name
                ));
                $this->redirect('/color');
            }
        }
        $this->redirect('/color');
    }
    public function update($id)
    {
        $color = $this->model('color');
        $data = $color->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("color/edit", [
                'color' => $data
            ]);
        } else {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $colorModel = $this->model('color');
                $isSuccess = $colorModel->update(
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
        header('location: /color');
    }
}