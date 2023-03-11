@extends("layouts.app")
@section("title", "Dashboard")
@section("content")
    <!-- Quick stats boxes -->
    <div class="row">
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-teal-400">
                <div class="panel-body">
                    <h3 class="no-margin"></h3>
                    Total Users
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Current server load -->
            <div class="panel bg-pink-400">
                <div class="panel-body">
                    <h3 class="no-margin"></h3>
                    Total Stores
                </div>
                <div id="server-load"></div>
            </div>
            <!-- /current server load -->
        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="panel bg-blue-400">
                <div class="panel-body">
                    <h3 class="no-margin"></h3>
                    Total Orders
                </div>
                <div id="today-revenue"></div>
            </div>
            <!-- /today's revenue -->
        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="panel bg-green-400" >
                <div class="panel-body">
                    <h3 class="no-margin"></h3>
                    Total Products
                </div>
                <div id="today-revenue"></div>
            </div>
            <!-- /today's revenue -->
        </div>
    </div>
    <!-- /quick stats boxes -->
@endsection
