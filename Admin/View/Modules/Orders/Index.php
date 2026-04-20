<div class="container-fluid">

    <div class="Order-card-box">

        <div class="Order-header">

            <h4><strong>Danh sách đơn hàng</strong></h4>

        </div>


        <!-- TOOLBAR -->

        <div class="Order-toolbar">

            <form method="GET"
                class="Order-filter-form">

                <input type="hidden"
                    name="page"
                    value="orders">


                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm mã đơn hàng..."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    class="Order-search-input">


                <select name="status"
                    class="Order-select">

                    <option value="">-- Trạng thái --</option>

                    <option value="pending"
                        <?= ($_GET['status'] ?? '') == 'pending' ? 'selected' : '' ?>>
                        Chờ xác nhận
                    </option>

                    <option value="processing"
                        <?= ($_GET['status'] ?? '') == 'processing' ? 'selected' : '' ?>>
                        Đang xử lý
                    </option>

                    <option value="shipping"
                        <?= ($_GET['status'] ?? '') == 'shipping' ? 'selected' : '' ?>>
                        Đang giao
                    </option>

                    <option value="completed"
                        <?= ($_GET['status'] ?? '') == 'completed' ? 'selected' : '' ?>>
                        Hoàn thành
                    </option>

                    <option value="cancelled"
                        <?= ($_GET['status'] ?? '') == 'cancelled' ? 'selected' : '' ?>>
                        Đã huỷ
                    </option>

                </select>


                <button class="Order-btn-filter">

                    <i class="fa fa-search"></i>
                    Lọc

                </button>

            </form>

        </div>



        <!-- TABLE -->

        <table class="Order-table">

            <thead>

                <tr>

                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>


            <tbody>

                <?php for ($i = 1; $i <= 8; $i++): ?>

                    <tr>

                        <td>#ORD00<?= $i ?></td>

                        <td>Nguyễn Văn A</td>

                        <td>0988888888</td>

                        <td>abc@gmail.com</td>

                        <td>15/04/2026</td>

                        <td class="Order-total">

                            1.250.000đ

                        </td>


                        <td>

                            <span class="Order-status Order-status-pending">

                                Chờ xác nhận

                            </span>

                        </td>


                        <td>

                            <div class="Order-actions">


                                <a href="?page=view-order&id=<?= $i ?>"
                                    class="Order-btn-view">

                                    <i class="fa fa-eye"></i>

                                </a>


                                


                            </div>

                        </td>

                    </tr>

                <?php endfor; ?>

            </tbody>

        </table>



        <!-- PAGINATION -->

        <div class="Order-pagination">

            <?php for ($i = 1; $i <= 5; $i++): ?>

                <a
                    href="?page=orders
                    &p=<?= $i ?>
                    &keyword=<?= $_GET['keyword'] ?? '' ?>
                    &status=<?= $_GET['status'] ?? '' ?>"
                    class="Order-page-btn
                    <?= ($_GET['p'] ?? 1) == $i ? 'active' : '' ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>


        </div>


    </div>

</div>