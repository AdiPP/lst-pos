@extends('layouts.casual')

{{-- @section('title', $title) --}}

@section('content')
<form action="/pelanggan/{{ $model->id }}" method="POST">
    @csrf
    <input name="_method" type="hidden" value="PUT">
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
                                    {{-- <h5>{{ $title }}</h5> --}}
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
                            <div class="col-lg-6 p-l-10 p-r-10 p-t-10">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <span class="help"></span>
                                    <input type="text" class="form-control" name="nama" value="{{ $model->nama }}" required>
                                </div>
                                <div class="row p-l-5 p-r-5">
                                    <div class="form-group col-lg-6 required">
                                        <label>Telepon</label>
                                        <span class="help"></span>
                                        <input type="text" class="form-control" name="telepon" value="{{ $model->telepon }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Email</label>
                                        <span class="help"></span>
                                        <input type="email" class="form-control" name="email" value="{{ $model->email }}">
                                    </div>
                                </div>
                                <div class="row p-l-5 p-r-5">
                                    <div class="form-group col-lg-6">
                                        <label>Jenis Kelamin</label>
                                        <span class="help"></span>
                                        <select class="full-width" data-init-plugin="select2" name="jenisKelamin">
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="Pria" @if ($model->jenis_kelamin == "Pria")
                                                selected
                                            @endif>Pria</option>
                                            <option value="Wanita" @if ($model->jenis_kelamin == "Wanita")
                                                selected
                                            @endif>Wanita</option>
                                          </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Tanggal Lahir</label>
                                        <span class="help"></span>
                                        <input type="text" class="form-control" id="datepicker-component" name="tanggalLahir" value="{{ $model->tanggal_lahir }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-l-10 p-r-10 p-t-10">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <span class="help"></span>
                                    <textarea class="form-control" id="name" placeholder="" name="alamat">{{ $model->alamat }}</textarea>
                                </div>
                                <div class="row p-l-5 p-r-5">
                                    <div class="form-group col-lg-6">
                                        <label>Kota</label>
                                        <span class="help"></span>
                                        <select class="full-width" data-init-plugin="select2" name="kota">
                                            <option value="" selected disabled>Pilih Kota</option>
                                            @foreach ($kotas as $kota)
                                                <option value="{{  $kota->KODE_WILAYAH }}" @if ($kota->KODE_WILAYAH == $model->kota)
                                                    selected
                                                @endif>{{  $kota->NAMA }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Kode Pos</label>
                                        <span class="help"></span>
                                        <input type="text" class="form-control" name="kodePos" value="{{ $model->kode_pos }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <span class="help"></span>
                                    <textarea class="form-control" id="name" placeholder="" name="catatan">{{ $model->catatan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
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