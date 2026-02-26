<?php 


Class MemberController extends Controller {
    public function index() {
        $member = $this->model('member');
        $data = $member->all();
        $title = "Quản lí thành viên";
        $this->view("members/index", [
            'title' => $title,
            'members' => $data
        ]);
    }
}

