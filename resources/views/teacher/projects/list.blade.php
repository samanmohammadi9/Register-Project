@extends('master')
@section('contents')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">پروژه ها
                    <span class="d-block text-muted pt-2 font-size-sm">لیست همه پروژه های دانشجو</span></h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table style="direction: rtl" class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">ردیف</th>
                    <th title="Field #3">نام دانشجو</th>
                    <th title="Field #2">عنوان پروژه</th>
                    <th title="Field #4">تاریخ اتمام</th>
                    <th title="Field #5">وضعیت</th>
                    <th title="Field #6">مشاهده</th>
                    <th title="Field #7">تایید</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->student->fullName}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->due_date}}</td>
                        <td>{{$project->status=='pending'?'در انتظار تایید':'تایید شده'}}</td>
                        <td><a href="/teacher/projects/{{$project->id}}"><i class="fa fa-eye"></i></a></td>
                        <td><a @if($project->status=='pending') href="/teacher/projects/{{$project->id}}/approve" @endif><i class="fa fa-check"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script src="/assets/js/html-table.js?v=7.0.3"></script>
@endsection
