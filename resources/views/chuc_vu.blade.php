@extends('master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-5">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header">
                Thêm Mới Chức Năng
            </div>
            <div class="card-body">
                <label class="mb-1 mt-1">Tên Chức Vụ</label>
                <input class="form-control" type="text">
                <label class="mb-1 mt-1">Tình Trạng</label>
                <select class="form-control">
                    <option value="1">
                        Hoạt Động
                    </option>
                    <option value="0">
                        Tạm Tắt
                    </option>
                </select>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header">
                Danh Sách Chức Vụ
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="100%">
                                <div class="input-group mb-3">
                                    <input v-on:keyup.enter="searchChucVu()" v-model="key_search.abc" type="text" class="form-control" placeholder="Nhập thông tin cần tìm">
                                    <button class="btn btn-primary" v-on:click="searchChucVu()">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="align-middle text-center">#</th>
                            <th class="align-middle text-center">Tên Chức Vụ</th>
                            <th class="align-middle text-center">Tình Trạng</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(v, k) in list_chuc_vu">
                            <th class="align-middle text-center">@{{ k + 1 }}</th>
                            <td class="align-middle">@{{ v.ten_chuc_vu }}</td>
                            <td class="align-middle text-center">
                                <button v-if="v.tinh_trang == 1" class="btn btn-success">Hoạt động</button>
                                <button v-else class="btn btn-warning">Tạm Dừng</button>
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#capNhatModal">Cập Nhật</button>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#xoaModal">Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="capNhatModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Chức Vụ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="mb-1 mt-1">Tên Chức Vụ</label>
                                <input class="form-control" type="text">
                                <label class="mb-1 mt-1">Tình Trạng</label>
                                <select class="form-control">
                                    <option value="1">
                                        Hoạt Động
                                    </option>
                                    <option value="0">
                                        Tạm Tắt
                                    </option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Thoát</button>
                                <button type="button" class="btn btn-danger">Cập Nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Chức Vụ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div
                                    class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">Warning</h6>
                                            <div class="text-dark">
                                                <p>Bạn có muốn xóa danh mục <b>Điện Thoại</b> này không?
                                                </p>
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
            list_chuc_vu   :   [],
            key_search : {}
        },
        created()       {
            this.loadDataChucVu();
        },
        methods:        {
            // loadDataChucVu  -> lên url http://127.0.0.1:8000/api/admin/chuc-vu/lay-du-lieu
            loadDataChucVu()   {
                axios
                    .get('http://127.0.0.1:8000/api/admin/chuc-vu/lay-du-lieu')
                    .then((res) =>  {
                        this.list_chuc_vu = res.data.chuc_vu;
                    });
            },

            searchChucVu(){
                axios
                    .post('http://127.0.0.1:8000/api/admin/chuc-vu/tim-chuc-vu', this.key_search)
                    .then((res) =>  {
                        this.list_chuc_vu = res.data.chuc_vu;
                    });
            }
        },
    });
</script>
@endsection
