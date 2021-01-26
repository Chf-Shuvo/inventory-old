 @extends('backend.layout.master')

@section('main_content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4"><img src="{{ asset('icons/boy.png') }}" alt=""></div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">BIMS</h5>
                    <h4 class="font-500">100<i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                    <div class="mini-stat-label bg-success">
                        <p class="mb-0">100</p>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="float-right"><a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a></div>
                    <p class="text-white-50 mb-0">Details</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div>-->
<!--    <form action="{{ route('requisition.import') }}" method="POST" enctype="multipart/form-data">-->
<!--        @csrf-->
<!--        <div class="form-group">-->
<!--            <select class="form-control" name="department">-->
<!--                <option value="ICT">ICT</option>-->
<!--                <option value="CSE">CSE</option>-->
<!--            </select>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="file" name="file">-->
<!--            <button type="submit" class="btn btn-primary btn-md">submit</button>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->
@endsection
