@extends('master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h5 class="pt-3"><b>Thêm Mới Khu Vực</b></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Tên Khu Vực</label>
                        <input type="text" class="form-control mt-2">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="">Slug Khu Vực</label>
                        <input type="text" class="form-control mt-2">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="">Tình Trạng</label>
                        <select name="" id="" class="form-control mt-2">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-header">
                <h5 class="pt-3"><b>Danh Sách Khu Vực</b></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchKhuVuc()" v-model="key_search.abc" type="text" class="form-control" placeholder="Nhập thông tin cần tìm">
                                        <button class="btn btn-primary" v-on:click="searchKhuVuc()">
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
                                    Tên Khu Vực
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Slug Khu Vực
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
                            <tr v-for="(v, k) in list_khu_vuc">
                                <th class="text-center align-middle text-nowrap">
                                    @{{ k + 1 }}
                                </th>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.ten_khu }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    @{{ v.slug_khu }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-if="v.tinh_trang == 1" class="btn btn-success" style="width: 100px;">Hiển Thị</button>
                                    <button v-else class="btn btn-warning" style="width: 100px;">Tạm Dừng</button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button class="btn btn-info me-2" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#capNhatModal">Cập Nhật</button>
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
                                    <div class="col-12">
                                        <label for="">Tên Khu Vực</label>
                                        <input type="text" class="form-control mt-2">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label for="">Slug Khu Vực</label>
                                        <input type="text" class="form-control mt-2">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label for="">Tình Trạng</label>
                                        <select name="" id="" class="form-control mt-2">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Tạm Tắt</option>
                                        </select>
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
                                                <p>Bạn có muốn xóa sản phẩm <b> Khu Vực VIP</b> này không?</p>
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
            list_khu_vuc   :   [],
            key_search     :   {}
        },
        created()       {
            this.loadDataKhuVuc();
        },
        methods:        {
            // loadDataKhuVuc  -> lên url http://127.0.0.1:8000/api/admin/khu-vuc/lay-du-lieu
            loadDataKhuVuc()   {
                axios
                    .get('http://127.0.0.1:8000/api/admin/khu-vuc/lay-du-lieu')
                    .then((res) =>  {
                        this.list_khu_vuc = res.data.khu_vuc;
                    });
            },

            searchKhuVuc(){
                axios
                    .post('http://127.0.0.1:8000/api/admin/khu-vuc/tim-khu-vuc', this.key_search)
                    .then((res) =>  {
                        this.list_khu_vuc = res.data.khu_vuc;
                    });
            }
        },
    });
</script>
@endsection
