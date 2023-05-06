@extends('layouts.booking')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title" style="font-size: 1.5rem;"><i class="fa fa-door-open mr-2"></i>Science Library :: Room Booking</h4>
                <div class="panel-heading-btn">
                    Khon Kaen University
                </div>
            </div>
            <div class="panel-body">
                <div class="row mt-3">
                    <div class="col-md-11 ml-5">
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            @for($i = 0; $i < 5; $i++) <div class="col-md-2 text-center card-1 mb-3 room-free">
                                <h4 class="mt-3">{{ $room[$i]['name'] }}</h4>
                                <!-- <button type="button" class="btn btn-xs btn-lime">ว่าง</button><br /> -->
                                <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[$i]['id'] }}" data-email="{{ $room[$i]['email'] }}" data-name="{{ $room[$i]['name'] }}">
                                    <span class="d-flex align-items-center text-left">
                                        <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                        <span>
                                            <span class="d-block mb-n1"><b>จอง</b></span>
                                        </span>
                                    </span>
                                </button>
                        </div>
                        @endfor
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2 text-center card-1 mb-3 room-free">
                                    <h4 class="mt-3">{{ $room[5]['name'] }}</h4>
                                    <!-- <button type="button" class="btn btn-xs btn-lime">ว่าง</button><br /> -->
                                    <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[5]['id'] }}" data-email="{{ $room[5]['email'] }}" data-name="{{ $room[5]['name'] }}">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                            <span>
                                                <span class="d-block mb-n1"><b>จอง</b></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-center card-1 mb-3 room-free">
                                    <h4 class="mt-3">{{ $room[6]['name'] }}</h4>
                                    <!-- <button type="button" class="btn btn-xs btn-lime">ว่าง</button><br /> -->
                                    <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[6]['id'] }}" data-email="{{ $room[6]['email'] }}" data-name="{{ $room[6]['name'] }}">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                            <span>
                                                <span class="d-block mb-n1"><b>จอง</b></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-12 text-center card-2 mb-3 room-busy">
                                    <h4 class="mt-3">{{ $room[7]['name'] }}</h4>
                                    <!-- <button type="button" class="btn btn-xs btn-red">ไม่ว่าง</button><br /> -->
                                    <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[7]['id'] }}" data-email="{{ $room[7]['email'] }}" data-name="{{ $room[7]['name'] }}">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                            <span>
                                                <span class="d-block mb-n1"><b>จอง</b></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2 text-center card-1 mb-3 room-free">
                                    <h4 class="mt-3">{{ $room[8]['name'] }}</h4>
                                    <!-- <button type="button" class="btn btn-xs btn-lime">ว่าง</button><br /> -->
                                    <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[8]['id'] }}" data-email="{{ $room[8]['email'] }}" data-name="{{ $room[8]['name'] }}">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                            <span>
                                                <span class="d-block mb-n1"><b>จอง</b></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2 text-center card-1 mb-3 room-busy">
                                    <h4 class="mt-3">{{ $room[9]['name'] }}</h4>
                                    <!-- <button type="button" class="btn btn-xs btn-red">ว่าง</button><br /> -->
                                    <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[9]['id'] }}" data-email="{{ $room[9]['email'] }}" data-name="{{ $room[9]['name'] }}">
                                        <span class="d-flex align-items-center text-left">
                                            <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                            <span>
                                                <span class="d-block mb-n1"><b>จอง</b></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        @for($i = 10; $i < 15; $i++) <div class="col-md-2 text-center card-1 mb-3 room-free">
                            <h4 class="mt-3">{{ $room[$i]['name'] }}</h4>
                            <!-- <button type="button" class="btn btn-xs btn-lime">ว่าง</button><br /> -->
                            <button type="button" class="btn btn-info mt-3 btn-booking" data-token="{{ Session::token() }}" data-id="{{ $room[$i]['id'] }}" data-email="{{ $room[$i]['email'] }}" data-name="{{ $room[$i]['name'] }}">
                                <span class="d-flex align-items-center text-left">
                                    <i class="fa fa-paper-plane text-theme mr-2 text-white"></i>
                                    <span>
                                        <span class="d-block mb-n1"><b>จอง</b></span>
                                    </span>
                                </span>
                            </button>
                    </div>
                    @endfor
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
</script>
@endsection