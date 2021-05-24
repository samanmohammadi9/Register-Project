@extends('master')
@section('contents')
    <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header align-items-center px-4 py-3" >
                <div class="text-left flex-grow-1">
                    <!--begin::Aside Mobile Toggle-->

                    <!--end::Aside Mobile Toggle-->
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown dropdown-inline">
                                           </div>
                    <!--end::Dropdown Menu-->
                </div>
                <div class="text-center flex-grow-1">
                    <div class="text-dark-75 font-weight-bold font-size-h5">{{$teacher->fullName}}</div>
                    <div>
                        <span class="label label-sm label-dot label-success"></span>
                        <span class="font-weight-bold text-muted font-size-sm">Active</span>
                    </div>
                </div>
                <div class="text-right flex-grow-1">
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown dropdown-inline">

                    </div>
                    <!--end::Dropdown Menu-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Scroll-->
                <div class="scroll scroll-pull" data-mobile-height="350">
                    <!--begin::Messages-->
                    <div class="messages">
                        @if(count($messages)==0)
                            <div class="text-center">
                                <h5 class="text-warning">
                                    هیچ پیامی در این گفتگو موجود نیست
                                </h5>
                            </div>
                        @endif
                        @foreach($messages as $message)
                            @if($message['type']=='s_t')
                                <div class="d-flex flex-column mb-5 align-items-end">
                                    <div class="d-flex align-items-center">
                                        <div style="text-align: right;direction: rtl">
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">شما</a>
                                            <span class="text-muted font-size-sm">{{\Carbon\Carbon::now()->diffInMinutes($message['created_at'])}} دقیقه پیش </span>
                                        </div>
                                        <div class="symbol symbol-circle symbol-40 ml-3">
                                            <img alt="Pic" src="/assets/images/student.jpg" />
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                        {{$message['text']}}
                                    </div>
                                </div>
                            @else
                                <div class="d-flex flex-column mb-5 align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40 mr-3">
                                            <img alt="Pic" src="/assets/images/teacher.png" />
                                        </div>
                                        <div style="direction: rtl;text-align: right">
                                            <span class="text-muted font-size-sm"> {{\Carbon\Carbon::now()->diffInMinutes($message['created_at'])}} دقیقه پیش </span>
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$teacher->fullName}}</a>
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                        {{$message['text']}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <!--end::Message In-->
                    </div>
                    <!--end::Messages-->
                </div>
                <!--end::Scroll-->
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer align-items-center">
                <!--begin::Compose-->
                <form method="POST">
                    @csrf
                    <textarea style="direction: rtl;text-align: right" name="message" class="form-control border-0 p-0" rows="2" placeholder="پیام خود را تایپ کنید"></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <div>
                            <button type="submit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">ارسال</button>
                        </div>
                    </div>
                </form>
                <!--begin::Compose-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Card-->
    </div>
@endsection
@section('scripts')
    <script src="/assets/js/widgets.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function () {
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
            },3000);
        });
    </script>
@endsection
