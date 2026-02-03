<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item ">
                <a class="" href="#">
                    <h6 class="mb-0">Management</h6>
                </a>
            </li>
            <li class="nav-item statistic-group">
                <a class="statistic" href="{{ route('customer.statistic') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown account-group">
                <a class="dropdown-toggle account" href="{{ route('customer.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-gateway"></i>
                    </span>
                    <span class="title">Account</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown transaction-group">
                <a class="dropdown-toggle transaction" href="{{ route('customer.transaction') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-gateway"></i>
                    </span>
                    <span class="title">Transaction</span>
                </a>
            </li> -->
        </ul>
    </div>
</div>