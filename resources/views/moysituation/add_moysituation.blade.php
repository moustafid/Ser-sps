@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <style>
        form > h4 {
            text-align: center;
            margin: 20px auto;
            max-width: 550px;
            position: relative;
        }
        form > h4:before {
            background-color: #000;
            display: block;
            width: 160px;
            height: 2px;
            content: "";
            position: absolute;
            left: -140px;
            top: 50%;
            z-index: 100;
        }
        form > h4:after {
            background-color: #000;
            display: block;
            width: 160px;
            height: 2px;
            content: "";
            position: absolute;
            right: -140px;
            top: 50%;
            z-index: 100;
        }
    </style>
@endsection
@section('title')
    مكتب الميزانية - إضافة وضعية مالية
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">مكتب الميزانية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة وضعية</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('moysituations.store') }}" method="post" enctype="multipart/form-data"
                          autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">الرقم المكانو</label>
                                <input type="text" class="form-control" id="inputName" name="Number_manko"
                                       title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الطور</label>
                                <select name="Phase" class="form-control select2" onclick="console.log($(this).val())"
                                        onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد الطور</option>
                                    @foreach ($phases as $phase)
                                        <option value="{{ $phase->id }}"> {{ $phase->phase_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">المؤسسة</label>
                                <select id="etablissement" name="Etablissement" class="form-control select2">
                                </select>
                            </div>
                            <div class="col">
                                <label>رقم ح خ</label>
                                <input class="form-control" name="Number_hk"
                                       type="text" required>
                            </div>

                        </div>
                        <br><h4><span>عمليات مصالح الميزانية  Opérations Services Budgetaires</span></h4><br>
                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رصــيـــــــد( 12/31/2022 )</label>
                                <input type="text" class="form-control" id="Credit_OSB" name="Credit_OSB"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myOSB()">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">ايرادات من  01/01 إلى نهاية الشهر</label>
                                <input type="text" class="form-control form-control-lg" id="Revenues_OSB"
                                       name="Revenues_OSB" title="يرجي ادخال مبلغ العمولة "
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myOSB()"
                                       required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">النفقات من 01/01</label>
                                <input type="text" class="form-control" id="Expenses_OSB" name="Expenses_OSB"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myOSB()">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رصــــيـــــــد إلى نهاية الشهر</label>
                                <input type="text" class="form-control" id="Credit_Fin_Month_OSB" name="Credit_Fin_Month_OSB" readonly>
                            </div>
                        </div>
                        <br>
                        <h4><span>عمليات مصالح   خارج الميزانية Opérations d'intérêts extrabudgétaires</span></h4>
                        <br>
                        {{-- 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رصــيـــــــد( 12/31/2022 )</label>
                                <input type="text" class="form-control" id="Credit_OIEB" name="Credit_OIEB"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myFunction()">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">ايرادات من  01/01 إلى نهاية الشهر</label>
                                <input type="text" class="form-control form-control-lg" id="Revenues_OIEB"
                                       name="Revenues_OIEB" title="يرجي ادخال مبلغ العمولة "
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myFunction()"
                                       required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">النفقات من 01/01</label>
                                <input type="text" class="form-control" id="Expenses_OIEB" name="Expenses_OIEB"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="myFunction()">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رصــــيـــــــد إلى نهاية الشهر</label>
                                <input type="text" class="form-control" id="Credit_Fin_Month_OIEB" name="Credit_Fin_Month_OIEB" readonly>
                            </div>
                        </div>
                        <br>
                        <h4><span>الرصيد الاجمالي</span></h4>
                        <br>
                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">إلى نهاية الشهر</label>
                                <input type="text" class="form-control" id="Total" name="Total"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onfocus="myTotal()"  readonly>
                            </div>

                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Phase"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('phase') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Etablissement"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Etablissement"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>
        function myOSB() {

            var Credit_OSB = parseFloat(document.getElementById("Credit_OSB").value);
            var Revenues_OSB = parseFloat(document.getElementById("Revenues_OSB").value);
            var Expenses_OSB = parseFloat(document.getElementById("Expenses_OSB").value);

            var Credit_Fin_Month_OSB = parseFloat(Credit_OSB + Revenues_OSB - Expenses_OSB).toFixed(2);

            document.getElementById("Credit_Fin_Month_OSB").value = Credit_Fin_Month_OSB;

        }

    </script>
    <script>
        function myFunction() {

            var Credit_OIEB = parseFloat(document.getElementById("Credit_OIEB").value);
            var Revenues_OIEB = parseFloat(document.getElementById("Revenues_OIEB").value);
            var Expenses_OIEB = parseFloat(document.getElementById("Expenses_OIEB").value);

            var Credit_Fin_Month_OIEB = parseFloat(Credit_OIEB + Revenues_OIEB - Expenses_OIEB).toFixed(2);

            document.getElementById("Credit_Fin_Month_OIEB").value = Credit_Fin_Month_OIEB;

        }

    </script>
    <script>
        function myTotal() {

            var Credit_Fin_Month_OSB = parseFloat(document.getElementById("Credit_Fin_Month_OSB").value);
            var Credit_Fin_Month_OIEB = parseFloat(document.getElementById("Credit_Fin_Month_OIEB").value);

            var Total = parseFloat(Credit_Fin_Month_OSB + Credit_Fin_Month_OIEB).toFixed(2);

            document.getElementById("Total").value = Total;

        }

    </script>

@endsection
