<div class="container-fluid">

    <div class="card-box">

        <h4 class="mb-4">Thêm sản phẩm</h4>

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Tên sản phẩm</label>

                    <input type="text"
                        name="name"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Giá</label>

                    <input type="number"
                        name="price"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Danh mục</label>

                    <select name="category"
                        class="form-select">

                        <option>Giày thể thao</option>
                        <option>Giày chạy bộ</option>
                        <option>Giày sneaker</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Trạng thái</label>

                    <select name="status"
                        class="form-select">

                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label>Ảnh sản phẩm</label>

                    <input type="file"
                        name="image"
                        class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Mô tả</label>

                    <textarea class="form-control"
                        rows="4"></textarea>

                </div>

            </div>

            <button class="btn btn-primary">
                Lưu sản phẩm
            </button>

            <a href="?page=products"
                class="btn btn-light">

                Quay lại

            </a>

        </form>

    </div>

</div>