@extends('master')
@section('noi_dung')
<div id="app">
    <div class="row mb-3">
        <div class="col-12 text-end">
            <button class="btn btn-outline-primary px-5 radius-30" data-bs-toggle="modal"
                data-bs-target="#themMoiModal">
                <b>Thêm Mới</b>
            </button>
        </div>
    </div>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Nguyên Liệu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Tên Nguyên Liệu</label>
                                <input type="text" class="form-control" placeholder="Nhập tên nguyên liệu">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Slug Nguyên Liệu</label>
                                <input type="text" class="form-control" placeholder="Nhập slug nguyên liệu">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-3">Giá</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-3">Số Lượng</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-3">Đơn Vị Tính</label>
                                <input type="text" class="form-control" placeholder="Đơn vị tính">
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-3">Tình Trạng</label>
                                <select class="form-control">
                                    <option value="0">Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-header">
                <h5>Danh Sách Nguyên Liệu</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchNguyenLieu()" v-model="key_search.abc" type="text" class="form-control" placeholder="Nhập thông tin cần tìm">
                                        <button class="btn btn-primary" v-on:click="searchNguyenLieu()">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle text-nowrap">
                                    #
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Tên Nguyên Liệu
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Slug Nguyên Liệu
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Giá
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Số Lượng
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Đơn Vị Tính
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Tình Trạng
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_nguyen_lieu">
                                <th class="text-center align-middle text-nowrap">
                                    @{{ k + 1 }}
                                </th>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.ten_nguyen_lieu }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.slug_nguyen_lieu }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.gia }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.so_luong }}
                                </td>

                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.dvt }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-if="v.tinh_trang" class="btn btn-success" style="width: 100px;">Hiển Thị</button>
                                    <button v-else class="btn btn-warning" style="width: 100px;">Tạm Dừng</button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button class="btn btn-info" style="width: 100px;"
                                        data-bs-toggle="modal" data-bs-target="#capNhatModal">Cập
                                        Nhật</button>
                                    <button class="btn btn-danger" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#xoaModal">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Nguyên Liệu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Tên Nguyên Liệu</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên nguyên liệu">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Slug Nguyên Liệu</label>
                                            <input type="text" class="form-control" placeholder="Nhập slug nguyên liệu">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label mt-3">Giá</label>
                                            <input type="number" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-3">Số Lượng</label>
                                            <input type="number" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label mt-3">Đơn Vị Tính</label>
                                            <input type="text" class="form-control" placeholder="Đơn vị tính">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-3">Tình Trạng</label>
                                            <select class="form-control">
                                                <option value="0">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Thoát</button>
                                <button type="button" class="btn btn-primary">Cập Nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Nguyên Liệu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">Warning</h6>
                                            <div class="text-dark">
                                                <p>Bạn có muốn xóa sản phẩm <b> Sting Vàng</b> này không?</p>
                                                <p>
                                                    <b>Lưu ý:</b> Điều này không thể hoàn tác!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Thoát</button>
                                <button type="button" class="btn btn-danger">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    new Vue({
        el      :       '#app',
        data    :       {
            list_nguyen_lieu   :   [],
            key_search         :   {}
        },
        created()       {
            this.loadDataNguyenLieu();
        },
        methods:        {
            // loadDataNguyenLieu  -> lên url http://127.0.0.1:8000/api/admin/nguyen-lieu/lay-du-lieu
            loadDataNguyenLieu()   {
                axios
                    .get('http://127.0.0.1:8000/api/admin/nguyen-lieu/lay-du-lieu')
                    .then((res) =>  {
                        this.list_nguyen_lieu = res.data.nguyen_lieu;
                    });
            },

            searchNguyenLieu(){
                axios
                    .post('http://127.0.0.1:8000/api/admin/nguyen-lieu/tim-nguyen-lieu', this.key_search)
                    .then((res) =>  {
                        this.list_nguyen_lieu = res.data.nguyen_lieu;
                    });
            }
        },
    });
</script>
@endsection
