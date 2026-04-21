<?php
$categories = $productModel->getAllCategories();
?>

<div class="page-header">
  <h2><i class="fa fa-plus-circle me-2"></i>Thêm sản phẩm mới</h2>
  <a href="?page=products" class="btn-back">
    <i class="fa fa-arrow-left me-1"></i> Quay lại
  </a>
</div>

<div class="form-card">
  <form method="POST" action="?page=create-product" enctype="multipart/form-data">

    <div class="form-grid">

      <!-- Tên sản phẩm -->
      <div class="form-group full">
        <label>Tên sản phẩm <span class="required">*</span></label>
        <input type="text" name="title" class="form-control" placeholder="Nhập tên sản phẩm..." required>
      </div>

      <!-- Danh mục -->
      <div class="form-group">
        <label>Danh mục <span class="required">*</span></label>
        <select name="category_id" class="form-select" required>
          <option value="">-- Chọn danh mục --</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Giá -->
      <div class="form-group">
        <label>Giá (đ) <span class="required">*</span></label>
        <input type="number" name="price" class="form-control" placeholder="0" min="0" required>
      </div>

      <!-- Số lượng -->
      <div class="form-group">
        <label>Số lượng</label>
        <input type="number" name="qty" class="form-control" placeholder="0" min="0" value="0">
      </div>

      <!-- Mô tả -->
      <div class="form-group full">
        <label>Mô tả sản phẩm</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả..."></textarea>
      </div>

      <!-- Upload ảnh -->
      <div class="form-group full">
        <label>Hình ảnh sản phẩm</label>
        <div class="upload-zone" id="uploadZone">
          <input type="file" name="images" id="imageInput" accept="image/*" style="display:none">
          <div class="upload-placeholder" id="uploadPlaceholder">
            <i class="fa fa-cloud-upload-alt"></i>
            <p>Kéo thả hoặc <span onclick="document.getElementById('imageInput').click()">chọn ảnh</span></p>
            <small>PNG, JPG, WEBP tối đa 5MB</small>
          </div>
          <img id="imagePreview" src="" alt="" style="display:none; max-height:200px; border-radius:10px; object-fit:contain;">
        </div>
      </div>

    </div>

    <div class="form-footer">
      <a href="?page=products" class="btn-cancel">Hủy</a>
      <button type="submit" class="btn-submit">
        <i class="fa fa-save me-1"></i> Lưu sản phẩm
      </button>
    </div>

  </form>
</div>

<style>
.page-header { display:flex; justify-content:space-between; align-items:center; padding:20px 24px 10px; }
.page-header h2 { font-size:20px; font-weight:700; color:#1e293b; margin:0; }
.btn-back { background:#f1f5f9; color:#475569; border:none; padding:9px 16px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; }
.btn-back:hover { background:#e2e8f0; color:#1e293b; }

.form-card { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,.08); margin:10px 24px 24px; padding:28px 32px; }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.form-group { display:flex; flex-direction:column; gap:6px; }
.form-group.full { grid-column:1/-1; }
.form-group label { font-size:13px; font-weight:700; color:#374151; letter-spacing:.3px; }
.required { color:#e53e3e; }
.form-control, .form-select { border:1.5px solid #e2e8f0; border-radius:9px; padding:10px 14px; font-size:14px; transition:.2s; }
.form-control:focus, .form-select:focus { border-color:#1a56db; box-shadow:0 0 0 3px rgba(26,86,219,.1); outline:none; }
textarea.form-control { resize:vertical; min-height:100px; }

.upload-zone { border:2px dashed #cbd5e1; border-radius:12px; padding:28px; text-align:center; cursor:pointer; transition:.2s; background:#f8fafc; }
.upload-zone:hover { border-color:#1a56db; background:#eff6ff; }
.upload-placeholder i { font-size:36px; color:#94a3b8; margin-bottom:10px; display:block; }
.upload-placeholder p { margin:0; font-size:14px; color:#64748b; }
.upload-placeholder span { color:#1a56db; cursor:pointer; font-weight:600; }
.upload-placeholder small { color:#94a3b8; font-size:12px; }

.form-footer { display:flex; justify-content:flex-end; gap:12px; margin-top:28px; border-top:1.5px solid #f1f5f9; padding-top:20px; }
.btn-cancel { background:#f1f5f9; color:#475569; padding:10px 24px; border-radius:9px; font-size:14px; font-weight:600; text-decoration:none; }
.btn-submit { background:#1a56db; color:#fff; border:none; padding:10px 28px; border-radius:9px; font-size:14px; font-weight:700; cursor:pointer; transition:.2s; }
.btn-submit:hover { background:#1e429f; }
</style>

<script>
const imageInput   = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const placeholder  = document.getElementById('uploadPlaceholder');
const uploadZone   = document.getElementById('uploadZone');

uploadZone.addEventListener('click', () => imageInput.click());

imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        placeholder.style.display  = 'none';
    };
    reader.readAsDataURL(file);
});

// Drag & drop
uploadZone.addEventListener('dragover', e => { e.preventDefault(); uploadZone.style.borderColor='#1a56db'; });
uploadZone.addEventListener('dragleave',  () => uploadZone.style.borderColor='#cbd5e1');
uploadZone.addEventListener('drop', e => {
    e.preventDefault();
    uploadZone.style.borderColor = '#cbd5e1';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        imageInput.files = e.dataTransfer.files;
        const reader = new FileReader();
        reader.onload = ev => {
            imagePreview.src = ev.target.result;
            imagePreview.style.display = 'block';
            placeholder.style.display  = 'none';
        };
        reader.readAsDataURL(file);
    }
});
</script>