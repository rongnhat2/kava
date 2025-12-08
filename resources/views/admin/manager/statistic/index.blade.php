@extends('admin.layout')
@section('title', 'Transaction')
@section('menu-data')
<input type="hidden" name="" class="menu-data" value="transaction-group | transaction">
@endsection()


@section('css')

@endsection()


@section('body')

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">$23,523</h2>
                        <p class="m-b-0 text-muted">Profit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-profile"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">3,685</h2>
                        <p class="m-b-0 text-muted">Transactions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-purple">
                        <i class="anticon anticon-user"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">1,832</h2>
                        <p class="m-b-0 text-muted">Accounts</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()


@section('js')

<script src="{{ asset('manager/assets/js/page/transaction.js') }}"></script>

@endsection()