@extends('admin.layout')
@section('title', 'Account')
@section('menu-data')
    <input type="hidden" name="" class="menu-data" value="account-group | account">
@endsection()


@section('css')

@endsection()


@section('body')


    <div class="container-fluid">

        <div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
            <div class="clearfix">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="fi fi-rr-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Bot</li>
                    </ol>
                </nav>
            </div>
            <a href="javascript:void(0);" class="btn-link" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="fi fi-rr-plus me-1"></i> New Bot
            </a>
        </div>

        <div class="row">

            <div class="col-12">
                <div class="card overflow-hidden">
                    <div
                        class="card-header d-flex flex-wrap gap-3 align-items-center justify-content-between border-0 pb-0">
                        <h6 class="card-title mb-0">Bot List</h6>
                        <div class="clearfix d-flex align-items-center gap-2">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-white btn-shadow waves-effect btn-sm" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    All Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Active</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Inactive</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Pending</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="dt_CustomerList_Search"> </div>
                        </div>
                    </div>
                    <div class="card-body px-1 pt-2 pb-2">
                        <div id="dt_CustomerList_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                            <div class="row mt-2 justify-content-between dt-layout-table">
                                <div
                                    class="d-md-flex justify-content-between align-items-center col-12 dt-layout-full col-md">
                                    <table id="" class="table table-sm table-row-rounded data-row-checkbox dataTable"
                                        aria-describedby="dt_CustomerList_info" style="width: 100%;">
                                        <colgroup>
                                            <col data-dt-column="1" style="width: 261.6px;">
                                            <col data-dt-column="2" style="width: 196.2px;">
                                            <col data-dt-column="3" style="width: 233.817px;">
                                            <col data-dt-column="4" style="width: 196.183px;">
                                            <col data-dt-column="5" style="width: 196.2px;">
                                            <col data-dt-column="6" style="width: 196.183px;">
                                        </colgroup>
                                        <thead class="table-light">
                                            <tr>
                                                <th class="minw-200px dt-orderable-asc dt-orderable-desc" data-dt-column="1"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span class="dt-column-title">Name &amp;
                                                            Profile</span><span class="dt-column-order" role="button"
                                                            aria-label="Name &amp;amp; Profile: Activate to sort"
                                                            tabindex="0"></span></div>
                                                </th>
                                                <th class="minw-150px dt-orderable-asc dt-orderable-desc" data-dt-column="2"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Phone</span><span
                                                            class="dt-column-order" role="button"
                                                            aria-label="Phone: Activate to sort" tabindex="0"></span></div>
                                                </th>
                                                <th class="minw-150px dt-orderable-asc dt-orderable-desc" data-dt-column="3"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Email</span><span
                                                            class="dt-column-order" role="button"
                                                            aria-label="Email: Activate to sort" tabindex="0"></span></div>
                                                </th>
                                                <th class="minw-150px dt-orderable-asc dt-orderable-desc" data-dt-column="4"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Country</span><span
                                                            class="dt-column-order" role="button"
                                                            aria-label="Country: Activate to sort" tabindex="0"></span>
                                                    </div>
                                                </th>
                                                <th class="minw-150px dt-orderable-asc dt-orderable-desc" data-dt-column="5"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Date</span><span class="dt-column-order"
                                                            role="button" aria-label="Date: Activate to sort"
                                                            tabindex="0"></span></div>
                                                </th>
                                                <th class="minw-150px dt-orderable-asc dt-orderable-desc" data-dt-column="6"
                                                    rowspan="1" colspan="1">
                                                    <div class="dt-column-header"><span
                                                            class="dt-column-title">Status</span><span
                                                            class="dt-column-order" role="button"
                                                            aria-label="Status: Activate to sort" tabindex="0"></span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-xxs me-2 rounded-circle">
                                                            <img src="assets/images/avatar/avatar1.webp" alt="">
                                                        </div>
                                                        John Carter
                                                    </div>
                                                </td>
                                                <td>+1 (646) 555-7788</td>
                                                <td>john.carter@email.com</td>
                                                <td>USA</td>
                                                <td>01-08-2025</td>
                                                <td>
                                                    <span
                                                        class="badge badge-lg bg-success-subtle text-success">Active</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection()


@section('js')

    <script src="{{ asset('manager/assets/js/page/account.js') }}"></script>

@endsection()