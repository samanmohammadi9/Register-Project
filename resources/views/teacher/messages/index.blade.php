@extends('master')
@section('contents')
    <div class=" card card-custom bg-light-success card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-success">دانشجویان</h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
            @foreach($students as $student)
                <!--begin::Item-->
                <div class="d-flex align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-white mr-5">
                        <div class="symbol-label">
                            <img src="/assets/images/student.jpg" class="h-75 align-self-end" alt="" />
                        </div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column font-weight-bold">
                        <a href="/teacher/messages/{{$student->id}}" class="text-dark text-hover-primary mb-1 font-size-lg">{{$student->fullName}}</a>
                        <span class="text-muted">{{$student->sid}}</span>
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection
@section('scripts')
    <script src="/assets/js/widgets.js"></script>
@endsection
