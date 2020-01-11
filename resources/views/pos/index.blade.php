@extends('layouts.casual')

@section('title', $title)

@section('content')
<div class="modal fade slide-up disable-scroll" id="modalTambahPelanggan" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i></button>
                    <h5>Tambah <span class="semi-bold">Pelanggan</span></h5>
                    <p>Silahkan mengisi formulir berikut, untuk menambah pelanggan</p>
                </div>
                <div class="modal-body">
                <form action="#" id="formTambahPelanggan">
                    <div class="form-group-attached">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Telepon</label>
                                    <input type="text" class="form-control" name="telepon">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4 m-t-10 sm-m-t-10">
                            <button type="button" onclick="tambahPelanggan()" class="btn btn-primary btn-block m-t-5">Simpan</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
                                <button type="button" onclick="bayar()" class="btn btn-primary btn-cons">Bayar</button>
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
        <div class="col-lg-5 m-b-10 d-flex flex-column">
            <!-- START card -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        Informasi Transaksi
                    </div>
                </div>
                <form action="/pos/bayar" method="POST" id="formBayar">
                    @csrf
                    <div class="card-block">
                        <div class="row">
                            <div class="table-responsive table-invoice">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="">
                                                <p class="text-black">Outlet</p>
                                            </td>
                                            <td class="">
                                                <select class="full-width" data-init-plugin="select2" name="outlet" id="outlet" onchange="pilihOutlet()" required>
                                                    <option value="" selected disabled>Pilih Outlet</option>
                                                    @foreach ($outlets as $outlet)
                                                        <option value="{{ $outlet->id }}">{{ $outlet->outlet_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <p class="text-black">Pelanggan</p>
                                            </td>
                                            <td class="w-75">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div id="pilihpelanggan">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button data-target="#modalTambahPelanggan" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END card -->
        </div>
        <div class="col-lg-7 m-b-10 d-flex flex-column">
            <!-- START card -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        Produk
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Cari Produk</label>
                                <span class="help"></span>
                                <select onchange="cariproduk()" class="full-width" data-init-plugin="select2" id="cariproduktampil" disabled>
                                    <option selected disabled>Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <form action="#" id="formProduk">
                                @csrf
                                <table class="table table-hover demo-table-search table-responsive-block">
                                    <thead>
                                        <tr>
                                            <th class="w-50">Nama Produk</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-center w-25" >Jumlah</th>
                                            <th class="invisible" style="width: 1%"><button class="btn btn-sm"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="infoproduk">
                                        <tr>
                                            <td colspan="4" class="text-center v-align-middle">
                                                <button class="btn disabled">Silahkan Pilih Produk</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 m-b-10 d-flex flex-column">
        <!-- START card -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        Daftar Barang
                    </div>
                </div>
                <div class="card-block">
                    <table class="table table-hover demo-table-search table-responsive-block">
                        <thead>
                            <tr>
                                <th class="w-25">Nama Produk</th>
                                <th class="text-right w-25">Harga</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-right w-50">Total</th>
                                <th class="invisible" style="width: 1%;"></th>
                            </tr>
                        </thead>
                        <tbody id="keranjangTampil">
                        </tbody>
                        <tfoot id="keranjangFooter">
                        </tfoot>
                  </table>
                  <br>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
</div>
@endsection

@section('inpagejs')
<script>
    $(document).ready(function(){
        ajax();
        getPelanggan();
        getKeranjang();
    })

    // Outlet
    function pilihOutlet(){
        document.getElementById('cariproduktampil').disabled = false;
    }

    // Pelanggan
    function getPelanggan(){
        $.ajax({
            url: '/pos/pelanggan/reload',
            type: 'GET',
            success: function(response)
            {
                $('#pilihpelanggan').html(response);
            }
        })
    }

    function tambahPelanggan(){
        ajax();

        var input = $('#formTambahPelanggan').serialize();
        
        $('#modalTambahPelanggan').modal('hide');
        dismissModal();

        $.ajax({
            url: 'pos/pelanggan/tambah',
            type: 'POST',
            data: input,
            success: function(response)
            {
                resetForm('formTambahPelanggan');
                getPelanggan();
            }
        });

    }

    // Produk
    function cariproduk() {
        var e = document.getElementById("cariproduktampil");
        var idProduk = e.options[e.selectedIndex].value;
        
        $.ajax({
            url: '/pos/infoproduk',
            type: 'GET',
            data: { id: idProduk },
            success: function(response)
            {
                $('#infoproduk').html(response);
            }
        });
    }

    function tambahProdukForm(){
        ajax();

        var input = $('#formProduk').serialize();

        $.ajax({
            url: 'pos/keranjang',
            type: 'POST',
            data: input,
            success: function(response)
            {
                getKeranjang();
            }
        });
    }

    function kurangiProduk(cart) {
            $.ajax({
                url: '/pos/keranjang/kurang',
                type: 'GET',
                data: { id: cart },
                success: function(response)
                {
                    getKeranjang();
                },
                error: function()
                {
                    console.log('💩');
                }
            });
        }

    function tambahProduk(cart) {
        $.ajax({
            url: '/pos/keranjang/tambah',
            type: 'GET',
            data: { id: cart },
            success: function(response)
            {
                getKeranjang();
            }
        });
    }

    // Keranjang
    function getKeranjang(){
        $.ajax({
            url: '/pos/keranjang/tampil',
            type: 'GET',
            success: function(response)
            {
                $('#keranjangTampil').html(response);
            },
            error: function()
            {
                console.log('💩');
            }
        });
    }

    // Form
    function bayar(){
        if( !$('#outlet').val()){ 
            alert('Outlet Tidak Boleh Kosong');
        } else {
            $('#formBayar').submit();
        }
    }

    // Additional
    function ajax(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    }

    function dismissModal(){
        $("[data-dismiss=modal]").trigger({ type: "click" });
    }

    function resetForm(id){
        document.getElementById(id).reset();
    }
</script>
    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $(document).ready(function () {

            keranjangTampil();
            reloadPelanggan();
            reloadable();

            $('#formProduk').submit(function (e) {
                e.preventDefault();  // prevent the form from 'submitting'

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var input = $('#formCoba').serialize();
                
                $.ajax({
                    url: 'pos/keranjang',
                    type: 'POST',
                    data: input,
                    success: function(response)
                    {
                        console.log(response);
                        reloadable();
                    }
                });

            });

            $('#formBayar').submit(function (e) {
                e.preventDefault();  // prevent the form from 'submitting'

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var input = $('#formBayar').serialize();

                $('#modalBayar').modal('hide');

                $.ajax({
                    url: 'pos/bayar',
                    type: 'POST',
                    data: input,
                    success: function(response)
                    {
                        console.log(response);
                        reloadable();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        $('#kembali').html(response);
                        $('#modalSukses').modal('show');
                    },
                    error: function()
                    {
                        console.log('error');
                    }
                });

            });

            $('#formTambahPelanggan').submit(function (e) {
                e.preventDefault();  // prevent the form from 'submitting'

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var input = $('#formTambahPelanggan').serialize();

                $('#modalTambahPelanggan').modal('hide');

                $.ajax({
                    url: 'pos/pelanggan/tambah',
                    type: 'POST',
                    data: input,
                    success: function(response)
                    {
                        console.log(response);
                        reloadPelanggan();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        document.getElementById("formTambahPelanggan").reset();
                    },
                    error: function()
                    {
                        console.log('error');
                    }
                });

            });
        });

        function reloadable() {
            totalBelanja();
            keranjangTampil();
            // console.log('reloadable function reloaded');
            getDiskon();
        }

        function totalBelanja() {
            $.ajax({
                url: '/pos/infototal',
                type: 'GET',
                success: function(response)
                {
                    var e = document.getElementById("pelanggan");
                    var pelanggan = e.options[e.selectedIndex].text;
                    var pelangganid = e.options[e.selectedIndex].value;

                    if (pelangganid != 0)
                    {
                        $('#totalbelanja').html(response);
                        $('#totalpembayaran').html(response);
                        document.getElementById("totalpembayaraninput").value = response;
                    }
                }
            })
        }

        function cariproduk() {
            var e = document.getElementById("cariproduktampil");
            var idProduk = e.options[e.selectedIndex].value;
            
            $.ajax({
                url: '/pos/infoproduk',
                type: 'GET',
                data: { id: idProduk },
                success: function(response)
                {
                    $('#infoproduk').html(response);
                }
            });
        }

        function pelanggan() {
            var e = document.getElementById("pelanggan");
            var pelanggan = e.options[e.selectedIndex].text;
            var pelangganid = e.options[e.selectedIndex].value;

            document.getElementById("pelangganid").value = pelangganid;
            $('#pelangganbayar').html(pelanggan);

            totalBelanja();
        }

        function keranjangTampil() {
            $.ajax({
                url: '/pos/keranjang/tampil',
                type: 'GET',
                success: function(response)
                {
                    // console.log(response);
                    $('#keranjangTampil').html(response);
                },
                error: function()
                {
                    console.log('💩');
                }
            });
        }

        function kurangiProduk(cart) {
            $.ajax({
                url: '/pos/keranjang/kurang',
                type: 'GET',
                data: { id: cart },
                success: function(response)
                {
                    console.log(response);
                    reloadable();
                },
                error: function()
                {
                    console.log('💩');
                }
            });
        }

        function tambahProduk(cart) {
            $.ajax({
                url: '/pos/keranjang/tambah',
                type: 'GET',
                data: { id: cart },
                success: function(response)
                {
                    console.log(response);
                    reloadable();
                }
            });
        }

        function reloadPelanggan() {
            $.ajax({
                url: '/pos/pelanggan/reload',
                type: 'GET',
                success: function(response)
                {
                    $('#pilihpelanggan').html(response);
                }
            })
        }

        function pilihOutlet(){
            var e = document.getElementById("outlet");
            var outlet = e.options[e.selectedIndex].text;
            var outletid = e.options[e.selectedIndex].value;

            document.getElementById('outletnama').innerHTML  = outlet;
            document.getElementById('outletid').value  = outletid;
        }

        function getDiskon(){
            $.ajax({
                url: '/pos/pelanggan/getdiskon',
                type: 'GET',
                success: function(response){
                    $('#keranjangFooter').html(response);
                }
            })
        }
    </script> --}}
@endsection

@section('myjsfile')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/datatables.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
@endsection