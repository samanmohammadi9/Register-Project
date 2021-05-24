@extends('master')
@section('contents')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    پروژه {{$project->title}}
                    <span class="d-block text-muted pt-2 font-size-sm">
                        مشاهده یا پروژه و فاز های آن
                    </span>
                </h3>
            </div>
        </div>

        <form method="post" id="product_form">
            <div class="card-body">
                <div class="col-md-6">
                    <div style="float: left" class="form-group">
                        <label>نام دانشجو</label>
                        <input value="{{$project->student->first_name}}" readonly class="form-control" placeholder="نام کوچک خود را وارد کنید"/>
                    </div>
                    <div style="float: right" class="form-group">
                        <label>نام خانوادگی دانشجو</label>
                        <input value="{{$project->student->last_name}}" readonly class="form-control" placeholder="نام خانوادگی خود را وارد کنید"/>
                    </div>
                    <div class="form-group">
                        <input value="{{$project->student->sid}}" readonly class="form-control" placeholder="شماره دانشجویی خود را وارد کنید"/>
                    </div>
                </div>

                <div class="form-group">
                    <label>نام پروژه</label>
                    <input name="title" class="form-control" @if($project->status=='approved') readonly @endif @if(isset($project)) value="{{$project->title}}" @endif placeholder="عنوان پروژه را وارد کنید"/>
                </div>
                <div class="form-group">
                    <label >نام استاد</label>
                    <input value="{{$project->teacher_name}}" readonly class="form-control" placeholder="استاد..."/>
                </div>
                <div class="form-group">
                    <label>شرح پروژه</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p>
                            {{$project->description}}
                        </p>
                    </div>
                </div>
                <label>تاریخ تحویل نهایی پروژه</label>
                @php($year=explode('/',$project->due_date)[0])
                @php($month=explode('/',$project->due_date)[1])
                @php($day=explode('/',$project->due_date)[2])
                <div class="form-inline">
                    <div class="form-group mr-4">
                        <input type="number" readonly value="{{$year}}" class="form-control" placeholder="سال"/>
                        <label> سال </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" readonly value="{{$month}}" class="form-control" placeholder="ماه"/>
                        <label> ماه </label>
                    </div>
                    <div class="form-group mr-4">
                        <input type="number" readonly value="{{$day}}" class="form-control" placeholder="روز"/>
                        <label> روز </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Card-->
    <div class="card card-custom gutter-b example-hover">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    فاز های ارسال شده این پروژه
                </h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Accordion-->
            <div class="accordion accordion-toggle-arrow" id="phases">
                @foreach($phases as $phase)
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" data-toggle="collapse" data-target="#phase{{$phase->id}}">
                                {{$phase->title}}
                                @if($phase->status=='approved') (تایید شده)@endif
                            </div>
                            <span class="text-right small ml-10">{{\Carbon\Carbon::now()->diffInDays($phase->created_at)}}</span> روز پیش
                        </div>
                        <div id="phase{{$phase->id}}" class="collapse show" data-parent="#phases">
                            <div class="card-body">
                                {{$phase->explaination}}
                            </div>
                        </div>
                        <div id="phase{{$phase->id}}" class="collapse show ml-4 mb-3" data-parent="#phases">
                            <div class="col-md-2" style="float: left;">
                                <a href="/{{$phase->file}}" class="btn btn-primary">
                                    دانلود پیوست
                                </a>
                            </div>
                            @if($phase->status!='approved')
                                <div class="col-md-10" style="float: right;">
                                    <a href="/teacher/projects/{{$project->id}}/phases/{{$phase->id}}/approve" class="btn btn-primary">
                                        تایید فاز ارسالی
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <!--end::Accordion-->
        </div>
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
