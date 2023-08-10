@extends('layouts.master')

@section('css')
@endsection



@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
    @section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        اضافة فاتورة</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
    @endsection
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive table-desi">
                            <form class="needs-validation"
                                action="{{ route('dashboard.categories.update', $category->id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="form">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">الإسم :</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="name" value="{{ $category->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">القسم الرئيسي </label>
                                        <select name="parent_id" id="" class="form-control">
                                            <option value="">قسم رئيسي</option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>
                                                    {{ $parent->name }}</option>
                                                {{-- @endif --}}
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- @endif --}}

                                    <div class="form-group mb-0">
                                        <label for="validationCustom02" class="mb-1">الصورة :</label>
                                        <input class="form-control dropify" id="validationCustom02" type="file"
                                            name="image" data-default-file="{{ asset($category->image) }}">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>





@endsection


@section('js')
@endsection
