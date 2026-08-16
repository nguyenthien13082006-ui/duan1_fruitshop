<?php


class AdminNhaCungCapController
{
    public $modelNhaCungCap;
    public function __construct()
    {
        $this->modelNhaCungCap = new AdminNhaCungCap();
    }

    public function danhSachNhaCungCap()
    {
        $listNhaCungCap = $this->modelNhaCungCap->getAllNhaCungCap();
        require_once './views/nhacungcap/listNhaCungCap.php';
    }

    //Phần thêm mới nhà cung cấp
    public function formAddNhaCungCap()
    {
        require_once './views/nhacungcap/addNhaCungCap.php';
    }

    public function postAddNhaCungCap()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nha_cung_cap = trim($_POST['ten_nha_cung_cap']);
            $dia_chi = trim($_POST['dia_chi']);
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $mo_ta = trim($_POST['mo_ta']);

            $errors = [];
            if (empty($ten_nha_cung_cap)) {
                $errors['ten_nha_cung_cap'] = 'Tên nhà cung cấp không được để trống';
            }

            if (empty($errors)) {
                $this->modelNhaCungCap->insertNhaCungCap($ten_nha_cung_cap, $dia_chi, $so_dien_thoai, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=nha-cung-cap');
                exit();
            } else {
                require_once './views/nhacungcap/addNhaCungCap.php';
            }
        }
    }

    //Phần sửa nhà cung cấp
    public function formEditNhaCungCap()
    {
        $id = $_GET['id_nha_cung_cap'];
        $nhaCungCap = $this->modelNhaCungCap->getDetailNhaCungCap($id);
        if ($nhaCungCap) {
            require_once './views/nhacungcap/editNhaCungCap.php';
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=nha-cung-cap');
            exit();
        }
    }

    public function postEditNhaCungCap()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_nha_cung_cap'];
            $ten_nha_cung_cap = trim($_POST['ten_nha_cung_cap']);
            $dia_chi = trim($_POST['dia_chi']);
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $mo_ta = trim($_POST['mo_ta']);

            $errors = [];
            if (empty($ten_nha_cung_cap)) {
                $errors['ten_nha_cung_cap'] = 'Tên nhà cung cấp không được để trống';
            }

            if (empty($errors)) {
                $this->modelNhaCungCap->updateNhaCungCap($id, $ten_nha_cung_cap, $dia_chi, $so_dien_thoai, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=nha-cung-cap');
                exit();
            } else {
                $nhaCungCap = [
                    'id' => $id,
                    'ten_nha_cung_cap' => $ten_nha_cung_cap,
                    'dia_chi' => $dia_chi,
                    'so_dien_thoai' => $so_dien_thoai,
                    'mo_ta' => $mo_ta
                ];
                require_once './views/nhacungcap/editNhaCungCap.php';
            }
        }
    }

    //Phần xóa nhà cung cấp - Business rule: không được xóa nếu vẫn còn sản phẩm thuộc nhà cung cấp đó
    public function deleteNhaCungCap()
    {
        $id = $_GET['id_nha_cung_cap'];
        $nhaCungCap = $this->modelNhaCungCap->getDetailNhaCungCap($id);
        if ($nhaCungCap) {
            $soLuongSanPham = $this->modelNhaCungCap->countSanPhamTheoNhaCungCap($id);
            if ($soLuongSanPham > 0) {
                $_SESSION['error_message'] = 'Không thể xóa nhà cung cấp này vì vẫn còn ' . $soLuongSanPham . ' sản phẩm thuộc nhà cung cấp. Vui lòng chuyển sản phẩm sang nhà cung cấp khác trước khi xóa.';
            } else {
                $this->modelNhaCungCap->destroyNhaCungCap($id);
            }
            header('location: ' . BASE_URL_ADMIN . '?act=nha-cung-cap');
            exit();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=nha-cung-cap');
            exit();
        }
    }
}
