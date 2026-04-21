<?php
$_SESSION['user'] = [
    'id' => 1
];

class CartController
{

    protected $cartModel;

    public function __construct($cartModel)
    {
        $this->cartModel = $cartModel;
    }

    // THÊM GIỎ HÀNG
    public function add()
    {
        $user_id = $_SESSION['user']['id'] ?? null;


        if (!$user_id) {
            header("Location: login.php");
            exit;
        }

        $qty = $_POST['qty'] ?? 1;

        $product_id = $_POST['product_id'] ?? $_GET['id'] ?? null;
        $qty = $_POST['qty'] ?? 1;

        if ($product_id) {
            $this->cartModel->addToCart($user_id, $product_id, $qty);
        }

        header("Location: index.php?page=cart");
        exit;
    }

    public function update()
    {
        $user_id = $_SESSION['user']['id'];

        if (!isset($_POST['qty'])) {
            header("Location: index.php?page=cart");
            exit;
        }

        foreach ($_POST['qty'] as $id => $qty) {
            $qty = (int)$qty;

            if ($qty > 0) {
                $this->cartModel->update($qty, $id, $user_id);
            } else {
                $this->cartModel->delete($id); // cũng nên thêm user_id
            }
        }

        header("Location: index.php?page=cart");
        exit;
    }

    // HIỂN THỊ GIỎ HÀNG
    public function index()
    {

        $user_id = $_SESSION['user']['id'];




        // DELETE
        if (isset($_GET['delete'])) {
            $this->cartModel->delete($_GET['delete']);
        }

        $cartItems = $this->cartModel->getAll($user_id);

        require "Client/View/Pages/Cart.php";
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            die('Thiếu id');
        }

        $id = (int)$_GET['id'];

        // Xóa trong DB
        $this->cartModel->delete($id);

        // Redirect lại giỏ hàng
        header("Location: index.php?page=cart");
        exit;
    }

    

    
}
