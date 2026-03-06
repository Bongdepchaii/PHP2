<?php

class BookingController extends Controller
{
    public function index()
    {
        $booking = $this->model('booking'); //
        // $product = new Product();
        $data = $booking->all();
        // var_dump($data);
        $title = "Quản lý booking";
        $this->view("booking/index", [
            'title' => $title,
            'booking' => $data,
        ]);
    }

    // hien thi danh sach booking
    public function booking()
    {
        $booking = $this->model('booking'); //
        // $product = new Product();
        $data = $booking->all();
        // var_dump($data);
        $title = "Danh sách cuộc hẹn";
        $this->view("booking/booking", [
            'title' => $title,
            'booking' => $data,
        ]);
    }

    // Chi tiet booking
    public function detail($id) {
        $bk = $this->model('booking'); //
        // $product = new Product();
        $data = $bk->find($id);
        // var_dump($data);
        $title = "Chi tiết cuộc hẹn";
        $this->view("booking/detail", [
            'title' => $title,
            'bk' => $data,
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $phone = trim($_POST['phone']);
            $date = trim($_POST['date']);
            $time = trim($_POST['time']);

            if (empty($name)) {
                $_SESSION['error'] = "Ten khong duoc de trong";
                $this->redirect('/booking');
            } else if (!preg_match('/^\d{10}$/', $phone)) {
                $_SESSION['error'] = "Dien thoai phai dung 10 chu so";
                $this->redirect('/booking');
            } else if (!$_SESSION['user_id']) {
                $_SESSION['error'] = "Bạn chưa đăng nhập";
                $this->redirect('/auth/login');
            } else {
                $color = $this->model('booking');
                $color->create(array(
                    'name' => $name,
                    'phone' => $phone,
                    'date' => $date,
                    'time' => $time,
                ));
                $_SESSION['success'] = "add successful";
                $this->redirect('/booking');
            }
        }
        $_SESSION['error'] = "Name empty";
        $this->redirect('booking');
    }

    public function edit($id)
    {
        $booking = $this->model('booking');
        $data = $booking->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("booking/edit", [
                'booking' => $data
            ]);
        } else {
            $name = trim($_POST['name']);
            $phone = trim($_POST['phone']);
            $date = trim($_POST['date']);
            $time = trim($_POST['time']);

            if (empty($name)) {
                $_SESSION['error'] = "Ten khong duoc de trong";
                $this->redirect('/booking');
            } else if (!preg_match('/^\d{10}$/', $phone)) {
                $_SESSION['error'] = "Dien thoai phai dung 10 chu so";
                $this->redirect('/booking');
            }

            if (!empty($name)) {
                $memberModel = $this->model('booking');
                $isSuccess = $memberModel->update(
                    array(
                        'name' => $name,
                        'phone' => $phone,
                        'date' => $date,
                        'time' => $time,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "upadted successful";
                }
                $this->redirect('/booking');
            }
        }
    }

    public function delete($id)
    {
        $booking = $this->model('booking');
        $isSuccess = $booking->delete($id);
        if ($isSuccess) {
            $_SESSION['success'] = "deleted successful";
        } else {
            $_SESSION['error'] = "delete failed";
        }
        $this->redirect('/booking');
    }


}
