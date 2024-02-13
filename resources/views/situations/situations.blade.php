@extends('layouts.master')
@section('title')
    الوضعية المالية الشهرية لطور الإبتدائي
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <style>
        .payment-of-tax h2 {
            color: #444;
            font-size: 30px;
            margin: 20px 0px;
            text-align: center;
            text-transform: uppercase;
        }
        .payment-of-tax table tr th{
            text-align: center;
            vertical-align: middle;

        }
        .payment-of-tax table thead{
            background-color: #f2f2f2;
        }
        .payment-of-tax table tr td{
            vertical-align: middle;
        }
        </style>
@endsection
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

    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف وضعية بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card payment-of-tax mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة فاتورة')
                        <a href="situations/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة وضعية</a>
                    @endcan

                    @can('تصدير EXCEL')
                        <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}"
                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                            <tr>
                                <th rowspan="3" style="text-align: center;vertical-align: middle; ">#</th>
                                <th rowspan="3" style="text-align: center;vertical-align: middle; ">الرقم المكانو</th>
                                <th rowspan="3" style="text-align: center;vertical-align: middle; ">إسم المؤسسة</th>
                                <th rowspan="3" style="text-align: center;vertical-align: middle; ">رقم ح خ</th>
                                <th colspan="4" class="border-bottom" style="text-align: center;vertical-align: middle; ">عمليات مصالح الميزانية  Opérations Services Budgetaires</th>
                                <th colspan="4" class="border-bottom" style="text-align: center;vertical-align: middle; ">عمليات مصالح خارج الميزانية  O H B</th>
                                <th rowspan="2" colspan="1" class="border" style="text-align: center;vertical-align: middle; ">الرصيد الاجمالي</th>
                                <th rowspan="3" class="border" style="text-align: center;vertical-align: middle; ">العمليات</th>
                            </tr>
                            <tr>
                                <th class="border" style="text-align: center;vertical-align: middle; ">رصــيـــــــد</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">ايرادات من 01/01</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">النفقات من 01/01</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">رصــــيـــــــد</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">رصــيـــــــد</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">ايرادات من 01/01</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">النفقات من 01/01</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">رصــــيـــــــد</th>
                            </tr>

                            <tr>
                                <th class="border" style="text-align: center;vertical-align: middle; ">31/12/2022</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">31/12/2022</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                                <th class="border" style="text-align: center;vertical-align: middle; ">إلى نهاية الشهر</th>
                            </tr>

                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($situations as $situation)
                                    @php
                                    $i++
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $situation->Number_manko }} </td>
                                        <td>{{ $situation->Etablissement }}</td>
                                        <td>{{ $situation->Number_hk }}</td>
                                        <td>{{ $situation->Credit_OSB }}</td>
                                        <td>{{ $situation->Revenues_OSB }}</td>
                                        <td>{{ $situation->Expenses_OSB }}</td>
                                        <td>{{ $situation->Credit_Fin_Month_OSB }}</td>
                                        <td>{{ $situation->Credit_OIEB }}</td>
                                        <td>{{ $situation->Revenues_OIEB }}</td>
                                        <td>{{ $situation->Expenses_OIEB }}</td>
                                        <td>{{ $situation->Credit_Fin_Month_OIEB }}</td>
                                        <td>{{ $situation->Total }}</td>
                                        <td class="border">
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('تعديل الفاتورة')
                                                        <a class="dropdown-item"
                                                            href=" {{ url('edit_situation') }}/{{ $situation->id }}"><i class="text-danger fas fa-pen-alt"></i>&nbsp;&nbsp;تعديل
                                                            الوضعية</a>
                                                    @endcan

                                                    @can('حذف الفاتورة')
                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $situation->id }}"
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الوضعية</a>
                                                    @endcan

                                                    @can('تغير حالة الدفع')
                                                        <a class="dropdown-item"
                                                            href="{{ URL::route('Status_show', [$situation->id]) }}"><i
                                                                class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                            حالة
                                                            الدفع</a>
                                                    @endcan

                                                    @can('ارشفة الفاتورة')
                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $situation->id }}"
                                                            data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                            الارشيف</a>
                                                    @endcan

                                                    @can('طباعةالفاتورة')
                                                        <a class="dropdown-item" href="Print_invoice/{{ $situation->id }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            الوضعية
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            @if($count_situation > 0)
                                <tfoot>
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle; " colspan="4">المجموع</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Credit_OSB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Revenues_OSB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Expenses_OSB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Credit_Fin_Month_OSB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Credit_OIEB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Revenues_OIEB') }}</td>
                                        <td style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Expenses_OIEB') }}</td>
                                        <td class="border-right" style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Credit_Fin_Month_OIEB') }}</td>
                                        <td class="border-right" style="text-align: center;vertical-align: middle; ">{{ SituationSumValue('Total') }}</td>
                                        <td disabled class="border-right" style="text-align: center;vertical-align: middle; "></td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('situations.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ارشيف الفاتورة -->
    <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الارشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    <input type="hidden" name="id_page" id="id_page" value="2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-success">تاكيد</button>
                </div>
                </form>
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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>







@endsection
