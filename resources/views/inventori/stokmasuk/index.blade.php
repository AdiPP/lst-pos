@extends('layouts.casual')

@section('title', $title)

@section('content')
@foreach ($models as $model)
    <div class="modal fade slide-up disable-scroll" id="modalView{{ $model->id }}" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrapper">
                    <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5>Informasi <span class="semi-bold">Stok Masuk</span></h5>
                    <p class="p-b-10">Berikut informasi mengenai Stok Masuk <strong>#SM{{ $model->id }}</strong></p>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group-attached">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Outlet</label>
                                    <input type="text" class="form-control" value="{{ $model->outlet->outlet_name }}" readonly>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" name="kota" value="{{ Helper::mysqlToTanggal($model->tanggal) }}" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Catatan</label>
                                    <textarea class="form-control" id="name" placeholder="Briefly Describe your Abilities" name="alamat" readonly>{{ $model->description }}</textarea>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover demo-table-search table-responsive-block">
                            <thead>
                                <tr>
                                    <th class="">Nama Produk</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-right">Harga Beli / Unit</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model->infos as $produk)
                                    <tr>
                                        <td class="v-align-middle">
                                            {{ $produk->produk->product_name }}
                                        </td>
                                        <td class="v-align-middle text-right">
                                            Rp {{ $produk->jumlah }}
                                        </td>
                                        <td class="v-align-middle text-right">
                                            Rp {{ $produk->harga_beli_per_unit }}
                                        </td>
                                        <td class="v-align-middle text-right">
                                            Rp {{ $produk->total_harga_beli }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4 m-t-10 sm-m-t-10">
                            <button type="button" class="btn btn-primary btn-block m-t-5" data-dismiss="modal">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade slide-up disable-scroll" id="modalHapus{{ $model->id }}" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5>Perhatian</h5>
                </div>
                <div class="modal-body">
                    <p class="no-margin">Apakah anda yakin ingin menghapus Stok Masuk <span class="bold">#SM{{ $model->id }}</span> dari sistem?</p>
                </div>
                <div class="modal-footer">
                    <form action="/inventori/stokmasuk/{{ $model->id }}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-primary btn-cons  pull-left inline">Iya</button>
                    </form>
                    <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Tidak</button>
                </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach

<!-- START JUMBOTRON -->
<div class="jumbotron">
    <div class=" container p-l-0 p-r-0 container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
            <div class="container-md-height">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-top">
                    <!-- START card -->
                    <div class="card card-transparent">
                        <div style="display:flex; align-items:center;">
                            <div class="pull-left">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="ml-auto">
                                <a href="/inventori/stokmasuk/create" class="btn btn-primary btn-cons">Tambah Stok Masuk</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- END card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END JUMBOTRON -->
<div class="container sm-padding-10 p-l-0 p-r-0">
    <div class="row">
        <div class="col-lg-12 m-b-10 d-flex flex-column">
        <!-- START card -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        Daftar Stok Masuk
                    </div>
                    <div class="padding-10">
                        <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="search-table" class="form-control pull-right" placeholder="Cari Stok Masuk">
                        </div>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-block">
                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                    <thead>
                      <tr>
                        {{-- <th style="width:1%" class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="">
                            <button class="btn btn-link"><i class="pg-trash"></i></button>
                        </th> --}}
                        <th class="" style="width: 33%;">ID Stok Masuk</th>
                        <th class="" style="width: 33%;">Outlet</th>
                        <th class="" style="width: 33%;">Tanggal</th>
                        <th class="invisible" style="width: 1%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td class="v-align-middle">
                                    #SM{{ $model->id }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $model->outlet->outlet_name }}
                                </td>
                                <td class="v-align-middle">
                                    {{ Helper::mysqlToTanggal($model->tanggal) }}
                                </td>
                                <td class="v-align-middle">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-xs btn-complete mx-1" data-target="#modalView{{  $model->id }}" data-toggle="modal" id=""><i class="fa fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
</div>
@endsection

@section('myjsfile')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/datatables.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
@endsection