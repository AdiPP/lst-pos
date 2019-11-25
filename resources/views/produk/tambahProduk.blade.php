@extends('layouts.casual')

@section('title', $title)

@section('content')
<form action="/produk" method="POST" enctype="multipart/form-data">
    @csrf
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
                                    <a href="{{ url('/produk', []) }}" class="btn btn-primary btn-cons">Batal</a>
                                    <input type="submit" class="btn btn-primary btn-cons" value="Simpan">
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
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-6 padding-10">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <span class="help"></span>
                                    <input type="text" class="form-control" name="nama_produk">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <span class="help"></span>
                                    <select class="full-width required" data-init-plugin="select2" name="kategori_produk">
                                            <option selected disabled value="">Pilih Salah Satu</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="padding-10 bg-master-lighter">
                                    <p>Harga</p>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <span class="help"></span>
                                        <input type="text" data-a-sign="Rp " class="autonumeric form-control" name="harga_produk">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto Produk</label>
                                    <span class="help"></span>
                                    <input type="file" class="form-control-file" name="foto_produk">
                                </div>
                            </div>
                            <div class="col-lg-6 padding-10">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <span class="help"></span>
                                    <input type="text" class="form-control" name="sku_produk">
                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <span class="help"></span>
                                    <input type="text" class="form-control" name="barcode_produk">
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <span class="help"></span>
                                    <select class="full-width required" data-init-plugin="select2" name="satuan_produk">
                                            <option selected disabled value="">Pilih Salah Satu</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endforeach
                                        {{-- @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Varian</label>
                                    <span class="help"></span>
                                    <p class="hint-text small">Apakah produk ini memiliki varian seperti warna dan ukuran?</p>
                                    <input type="checkbox" data-init-plugin="switchery" data-size="small" data-color="primary" />
                                    <div class="m-t-10">
                                        <button class="btn btn-primary btn-cons">Kelola Varian Produk</button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-b-10 d-flex flex-column">
                <div data-pages="card" class="card card-default" id="card-basic">
                    <div class="card-header  ">
                        <div class="card-title">Opsional
                        </div>
                    </div>
                    <div class="card-block" style="display: block;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('myjsfile')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
@endsection
