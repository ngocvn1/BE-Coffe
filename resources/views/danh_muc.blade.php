@extends('master')
@section('noi_dung')
<div id="app" class="row">
    <div class="col-md-4">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-header">
                <h5>Thêm Mới Danh Mục</h5>
            </div>
            <div class="card-body">
                <label class="form-label">Tên Danh Mục</label>
                <input type="text" class="form-control" placeholder="Nhập tên danh mục">
                <label class="form-label mt-3">Slug Danh Mục</label>
                <input type="text" class="form-control" placeholder="Nhập slug danh mục">
                <label class="form-label mt-3">Tình Trạng</label>
                <select class="form-control">
                    <option value="0">Yes</option>
                    <option value="1">No</option>
                </select>
                <label class="form-label mt-3">Danh Mục Cha</label>
                <select class="form-control">
                    <option value="0">Root</option>
                </select>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" >Thêm mới</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-header">
                <h5>Danh Sách Danh Mục</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchDanhMuc()" v-model="key_search.abc" type="text" class="form-control" placeholder="Nhập thông tin cần tìm">
                                        <button class="btn btn-primary" v-on:click="searchDanhMuc()">
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
                                    Tên Danh Mục
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Slug Danh Mục
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Danh Mục Cha
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
                            <tr v-for="(v, k) in list_danh_muc">
                                <th class="text-center align-middle text-nowrap">
                                    @{{ k + 1 }}
                                </th>
                                <td class="align-middle text-nowrap">
                                    @{{ v.ten_danh_muc }}
                                </td>
                                <td class="align-middle text-nowrap">
                                    @{{ v.slug_danh_muc }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    Root
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-if="v.tinh_trang == 1" class="btn btn-success" style="width: 100px;">Hiển Thị</button>
                                    <button v-else class="btn btn-warning" style="width: 100px;">Tạm Dừng</button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button class="btn btn-info" style="width: 100px;"
                                        data-bs-toggle="modal" data-bs-target="#capNhatModal">Cập
                                        Nhật</button>
                                    <button class="btn btn-danger" style="width: 100px;"
                                        data-bs-toggle="modal" data-bs-target="#xoaModal">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="capNhatModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Danh Mục
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Tên Danh Mục</label>
                                        <input type="text" class="form-control"
                                            placeholder="Nhập tên danh mục">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label mt-3">Slug Danh Mục</label>
                                        <input type="text" class="form-control"
                                            placeholder="Nhập slug danh mục">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label mt-3">Tình Trạng</label>
                                        <select class="form-control">
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Danh Mục</h1>
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
                                    data-bs-dismiss="modal">Close</button>
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
            key_search      :{abc :''},
            list_danh_muc   :   [],
        },
        created()       {
            this.loadDataDanhMuc();
        },
        methods:        {
            // loadDataDanhMuc  -> lên url http://127.0.0.1:8000/api/admin/danh-muc/lay-du-lieu
            loadDataDanhMuc()   {
                axios
                    .get('http://127.0.0.1:8000/api/admin/danh-muc/lay-du-lieu')
                    .then((res) =>  {
                        this.list_danh_muc = res.data.danh_muc;
                    });
            },

            searchDanhMuc(){
                axios
                    .post('http://127.0.0.1:8000/api/admin/danh-muc/tim-danh-muc', this.key_search)
                    .then((res) =>  {
                        this.list_danh_muc = res.data.danh_muc;
                    });
            }
        },
    });
</script>
@endsection
