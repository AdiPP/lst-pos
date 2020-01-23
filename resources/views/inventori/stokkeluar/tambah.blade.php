@extends('layouts.casual')

@section('title', $title)

@section('content')
<div class="modal fade slide-up disable-scroll" id="outletKosong" tabindex="-1" role="dialog"
    aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <h5>Perhatian</h5>
                </div>
                <div class="modal-body">
                    <p class="no-margin">Saat ini anda belum memiliki <span
                            class="bold">Outlet</span>. Silahkan tambahkan outlet terlebih dahulu.</p>
                </div>
                <div class="modal-footer">
                    <a href="/inventori/stokkeluar" class="btn btn-default btn-cons inline pull-left">Kembali</a>
                    <a href="/outlet" class="btn btn-primary btn-cons inline pull-left">Tambahkan</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<form action="/inventori/stokkeluar" method="POST" enctype="multipart/form-data">
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
                                    <a href="/inventori/stokkeluar" class="btn btn-primary btn-cons">Batal</a>
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
                    <div class="card-header">
                        <div class="card-title">
                            Informasi Stok Keluar
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-3 padding-10">
                                <div class="form-group">
                                    <label class="required-symbol">Outlet</label>
                                    <span class="help"></span>
                                    <select class="full-width" data-init-plugin="select2" name="outlet" required>
                                        <option value="" disabled selected>Pilih Outlet</option>
                                        @foreach ($outlets as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->outlet_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 padding-10">
                                <div class="form-group">
                                    <label class="required-symbol">Tanggal</label>
                                    <span class="help"></span>
                                    <input autocomplete="off" type="text" class="form-control" name="tanggal" id="datepicker-component" required>
                                </div>
                            </div>
                            <div class="col-lg-6 padding-10">
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <span class="help"></span>
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
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
                    <div class="card-header ">
                        <div class="card-title">
                            <span class="required-symbol">Produk</span>
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                            <thead>
                            <tr>
                                <th class="w-75">Nama Produk</th>
                                <th class="w-25">Jumlah</th>
                                <th class="text-center  " style="width: 1%"><i class="fa fa-trash"></i> </th>
                            </tr>
                            </thead>
                            <tbody id="produk">
                                <tr>
                                    <td class="v-align-middle">
                                        <select class="full-width" onchange="undisabled(this)" data-init-plugin="select2" name="produk[]" required>
                                            <option selected value="" disabled>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="v-align-middle">
                                        <input type="number" class="form-control input-sm text-right" name="jumlah[]" placeholder="0" disabled>
                                    </td>
                                    <td class="v-align-middle text-right">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" onclick="hapusProduk(this)" class="btn btn-xs btn-danger mx-1" disabled><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <br>
                            <button type="button" onclick="tambahProduk()" class="btn btn-default brn-cons" id="tambahButton" disabled>Tambah Produk</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('inpagejs')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        cekOutlet();
    })

    function undisabled(input){
        var inputs = document.getElementsByName('produk[]');
        var indeks;

        indeks = findIndex(input, inputs);

        document.getElementsByName('jumlah[]')[indeks].disabled = false;
        document.getElementById('tambahButton').disabled = false;
    }

    function disabledTambahButton(element) {
        element.disabled = true;
    }

    function tambahProduk(){            
        
        disabledTambahButton(document.getElementById('tambahButton'));

        var produk = document.getElementsByName('produk[]');

        $.ajax({
            url: '/inventori/stokkeluar/tambahproduk',
            type: 'GET',
            success: function(response){
                $('#produk').append(response);
            },
        })

    }

    function hapusProduk(button){
        $(button).parent().parent().parent().remove();
    }

    function findIndex(input, inputs){
        var index;

        for (var i = 0 ; i<inputs.length; i++){
            if(input == inputs[i]){
                index = i;
            }   
        }

        return index;
    }

    function cekOutlet(){
        $.ajax({
            url: '/inventori/stokmasuk/getoutlet',
            type: 'GET',
            success: function(response){
                if (response == 0) {
                    $('#outletKosong').modal({backdrop: 'static', keyboard: false});
                    $('#outletKosong').modal('toggle');
                }
            },
        })
    }
</script>
@endsection

@section('myjsfile')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
@endsection
