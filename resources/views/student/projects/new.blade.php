@extends('master')
@section('contents')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                تعریف پروژه جدید
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form method="post" id="product_form" action="@if(!isset($project))/student/projects/store @else /student/projects/{{$project->id}}/update @endif">
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
                    <input name="title" class="form-control" placeholder="عنوان پروژه را وارد کنید"/>
                    <span class="form-text text-muted">عنوان پروژه درس خود را وارد کنید</span>
                </div>
                <div class="form-group">
                    <label >انتخاب استاد</label>
                    <select id="teacher" onchange="check_teacher()" class="custom-select" name="teacher">
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->fullName}}">
                                {{$teacher->fullName}}
                            </option>
                        @endforeach
                        <option value="0">
                            سایر اساتید (نام را وارد کنید)
                        </option>
                    </select>
                    <label>نام استاد</label>
                    <input id="teacher_name" disabled name="teacher_name" class="form-control" placeholder="استاد..."/>
                    <span class="form-text text-muted">نام استاد خود را وارد کنید</span>
                </div>
                <div class="form-group">
                    <label>شرح پروژه</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea class="summernote" name="description" id="kt_summernote_1">

                        </textarea>
                    </div>
                </div>
                <label>تاریخ تحویل نهایی پروژه</label>
                <div class="form-inline">
                    <div class="form-group mr-4">
                        <input type="number" min="1400" max="1410" name="year" class="form-control" placeholder="سال"/>
                        <label> سال </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" min="1" max="12" name="month" class="form-control" placeholder="ماه"/>
                        <label> ماه </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" min="1" max="31" name="day" class="form-control" placeholder="روز"/>
                        <label> روز </label>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                <button type="reset" class="btn btn-secondary">انصراف</button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection
@section('scripts')
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
