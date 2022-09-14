<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Web Admin untuk acara Family Day.">
    <meta name="author" content="Muhammad Rizqi">
    <title>Family Day Admin</title>



    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/lineAwesome/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="familyDay">
    <div id="root" class="root mn--max hd--expanded">
        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">
                    <div class="d-md-flex align-items-end">
                        <div class="me-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                                </ol>
                            </nav>
                            <h2 class="page-title mb-0 mt-2"></h2>

                            <p class="lead mb-lg-0"></p>

                        </div>
                        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">

                            <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                <i class="la la-plus"></i>
                                Create Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="row mt-3">
                        @foreach ($data as $d)
                            <div class="col-sm-6 col-md-4 col-xl-3 mb-3">
                                <div class="card data-events">
                                    <div class="card-body p-0">
                                        <div class="text-center position-relative">
                                            <div class="pb-3">
                                                <div class="container-img">
                                                    @if ($d->acara_banner)
                                                        <?php $img = explode(';', $d->acara_banner); ?>
                                                        <img class="img-lg bannernya " src="{{ $img[0] }}"
                                                            alt="Logo Picture" loading="lazy">
                                                    @else
                                                        <img class="img-lg bannernya" src="{{ asset('img/logo.png') }}"
                                                            alt="Logo Picture" loading="lazy">
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="h6 black-text text-left px-2">{{ $d->acara_nama }}</p>
                                            <p class="text-muted text-left fs-12 mb-1 px-2"><i
                                                    class="la la-stopwatch"></i>{{ $d->acara_mulai }}</p>
                                            <p class="text-muted text-left fs-12 mb-0 px-2 pb-3"><i
                                                    class="la la-map-marker"></i>{{ $d->acara_lokasi }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let tooltipList = [...document.querySelectorAll('.add-tooltip')];
                            tooltipList.map(function(tooltipEl) {
                                new bootstrap.Tooltip(tooltipEl)
                            })
                        });
                    </script>

                </div>

                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-fs">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body ">
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <h6 class="row">Create Event</h6>
                                        <form id="createEvents" class="mt-2" action="{{ url('/events/create') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label class="row text-dark fw-bolder">Banner Acara</label>
                                            <div class="row form-upload row-cols-5">
                                                <div class="col field-upload-center"><img class="img-upload"
                                                        src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                                        loading="lazy"><input type="file" class="d-none"
                                                        name="banner_1"></div>
                                                <div class="col field-upload-center"><img class="img-upload"
                                                        src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                                        loading="lazy"><input type="file" class="d-none"
                                                        name="banner_2"></div>
                                                <div class="col field-upload-center"><img class="img-upload"
                                                        src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                                        loading="lazy"><input type="file" class="d-none"
                                                        name="banner_3"></div>
                                                <div class="col field-upload-center"><img class="img-upload"
                                                        src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                                        loading="lazy"><input type="file" class="d-none"
                                                        name="banner_4"></div>
                                                <div class="col field-upload-center"><img class="img-upload"
                                                        src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                                        loading="lazy"><input type="file" class="d-none"
                                                        name="banner_5"></div>
                                                <p class="text-muted fs-12px w-100 text-center mt-2">*Tambahkan 5
                                                    banner
                                                    dengan resolusi 640
                                                    <i>pixel</i>
                                                    x 720 <i>pixel</i>
                                                </p>
                                            </div>
                                            <label class="row mt-3 text-dark fw-bolder">Detil Acara</label>
                                            <div class="row">
                                                <div class="col-md-12 p-0 ">
                                                    <label for="field_nama_acara" class="form-label">Nama
                                                        Acara</label>
                                                    <input id="field_nama_acara" type="text" name="nama_acara"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 p-0 ">
                                                    <label for="field_sdeskripsi_acara" class="form-label">Deskripsi
                                                        Acara</label>
                                                    <textarea id="field_sdeskripsi_acara" name="deskripsi_acara" type="text" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 p-0 ">
                                                    <label for="field_maks_peserta_acara" class="form-label">Max
                                                        peserta per
                                                        keluarga</label>
                                                    <input id="field_maks_peserta_acara" type="number"
                                                        name="maks_peserta" class="form-control" max=10 min=1>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-3">
                                                <div class="col-md-6 p-0 pr-2">
                                                    <label for="field_tgl_mulai_acara" class="form-label">Tgl Mulai
                                                        Acara</label>
                                                    <input id="field_tgl_mulai_acara" type="datetime-local"
                                                        name="tgl_mulai_acara" class="form-control">
                                                </div>

                                                <div class="col-md-6 p-0 pl-2">
                                                    <label for="field_tgl_selesai_acara" class="form-label">Tgl
                                                        Selesai Acara</label>
                                                    <input id="field_tgl_selesai_acara" type="datetime-local"
                                                        name="tgl_selesai_acara" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6 p-0 pr-2">
                                                    <label for="field_waktu_mulai_checkin" class="form-label">Waktu
                                                        Mulai Check-in</label>
                                                    <input id="field_waktu_mulai_checkin" type="datetime-local"
                                                        name="waktu_mulai_presensi" class="form-control">
                                                </div>

                                                <div class="col-md-6 p-0 pl-2">
                                                    <label for="field_waktu_tutup_checkin" class="form-label">Waktu
                                                        Tutup Check-in</label>
                                                    <input id="field_waktu_tutup_checkin" type="datetime-local"
                                                        name="waktu_selesai_presensi" class="form-control">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-3">
                                                <div class="col-md-6 p-0 pr-2">
                                                    <label for="field_alamat_checkin"
                                                        class="form-label">Lokasi</label>
                                                    <input id="field_alamat_checkin" name="lokasi_acara"
                                                        type="text" class="form-control">
                                                </div>

                                                <div class="col-md-6 p-0 pl-2">
                                                    <label for="field_koordinat" class="form-label">Titik
                                                        Koordinat</label>
                                                    <input id="field_koordinat" name="titik_koordinat" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12 p-0 ">
                                                    <label for="field_lokasi_acara" class="form-label">Alamat
                                                        Lokasi</label>
                                                    <input id="field_lokasi_acara" name="alamat_lokasi"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-3">
                                                <div class="col-md-6 p-0 pr-2">
                                                    <label for="field_nama_pic" class="form-label">Nama Pic</label>
                                                    <input id="field_nama_pic" name="nama_pic" type="text"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 p-0 pl-2">
                                                    <label for="field_no_whatsapp" class="form-label">No Whatsapp
                                                        PIC</label>
                                                    <input id="field_no_whatsapp" name="telp_pic" type="text"
                                                        class="form-control">
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row mt-3">
                                                <div class="col-md-12 p-0 text-center">
                                                    <button type="button" class="btn btn-bg-red btn-sm hstack gap-2">
                                                        <i class="la la-close"></i>
                                                        Close
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-bg-purple btn-sm hstack gap-2">
                                                        <i class="la la-save"></i>
                                                        Save Event
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Powered By<a href="https://www.iconpln.co.id"
                                class="ms-1 btn-link fw-bold">ICON+</a></div>
                    </div>
                </div>
            </footer>
        </section>


        <nav id="famdaynav-container" class="famdaynav">
            <div class="famdaynav__inner">
                <div class="famdaynav__top-content scrollable-content pb-5">
                    <div class="famdaynav__profile mt-3 d-flex3">
                        <div class="mt-2 d-mn-max"></div>
                        <div class="mininav-toggle text-center py-2">
                            <img class="famdaynav__logo img-md rounded-circle " src="{{ asset('img/logo.png') }}"
                                alt="Logo Picture">
                        </div>
                    </div>

                    <div class="famdaynav__categoriy py-3">
                        <ul class="famdaynav__menu nav flex-column">
                            <li class="nav-item has-sub">
                                <a href="#" class="mininav-toggle nav-link collapsed"><i
                                        class="la la-th-large fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label ms-1">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="la la-calendar fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label ms-1">Events</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../../widgets/" class="nav-link mininav-toggle"><i
                                        class="la la-user fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label mininav-content ms-1">Daftar User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="famdaynav__bottom-content border-top pb-2">
                    <ul id="famdaynav" class="famdaynav__menu nav flex-column">
                        <li class="nav-item ">
                            <a href="#" class="nav-link" aria-expanded="false">
                                <i class="la la-lock fs-5 me-2"></i>
                                <span class="nav-label ms-1">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>

    <script src="{{ asset('plugins/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>
    <script>
        $(function() {

            function readURL(input, el) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(el).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("img.img-upload").on("click", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    const ini = this;
                    $(this).next("input[type=file].d-none").trigger("click");
                    $(this).next("input[type=file].d-none").on("change", function() {
                        readURL(this, ini);
                    });
                    ev.handler = true;
                }
            });

            $("form#createEvents").validate({
                onfocusout: function(element) {
                    let dt;
                    if ($(element).attr('type') == "time") {
                        dt = false;
                    } else {
                        dt = true;
                    }
                    return dt;
                },
                rules: {
                    nama_acara: {
                        required: true,
                        maxlength: 250,
                        minlength: 5
                    },
                    deskripsi_acara: {
                        maxlength: 350,
                        minlength: 5
                    },
                    lokasi_acara: {
                        maxlength: 100,
                        minlength: 5,
                        required: true,
                    },
                    alamat_lokasi: {
                        maxlength: 350,
                        minlength: 5,
                        required: true,
                    },
                    nama_pic: {
                        required: true,
                        maxlength: 250,
                        minlength: 5
                    },
                    telp_pic: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    maks_peserta: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    titik_koordinat: {
                        required: true
                    },
                    tgl_mulai_acara: {
                        required: true
                    },
                    tgl_selesai_acara: {
                        required: true
                    },
                    waktu_mulai_presensi: {
                        required: true
                    },
                    waktu_selesai_presensi: {
                        required: true,
                    }
                },
                submitHandler: function(form) {
                    form.submit();

                    // var form = $('form#createEvents')[0];
                    // var fd = new FormData(form);

                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{ url('/events/create') }}",
                    //     headers: {
                    //         'X-Requested-With': 'XMLHttpRequest'
                    //     },
                    //     dataType: "json",
                    //     data: fd,
                    //     mimeType: "multipart/form-data",
                    //     contentType: false,
                    //     processData: false,
                    //     success: function(data) {
                    //         return false;
                    //     },
                    //     error: function() {
                    //         return false;
                    //     }
                    // });

                }
            });
        });
    </script>

</body>

</html>
