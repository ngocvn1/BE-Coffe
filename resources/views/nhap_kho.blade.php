@extends('master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    Danh Sách Nguyên Liệu
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
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Nguyên Liệu</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_nguyen_lieu">
                                    <tr>
                                        <th class="text-center align-middle text-nowrap">@{{key + 1}}</th>
                                        <td class="align-middle text-nowrap">@{{value.ten_nguyen_lieu}}</td>
                                        <th class="text-center align-middle text-nowrap">
                                            <button class="btn btn-primary">Thêm</button>
                                        </th>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Danh Sách Nhập Kho
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Nguyên Liệu</th>
                                    <th class="text-center align-middle text-nowrap">Số Lương</th>
                                    <th class="text-center align-middle text-nowrap">Đơn Giá</th>
                                    <th class="text-center align-middle text-nowrap">Thành Tiền</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_nhap_kho">
                                    <tr>
                                        <th class="text-center align-middle text-nowrap">@{{key + 1}}</th>
                                        <td class="align-middle text-nowrap">@{{value.ten_nguyen_lieu}}</td>
                                        <td class="text-center align-middle text-nowrap">
                                            <input type="text" v-model="value.so_luong" class="form-control">
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <input type="text" v-model="value.don_gia" class="form-control">
                                        </td>
                                        <td class="text-center align-middle text-nowrap">@{{value.thanh_tien}}</td>
                                        <td class="text-center align-middle text-nowrap">
                                            <i class="fa-solid fa-trash fa-2x text-danger"></i>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el      :   '#app',
            data    :   {
                list_nguyen_lieu : [],
                list_nhap_kho    : [],
                key_search       : {abc : ""},
            },
            created()   {
                this.loadDataNguyenLieu();
                this.loadDataNhapKho();
            },
            methods :   {
                loadDataNguyenLieu()   {
                    axios
                        .get('http://127.0.0.1:8000/api/admin/nguyen-lieu/lay-du-lieu')
                        .then((res) =>  {
                            this.list_nguyen_lieu = res.data.nguyen_lieu;
                        });
                },
                loadDataNhapKho()   {
                    axios
                        .get('http://127.0.0.1:8000/api/admin/nhap-kho/lay-du-lieu')
                        .then((res) =>  {
                            this.list_nhap_kho = res.data.nhap_kho;
                        });
                },
                searchNguyenLieu() {
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
