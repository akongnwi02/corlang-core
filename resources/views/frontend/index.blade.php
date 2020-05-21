@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <i class="fas fa-home"></i> @lang('navs.general.home')
        </div>
        <div class="card-body">
            <h1>@lang('strings.frontend.welcome_to', ['place' => app_name()])</h1>
            <div class="row heading heading-icon">
                <h2 style="color: black">@lang('strings.frontend.what_we_do')</h2>
            </div>
            <section id="what-we-do">
                <div class="container-fluid">
                    <p class="text-center text-muted h5">@lang('strings.frontend.what_we_do_details.tagline')</p>
                    <div class="row mt-5">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="card-block block-1">
                                    <h3 class="card-title">@lang('strings.frontend.what_we_do_details.agent.title')</h3>
                                    <p class="card-text">@lang('strings.frontend.what_we_do_details.agent.description')</p>
                                    {{--<a href="https://www.fiverr.com/share/qb8D02" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="card-block block-2">
                                    <h3 class="card-title">@lang('strings.frontend.what_we_do_details.biller.title')</h3>
                                    <p class="card-text">@lang('strings.frontend.what_we_do_details.biller.description')</p>
                                    {{--<a href="https://www.fiverr.com/share/qb8D02" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="card-block block-3">
                                    <h3 class="card-title">@lang('strings.frontend.what_we_do_details.distributor.title')</h3>
                                    <p class="card-text">@lang('strings.frontend.what_we_do_details.distributor.description')</p>
                                    {{--<a href="https://www.fiverr.com/share/qb8D02" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!--col-->
    </div><!--row-->
    <div class="row mb-4">
        <div class="card-body">
            <div class="row heading heading-icon">
                <h2 style="color: black">@lang('strings.frontend.our_services')</h2>
            </div>
            <section>
                <div class="container">
                    <div class="row mbr-justify-content-center">

                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fas fa-bolt"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.prepaid_bills.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.prepaid_bills.description')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-globe fa"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.postpaid_bills.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.postpaid_bills.description')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fas fa-money-bill-alt"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.mobile_money.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.mobile_money.description')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fas fa-mobile"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.airtime_recharge.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.airtime_recharge.description')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fas fa-ticket-alt"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.ticket.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.ticket.description')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mbr-col-md-10">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa fa-shopping-cart"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">@lang('strings.frontend.services.ecommerce.title')
                                    </h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">@lang('strings.frontend.services.ecommerce.description')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!--col-->
    </div><!--row-->

    <div class="row mb-4 justify-content-center">
        <div style="width: 100%;">
            <div class="row heading heading-icon text-center">
                <h1 style="color: black">@lang('strings.frontend.how_to_become_a_partner')</h1>
            </div>
            <ul class="progressbar">
                <li class="active"><a href="{{route('frontend.contact')}}">@lang('strings.frontend.partner.steps.1')</a></li>
                <li>@lang('strings.frontend.partner.steps.2')</li>
                <li>@lang('strings.frontend.partner.steps.3')</li>
                <li>@lang('strings.frontend.partner.steps.4')</li>
            </ul>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col">
            <section class="our-webcoderskull padding-lg">
                <div class="container">
                    <div class="row heading heading-icon">
                        <h2>@lang('strings.frontend.our_partners')</h2>
                    </div>
                    <ul class="row">
                        <li class="col-12 col-md-6 col-lg-3">
                            <div class="cnt-block equal-hight" style="height: 349px;">
                                <figure><img src="{{url('img/frontend/brand/partner/orange-money.jpg')}}" class="img-responsive" alt=""></figure>
                                <h3>Orange Money</h3>
                                <p>Withdrawal / Retrait</p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 col-lg-3">
                            <div class="cnt-block equal-hight" style="height: 349px;">
                                <figure><img src="{{url('img/frontend/brand/partner/mtn-momo.jpg')}}" class="img-responsive" alt=""></figure>
                                <h3>MTN Mobile Money</h3>
                                <p>Cashin - Cashout / Dépôt - Retrait</p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 col-lg-3">
                            <div class="cnt-block equal-hight" style="height: 349px;">
                                <figure><img src="{{url('img/frontend/brand/partner/express-union.png')}}" class="img-responsive" alt=""></figure>
                                <h3>Express Union</h3>
                                <p>Express Union Services / Services Express Union</p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 col-lg-3">
                            <div class="cnt-block equal-hight" style="height: 349px;">
                                <figure><img src="{{url('img/frontend/brand/partner/iat-prepaid.jpg')}}" class="img-responsive" alt=""></figure>
                                <h3>IAT Global</h3>
                                <p>Prepaid electricity / Électricité prépayée</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div><!--col-->
    </div><!--row-->

    {{--<div class="row">--}}
        {{--<div class="col">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<i class="fab fa-font-awesome-flag"></i> Font Awesome @lang('strings.frontend.test')--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<i class="fas fa-home"></i>--}}
                    {{--<i class="fab fa-facebook"></i>--}}
                    {{--<i class="fab fa-twitter"></i>--}}
                    {{--<i class="fab fa-pinterest"></i>--}}
                {{--</div><!--card-body-->--}}
            {{--</div><!--card-->--}}
        {{--</div><!--col-->--}}
    {{--</div><!--row-->--}}
@endsection
@push('after-styles')
    <style>
        section {
            padding-top: 4rem;
            padding-bottom: 5rem;
            background-color: #f1f4fa;
        }


        }
        #what-we-do{
            background:#ffffff;
        }
        #what-we-do .card{
            padding: 1rem!important;
            border: none;
            margin-bottom:1rem;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #what-we-do .card:hover{
            -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        }
        #what-we-do .card .card-block{
            padding-left: 50px;
            position: relative;
        }
        #what-we-do .card .card-block a{
            color: #007b5e !important;
            font-weight:700;
            text-decoration:none;
        }
        #what-we-do .card .card-block a i{
            display:none;

        }
        #what-we-do .card:hover .card-block a i{
            display:inline-block;
            font-weight:700;

        }
        #what-we-do .card .card-block:before{
            font-family: FontAwesome;
            position: absolute;
            font-size: 39px;
            color: #007b5e;
            left: 0;
            -webkit-transition: -webkit-transform .2s ease-in-out;
            transition:transform .2s ease-in-out;
        }
        #what-we-do .card .block-1:before{
            content: "\f0e7";
        }
        #what-we-do .card .block-2:before{
            content: "\f0eb";
        }
        #what-we-do .card .block-3:before{
            content: "\f00c";
        }
        #what-we-do .card .block-4:before{
            content: "\f209";
        }
        #what-we-do .card .block-5:before{
            content: "\f0a1";
        }
        #what-we-do .card .block-6:before{
            content: "\f218";
        }
        #what-we-do .card:hover .card-block:before{
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }

        .wrap {
            display: flex;
            background: white;
            padding: 1rem 1rem 1rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 7px 7px 30px -5px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .wrap:hover {
            background: linear-gradient(135deg, #6394ff 0%, #0a193b 100%);
            color: white;
        }

        .ico-wrap {
            margin: auto;
        }

        .mbr-iconfont {
            font-size: 4.5rem !important;
            color: #313131;
            margin: 1rem;
            padding-right: 1rem;
        }

        .vcenter {
            margin: auto;
        }

        .mbr-section-title3 {
            text-align: left;
        }

        h2 {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .display-5 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1.4rem;
        }

        .mbr-bold {
            font-weight: 700;
        }

        p {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            line-height: 25px;
        }

        .display-6 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1 re
        }



        .row.heading h2 {
            color: #fff;
            font-size: 52.52px;
            line-height: 95px;
            font-weight: 400;
            text-align: center;
            margin: 0 0 40px;
            padding-bottom: 20px;
            text-transform: uppercase;
        }
        ul{
            margin:0;
            padding:0;
            list-style:none;
        }
        .heading.heading-icon {
            display: block;
        }
        .padding-lg {
            display: block;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .practice-area.padding-lg {
            padding-bottom: 55px;
            padding-top: 55px;
        }
        .practice-area .inner{
            border:1px solid #999999;
            text-align:center;
            margin-bottom:28px;
            padding:40px 25px;
        }
        .our-webcoderskull .cnt-block:hover {
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            border: 0;
        }
        .practice-area .inner h3{
            color:#3c3c3c;
            font-size:24px;
            font-weight:500;
            font-family: 'Poppins', sans-serif;
            padding: 10px 0;
        }
        .practice-area .inner p{
            font-size:14px;
            line-height:22px;
            font-weight:400;
        }
        .practice-area .inner img{
            display:inline-block;
        }


        .our-webcoderskull{
            background: url("http://www.webcoderskull.com/img/right-sider-banner.png") no-repeat center top / cover;

        }
        .our-webcoderskull .cnt-block{
            float:left;
            width:100%;
            background:#fff;
            padding:30px 20px;
            text-align:center;
            border:2px solid #d5d5d5;
            margin: 0 0 28px;
        }
        .our-webcoderskull .cnt-block figure{
            width:148px;
            height:148px;
            border-radius:100%;
            display:inline-block;
            margin-bottom: 15px;
        }
        .our-webcoderskull .cnt-block img{
            width:148px;
            height:148px;
            border-radius:100%;
        }
        .our-webcoderskull .cnt-block h3{
            color:#2a2a2a;
            font-size:20px;
            font-weight:500;
            padding:6px 0;
            text-transform:uppercase;
        }
        .our-webcoderskull .cnt-block h3 a{
            text-decoration:none;
            color:#2a2a2a;
        }
        .our-webcoderskull .cnt-block h3 a:hover{
            color:#337ab7;
        }
        .our-webcoderskull .cnt-block p{
            color:#2a2a2a;
            font-size:13px;
            line-height:20px;
            font-weight:400;
        }
        .our-webcoderskull .cnt-block .follow-us{
            margin:20px 0 0;
        }
        .our-webcoderskull .cnt-block .follow-us li{
            display:inline-block;
            width:auto;
            margin:0 5px;
        }
        .our-webcoderskull .cnt-block .follow-us li .fa{
            font-size:24px;
            color:#767676;
        }
        .our-webcoderskull .cnt-block .follow-us li .fa:hover{
            color:#025a8e;
        }




        .progressbar {
            counter-reset: step;
        }

        .progressbar li {
            list-style-type: none;
            float: left;
            width: 33.33%;
            position: relative;
            text-align: center;
        }

        .progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border: 1px solid #ddd;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }

        .progressbar li:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: #ddd;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .progressbar li.active {
            color: green;
        }

        .progressbar li.active:before {
            border-color: green;
        }

        .progressbar li.active + li:after {
            background-color: green;
        }
    </style>
@endpush
