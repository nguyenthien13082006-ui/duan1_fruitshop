<?php


class AdminDanhMucController
{
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    //Phần thêm mới danh mục
    public function formAddDanhMuc()
    {
        require_once './views/danhmuc/addDanhMuc.php';
    }
    public function postAddDanhMuc()
    {
        //Kiểm xem dữ liệu có được submit lên hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Lấy ra dữ liệu 
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            //Nếu không có lỗi thì thực hiện thêm mới
            if (empty($errors)) {
                //Nếu có lỗi thì tiến hành thêm danh mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                //Trả về form và lỗi
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }


    //Phần sửa danh mục
    public function formEditDanhMuc()
    {
        //Lấy ra thông tin danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            //Nếu tồn tại thì trả về form sửa danh mục
            require_once './views/danhmuc/editDanhMuc.php';
        } else {
            //Nếu không tồn tại thì chuyển hướng về trang danh sách danh mục
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
    public function postEditDanhMuc()
    {
        //Kiểm xem dữ liệu có được submit lên hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Lấy ra dữ liệu 
            $id = $_POST['id_danh_muc'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            //Nếu không có lỗi thì thực hiện sửa
            if (empty($errors)) {
                //Nếu có lỗi thì tiến hành sửa danh mục
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                //Trả về form và lỗi
                $danhMuc = [
                    'id' => $id,
                    'ten_danh_muc' => $ten_danh_muc,
                    'mo_ta' => $mo_ta
                ];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }

    //Phần xóa danh mục
    public function deleteDanhMuc()
    {
        //Lấy ra thông tin danh mục cần xóa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            //Nếu tồn tại thì tiến hành xóa danh mục
            $this->modelDanhMuc->destroyDanhMuc($id);
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        } else {
            //Nếu không tồn tại thì chuyển hướng về trang danh sách danh mục
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
}
