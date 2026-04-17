<div class="container-fluid">

    <div class="OrderDetail-card">

        <div class="OrderDetail-header">

            <h4>Cập nhật đơn hàng #ORD001</h4>

            <a href="?page=orders"
                class="OrderDetail-btn-back">

                ← Quay lại

            </a>

        </div>


        <form method="POST">


            <div class="OrderDetail-section">

                <label>Trạng thái đơn hàng</label>

                <select class="OrderDetail-input">

                    <option>Chờ xác nhận</option>
                    <option>Đang xử lý</option>
                    <option>Đang giao</option>
                    <option>Hoàn thành</option>
                    <option>Huỷ</option>

                </select>

            </div>



            <div class="OrderDetail-section">

                <label>SĐT nhận hàng</label>

                <input
                    type="text"
                    value="0988888888"
                    class="OrderDetail-input">

            </div>



            <div class="OrderDetail-section">

                <label>Địa chỉ giao hàng</label>

                <input
                    type="text"
                    value="123 Nguyễn Trãi"
                    class="OrderDetail-input">

            </div>



            <div class="OrderDetail-section">

                <label>Ghi chú</label>

                <textarea
                    class="OrderDetail-input">

Giao giờ hành chính

</textarea>

            </div>



            <button class="OrderDetail-btn-save">

                Cập nhật đơn hàng

            </button>


        </form>

    </div>

</div>