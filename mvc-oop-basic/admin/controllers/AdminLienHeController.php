<?php

class AdminLienHeController
{
    public $modelLienHe;

    public function __construct()
    {
        $this->modelLienHe = new LienHe();
    }

    public function danhSachLienHe()
    {
        $listLienHe = $this->modelLienHe->getAllLienHe();
        require_once './views/lienhe/listLienHe.php';
    }

    public function chiTietLienHe()
    {
        $id = $_GET['id'] ?? null;
        $lienHe = $this->modelLienHe->getLienHeById($id);
        require_once './views/lienhe/detailLienHe.php';
    }

    public function postPhanHoiLienHe()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL_ADMIN . '?act=lien-he');
            exit();
        }

        $id = $_POST['id'] ?? null;
        $phan_hoi = $_POST['phan_hoi'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? 'Đã trả lời';

        if ($id) {
            $this->modelLienHe->updatePhanHoi($id, $phan_hoi, $trang_thai);
        }

        header('Location: ' . BASE_URL_ADMIN . '?act=lien-he');
        exit();
    }
}
