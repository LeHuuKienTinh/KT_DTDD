<template>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Danh Sách Đơn Hàng
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Tên Người Nhận</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th>Tổng Tiền Thanh Toán</th>
                                    <th>Thanh Toán</th>
                                    <th>Tình Trạng Đơn Hàng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <th> 1</th>
                                    <td>kiên tĩnh</td>
                                    <td class="text-center">09223344</td>
                                    <td>thanh khê, đà nẵng</td>
                                    <td class="text-end">200.900.999đ</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger">Chưa Thanh Toán</button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger">Chưa Giao</button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#updateModal">Sửa</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa đơn hàng</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xóa đơn hàng này không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Update Modal -->
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa đổi thông tin đơn hàng</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xóa đơn hàng này không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "OrderUser",
}
</script>
<style>
.table-bordered {
    width: 100%;
    /* border-collapse: collapse; */
    /* table-layout: fixed;  */
}

.table-bordered th,
.table-bordered td {
    padding: 10px;
    text-align: center;
    border: 2px solid #a39191;
}
</style>