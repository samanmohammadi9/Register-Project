@extends('master')
@section('contents')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    پروژه {{$project->title}}
                    <span class="d-block text-muted pt-2 font-size-sm">
                        مشاهده یا ویرایش پروژه و فاز های آن
                    </span>
                </h3>
            </div>
        </div>

        <form method="post" id="product_form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="card-body">
                <div class="col-md-6">
                    <div style="float: left" class="form-group">
                        <label>نام دانشجو</label>
                        <input value="{{auth('student')->user()->first_name}}" readonly class="form-control" placeholder="نام کوچک خود را وارد کنید"/>
                    </div>
                    <div style="float: right" class="form-group">
                        <label>نام خانوادگی دانشجو</label>
                        <input value="{{auth('student')->user()->last_name}}" readonly class="form-control" placeholder="نام خانوادگی خود را وارد کنید"/>
                    </div>
                    <div class="form-group">
                        <input value="{{auth('student')->user()->sid}}" readonly class="form-control" placeholder="شماره دانشجویی خود را وارد کنید"/>
                    </div>
                </div>

                <div class="form-group">
                    <label>نام پروژه</label>
                    <input name="title" class="form-control" @if($project->status=='approved') readonly @endif @if(isset($project)) value="{{$project->title}}" @endif placeholder="عنوان پروژه را وارد کنید"/>
                    <span class="form-text text-muted">عنوان پروژه درس خود را وارد کنید</span>
                </div>
                <div class="form-group">
                    <label >انتخاب استاد</label>
                    <select @if($project->status=='approved') disabled @endif id="teacher" onchange="check_teacher()" class="custom-select" name="teacher">
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->fullName}}">
                                {{$teacher->fullName}}
                            </option>
                        @endforeach
                        <option selected value="0">
                            سایر اساتید (نام را وارد کنید)
                        </option>
                    </select>
                    <label>نام استاد</label>
                    <input id="teacher_name" value="{{$project->teacher_name}}" @if($project->status=='approved') readonly @endif  name="teacher_name" class="form-control" placeholder="استاد..."/>
                    <span class="form-text text-muted">نام استاد خود را وارد کنید</span>
                </div>
                <div class="form-group">
                    <label>شرح پروژه</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        @if($project->status=='pending')
                            <textarea @if($project->status=='approved') readonly @endif class="summernote" name="description" id="kt_summernote_1">
                                {{$project->description}}
                            </textarea>
                        @else
                            <p>
                                {{$project->description}}
                            </p>
                        @endif
                    </div>
                </div>
                <label>تاریخ تحویل نهایی پروژه</label>
                @php($year=explode('/',$project->due_date)[0])
                @php($month=explode('/',$project->due_date)[1])
                @php($day=explode('/',$project->due_date)[2])
                <div class="form-inline">
                    <div class="form-group mr-4">
                        <input type="number" min="1400" max="1410" name="year" @if($project->status=='approved') readonly @endif value="{{$year}}" class="form-control" placeholder="سال"/>
                        <label> سال </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" min="1" max="12" name="month" @if($project->status=='approved') readonly @endif value="{{$month}}" class="form-control" placeholder="ماه"/>
                        <label> ماه </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" min="1" max="31" name="day" @if($project->status=='approved') readonly @endif value="{{$day}}" class="form-control" placeholder="روز"/>
                        <label> روز </label>
                    </div>

                </div>
            </div>
            @if($project->status=='pending')
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                </div>
            @else
                <h4 class="text-danger">
                    پروژه تایید شده است.پس از تایید استاد قابلیت ویرایش وجود ندارد.
                </h4>
            @endif
        </form>
    </div>
    <!--end::Card-->

    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    فاز های پروژه
                    <span class="d-block text-muted pt-2 font-size-sm">
                        لیست همه فاز های ارسال شده پروژه
                    </span>
                </h3>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="/student/projects/{{$project->id}}/phases/new" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>افزودن فاز جدید</a>
                <!--end::Button-->
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
                    <th title="Field #2">عنوان فاز</th>
                    <th title="Field #4">تاریخ ارسال</th>
                    <th title="Field #5">وضعیت</th>
                    <th title="Field #6">مشاهده</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phases as $phase)
                    <tr>
                        <td>{{$phase->id}}</td>
                        <td>{{$phase->title}}</td>
                        <td>{{\Carbon\Carbon::now()->diffInDays($phase->created_at)}} روز پیش</td>
                        <td>{{$phase->status=='pending'?'در انتظار تایید':'تایید شده (غیر قابل ویرایش)'}}</td>
                        <td><a href="/student/projects/{{$project->id}}/phases/{{$phase->id}}"><i class="fa fa-edit"></i></a></td>
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
    <script>
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote({
                    height: 150
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSummernoteDemo.init();
        });
    </script>
    <script>
        function check_teacher() {
            if($('#teacher').val()=='0'){
                $('#teacher_name').prop('disabled',false);
            }
            else{
                $('#teacher_name').prop('disabled',true);
            }
        }
    </script>
@endsection
