<div class="container-fluid">

    <div class="Products-card-box">

        <div class="Products-header">

            <h4>Chi tiết người dùng</h4>

            <div class="Products-actions">

                <a href="?page=update-user&id=<?= $_GET['id'] ?>"
                    class="Products-btn-edit">

                    <i class="fa fa-pen"></i>

                </a>

                <a href="?page=users"
                    class="Products-btn-view">

                    <i class="fa fa-arrow-left"></i>

                </a>

            </div>

        </div>


        <div class="User-view-wrapper">


            <div class="User-avatar-section">

                <img
                    src="https://via.placeholder.com/120"
                    class="User-avatar-large">

                <h5>Nguyễn Văn A</h5>

                <span class="Products-status Products-status-active">

                    Admin

                </span>

            </div>



            <div class="User-info-grid">


                <div class="User-info-item">

                    <label>ID</label>

                    <p><?= $_GET['id'] ?></p>

                </div>


                <div class="User-info-item">

                    <label>Email</label>

                    <p>admin@gmail.com</p>

                </div>


                <div class="User-info-item">

                    <label>Số điện thoại</label>

                    <p>0909999999</p>

                </div>


                <div class="User-info-item">

                    <label>Địa chỉ</label>

                    <p>Cần Thơ</p>

                </div>
                <div class="User-info-item">
                    <label>Vai trò</label>
                    <span class="Admin-role-badge Admin-role-admin">
                        Admin
                    </span>
                </div>

                <div class="User-info-item">

                    <label>Trạng thái</label>

                    <span class="Products-status Products-status-active">

                        Hoạt động

                    </span>

                </div>


                <div class="User-info-item">

                    <label>Ngày tạo</label>

                    <p>01/04/2026</p>

                </div>



            </div>


        </div>

    </div>

</div>