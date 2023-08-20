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
                                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="col-12">

                                        @if ($errors->any())
                                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                                        @endif

                                        <div class="form-group">
                                            <label for="validationCustomtitle" class="col-form-label pt-0">Category
                                                :</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option value="">{{ $product->category->parent->name }}</option>
                                                @foreach ($parents as $parent)
                                                    <option value="{{ $parent->id }}" @selected($product->category_id == $parent->id)>
                                                        {{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="validationCustom05" class="col-form-label pt-0">
                                                Main image of the product :</label>
                                            <input class="form-control dropify" id="validationCustom05" type="file"
                                                name="image" data-default-file="{{ asset($product->image) }}">
                                        </div>


                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0">
                                                Product Name :</label>
                                            <input class="form-control" id="validationCustom01" type="text"
                                                name="name" value="{{ $product->name }}">
                                        </div>


                                        <div class="form-group">
                                            <label class="col-form-label">Product description :</label>
                                            <textarea rows="5" cols="12" class="form-control" name="description">{{ $product->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                The base price of the product :</label>
                                            <input class="form-control" id="validationCustom02" type="text"
                                                name="price" value="{{ $product->price }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                discount value :</label>
                                            <input class="form-control" id="validationCustom02" type="text"
                                                name="discount_price" value="{{ $product->discount_price }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                                Available colors of the product :</label>
                                            <select class="form-control colors" multiple="multiple" name="colors[]">
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>



                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update</button>
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
