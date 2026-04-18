<?php
$products = $product->getAll();
?>

<div style="display:flex; flex-wrap:wrap; gap:20px; justify-content: flex-start;">
<?php foreach($products as $item): ?>

<div style="width:23%; border:1px solid #ddd; padding:15px; border-radius:10px; display: flex; flex-direction: column;">
    
    <img src="assets/img/product/<?= $item['images'] ?>" 
         style="width:100%; height:200px; object-fit:cover; margin-bottom: 10px;">

    <h4 style="font-size: 18px; margin: 10px 0; height: 50px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
        <?= $item['title'] ?>
    </h4>

    <p style="color:red; font-weight:bold; margin-bottom: 15px;">
        <?= number_format($item['price']) ?> đ
    </p>

    <div style="margin-top: auto; display: flex; gap: 5px;">
        <a href="index.php?page=detail&id=<?= $item['id'] ?>" 
           class="btn btn-sm btn-primary" style="flex: 1; text-align: center;">Xem</a>

        <a href="index.php?page=cart&id=<?= $item['id'] ?>" 
           class="btn btn-sm btn-success" style="flex: 1; text-align: center;">Thêm</a>
    </div>
</div>

<?php endforeach; ?>
</div>