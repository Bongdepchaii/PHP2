<?php

class RomController extends Controller
{
    public function index()
    {
        $rom = $this->model('rom');
        $data = $rom->all();
        $title = "Quản lí bộ nhớ";
        $this->view("products/rom", [
            'title' => $title,
            'roms' => $data
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            // var_dump($_POST);
            // var_dump($name);

            if (!empty($name)) {
                $rom = $this->model('rom');
                $rom->create(array(
                    'name' => $name
                ));
                $this->redirect('/rom');
            }
        }
        $this->redirect('/rom');
    }
    public function update($id)
    {
        $rom = $this->model('rom');
        $data = $rom->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("products/color/edit", [
                'color' => $data
            ]);
        } else {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $rom = $this->model('rom');
                $isSuccess = $rom->update(
                    array(
                        'name' => $name,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "upadted successful";
                }
                $this->redirect('/rom');
            }
        }
    }
    public function delete($id)
    {
        $rom = $this->model('rom');
        $isSuccess = $rom->delete($id);
        if ($isSuccess) {
            $_SESSION['success'] = "delete successful";
        }
        $this->redirect('/rom');
    }
}