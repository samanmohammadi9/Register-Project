@extends('master')
@section('contents')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                @if(isset($phase))
                    ویرایش فاز {{$phase->title}} پروژه
                @else
                    ارسال فاز جدید برای پروژه
                @endif
                    {{$project->title}}
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form method="post" enctype="multipart/form-data" id="product_form" action="@if(isset($phase)) @else /student/projects/{{$project->id}}/phases/new @endif">
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

                <div class="form-group">
                    <label>عنوان فاز</label>
                    <input name="title" @if(isset($phase)) value="{{$phase->title}}" @endif @if($phase->status=="approved") readonly @endif class="form-control" placeholder="عنوان فاز را وارد کنید"/>
                    <span class="form-text text-muted">عنوان فاز ارسالی را وارد کنید</span>
                </div>

                <div class="form-group">
                    <label>تشریح فاز</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        @if(isset($phase) && $phase->status=="approved")
                            <p>
                                {{$phase->explaination}}
                            </p>
                        @else
                            <textarea class="summernote" name="explaination" id="kt_summernote_1">
                                @if(isset($phase)) {{$phase->explaination}} @endif
                            </textarea>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>فایل ارسالی</label>
                    <input type="file"  @if($phase->status=="approved") disabled @endif name="project_file">
                    <span>در صورت وجود بیشتر از یک فایل همه فایل ها را فشرده سازی کنید و فایل زیپ را آپلود کنید</span>
                    @if(isset($phase))
                        <br>
                        <span>
                            در صورتی که فایل جدید آپلود نکنید فایل آپلود شده پیشین بدون تغییر باقی خواهد ماند
                        </span>
                    @endif

                </div>
            </div>
                @if(isset($phase) && $phase->status=='pending')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                    </div>
                @else
                    <h4 class="text-danger">
                        این فاز تایید شده است.پس از تایید استاد قابلیت ویرایش وجود ندارد.
                    </h4>
                @endif
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
@endsection
