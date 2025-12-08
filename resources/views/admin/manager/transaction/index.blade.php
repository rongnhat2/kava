@extends('admin.layout')
@section('title', 'Transaction')
@section('menu-data')
<input type="hidden" name="" class="menu-data" value="transaction-group | transaction">
@endsection()


@section('css')

@endsection()


@section('body')


<div class="page-header no-gutters has-tab">
    <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
        <div class="media align-center justify-content-between m-b-15 w-100">
            <div class="m-l-15">
                <h4 class="m-b-0">Transaction List</h4>
            </div>
            @include('admin.alert')
        </div>
    </div>
</div>
<div class="card data-custom-tab on-show" data-tab-name="Table">
    <div class="card-body">
        <div class="m-t-25">
            <table id="data-table" class="table"> </table>
        </div>
    </div>
</div>


@endsection()


@section('js')

<script src="{{ asset('manager/assets/js/page/transaction.js') }}"></script>

@endsection()