@extends('layouts.blank')

@section('css')
@endsection

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

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <form action="{{ route('dashboard.products.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-lg-12">

                                        @if ($errors->any())
                                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 form-input form">
                                                        <label for="validationCustomtitle"
                                                            class="col-form-label pt-0">Category
                                                            :</label>
                                                        <select name="category_id" id="" class="form-control">
                                                            <option value="">Select the category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                                @foreach ($category->child as $child)
                                                                    <option value="{{ $child->id }}">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;{{ $child->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 form-input form">
                                                        <label for="validationCustom01" class="col-form-label pt-0">
                                                            Product Name :</label>
                                                        <input class="form-control" id="validationCustom01" type="text"
                                                            name="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group m-1">
                                                        <label for="validationCustom05" class="col-form-label pt-0">
                                                            Main image of the product :</label>
                                                        <input class="form-control dropify" id="validationCustom05"
                                                            type="file" name="image">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Product description :</label>
                                                <textarea rows="5" cols="12" class="form-control" name="description">{{ $setting->description }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 form-input form">
                                                        <label for="validationCustom02" class="col-form-label">
                                                            The base price of the product :</label>
                                                        <input class="form-control" id="validationCustom02" type="text"
                                                            name="price">
                                                    </div>

                                                    <div class="col-md-6 form-input form">
                                                        <label for="validationCustom02" class="col-form-label">
                                                            discount value :</label>
                                                        <input class="form-control" id="validationCustom02" type="text"
                                                            name="discount_price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label">
                                                            Available colors of the product :</label>
                                                        <select class="form-control colors" multiple="multiple"
                                                            name="colors[]">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group mt-2">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
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
    <script>
        $(document).ready(function() {
            $(".colors").select2({
                tags: true
            });
        });
    </script>
@endsection
