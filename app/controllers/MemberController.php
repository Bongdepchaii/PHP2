<?php


class MemberController extends Controller
{
    public function index()
    {
        $member = $this->model('member');
        // phan trang
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 3;

        if (isset($_GET['q']) && trim($_GET['q']) !== '') {
            $keyword = trim($_GET['q']);
            $data = $member->search($keyword, $page, $perPage);
            $totalCount = $member->getTotalCount($keyword);
        } else {
            $keyword = '';
            $data = $member->all($page, $perPage);
            $totalCount = $member->getTotalCount();
        }

        $totalPage = ceil($totalCount / $perPage);

        $title = "Quản lí thành viên";
        $this->view("members/index", [
            'title' => $title,
            'members' => $data,
            'page' => $page,
            'totalPage' => $totalPage,
            'keyword' => $keyword
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gen = trim($_POST['gen']);
            $name = trim($_POST['name']);
            $branch = trim($_POST['branch']);
            $birth = trim($_POST['birth']);
            $death = trim($_POST['death']);
            $spouse = trim($_POST['spouse']);
            $father = trim($_POST['father_id']);
            $note = trim($_POST['note']);

            // upload image
            $img = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $uploadDir = 'app/images/img/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $img = $fileName;
                }
            }

            if (!empty($name)) {
                $member = $this->model('member');
                $member->create(array(
                    'gen' => $gen,
                    'name' => $name,
                    'branch' => $branch,
                    'birth' => $birth,
                    'death' => $death,
                    'spouse' => $spouse,
                    'father_id' => $father,
                    'note' => $note,
                    'img' => $img,
                ));
                $_SESSION['success'] = "Thêm thành viên mới thành công";
                $this->redirect('/member');
            }
        }
        $_SESSION['error'] = "Thêm thành viên thất bại! Vui lòng kiểm tra lại thông tin.";
        $this->redirect('/member');
    }

    // update
    public function edit($id)
    {
        $member = $this->model('member');
        $data = $member->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("members/edit", [
                'member' => $data
            ]);
        } else {
            $gen = trim($_POST['gen']);
            $name = trim($_POST['name']);
            $branch = trim($_POST['branch']);
            $birth = trim($_POST['birth']);
            $death = trim($_POST['death']);
            $spouse = trim($_POST['spouse']);
            $father = trim($_POST['father_id']);
            $note = trim($_POST['note']);

            $img = $data['img'];

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $uploadDir = 'app/images/img/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $img = $fileName;
                }
            }


            if (!empty($name)) {
                $memberModel = $this->model('member');
                $isSuccess = $memberModel->update(
                    array(
                        'gen' => $gen,
                        'name' => $name,
                        'branch' => $branch,
                        'birth' => $birth,
                        'death' => $death,
                        'spouse' => $spouse,
                        'father_id' => $father,
                        'note' => $note,
                        'img' => $img,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "upadted successful";
                }
                $this->redirect('/member');
            }
        }
    }

    public function delete($id)
    {
        $member = $this->model('member');
        $isSuccess = $member->delete($id);
        if ($isSuccess) {
            $_SESSION['success'] = "Xoá thành công";
        } else {
            $_SESSION['error'] = "Xoá thất bại";
        }
        $this->redirect('/member');
    }
}
