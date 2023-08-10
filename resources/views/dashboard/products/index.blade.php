@extends('layouts.master')

@section('css')
    <style>
        table td,
        table th {
            vertical-align: middle
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <form class="form-inline search-form search-box">

                        </form> --}}

                            <a class="btn btn-primary mt-md-0 mt-2" href="{{ route('dashboard.products.create') }}">إضافة
                                منتج جديد</a>


                        </div>

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
                                <table class="table all-package table-category " id="editableTable">
                                    <thead>
                                        <tr>
                                            <th>الإسم</th>
                                            <th>القسم </th>
                                            <th>السعر الأساسي</th>
                                            <th>التخفيض الأساسي</th>
                                            <th>image</th>
                                            <th>عدد الألوان المتوفرة</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td><img style="height: 80px; width: 70px"
                                                        src="{{ asset($product->image) }}" alt=""></td>
                                                {{-- <td>{{ $product->category_id }}</td> --}}
                                                <td>{{ $product->discount_price }}</td>
                                                <td>{{ $product->product_color_count }}</td>
                                                {{-- <td><img style="height: 80px; width: 70px" src="{{ Storage::url('images/' . $product->image) }}" alt=""></td> --}}
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                            {{-- onclick="editProduct(event)" data-bs-toggle="modal"
                                                            data-bs-target="#EditProduct" data-name="{{ $product->name }}"
                                                            data-description="{{ $product->description }}"
                                                            data-price="{{ $product->price }}"
                                                            data-image="{{ asset($product->image) }}"
                                                            data-discount_price="{{ $product->discount_price }}"
                                                            data-product_color_count="{{ $product->product_color_count }}"
                                                            href="{{ route('dashboard.products.update', $product->id) }}" --}} class="btn btn-info">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" onclick="confirmDestroy({{ $product->id }},this)"
                                                            class="btn btn-outline-success">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No data found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>



    <!-- Modal -->
    <div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit product</h1>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        @csrf
                        <div class="col-12">

                            @if ($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">القسم</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">اختر القسم</option>
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @foreach ($category->child as $child)
                                            <option value="{{ $child->id }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;{{ $child->name }}</option>
                                        @endforeach
                                    @endforeach --}}
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">
                                    الصورة الرئيسية للمنتج</label>
                                <input class="form-control dropify" id="oldimg" type="file" name="image">
                                {{-- <img id="oldimg" src="" alt="" width="80px"> --}}
                            </div>


                            <div class="form-group">
                                <label for="validationCustom01" class="col-form-label pt-0">
                                    اسم المنتج</label>
                                <input class="form-control" id="validationCustom01" type="text" name="name">
                            </div>


                            <div class="form-group">
                                <label class="col-form-label">وصف المنتج</label>
                                <textarea rows="5" cols="12" class="form-control" name="description">{{ $setting->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02" class="col-form-label">
                                    السعر الأساسي للمنتج </label>
                                <input class="form-control" id="validationCustom02" type="text" name="price">
                            </div>

                            <div class="form-group">
                                <label for="validationCustom02" class="col-form-label">
                                    التخفيض الأساسي للمنتج </label>
                                <input class="form-control" id="validationCustom02" type="text" name="discount_price">
                            </div>

                            <div class="form-group">
                                <label for="validationCustom02" class="col-form-label">
                                    الألوان المتاحة للمنتج </label>
                                <select class="form-control colors" multiple="multiple" name="colors[]">
                                </select>
                            </div>

                        </div>

                        {{-- <div class="form-group">
                            <button class="btn btn-primary" type="submit">حفظ</button>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit">تعديل</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDestroy(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, reference);
                }
            })
        }

        function destroy(id, reference) {
            axios.delete('/dashboard/products/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    reference.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showMessage(error.response.data);
                })
                .finally(function() {
                    // always executed
                });
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        @if (session('success'))
            Toast.fire({
                icon: '{{ session('icon') }}',
                title: '{{ session('success') }}'
            })
        @endif
    </script>

    <script>
        function editProduct(e) {

            let url = e.target.closest('a').href
            let name = e.target.closest('a').dataset.name
            let description = e.target.closest('a').dataset.description
            let price = e.target.closest('a').dataset.price
            let image = e.target.closest('a').dataset.image
            let discount_price = e.target.closest('a').dataset.discount_price
            let product_color_count = e.target.closest('a').dataset.product_color_count

            document.querySelector('[name=name]').value = name
            // document.querySelector('#oldimg').defaultFile = image
            document.querySelector('[name=description]').value = description
            document.querySelector('[name=price]').value = price
            document.querySelector('[name=discount_price]').value = discount_price
            document.querySelector('[name=name]').value = product_color_count

            var drEvent = $('#oldimg').dropify({
                defaultFile: image
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = image;
            drEvent.destroy();
            drEvent.init();

        }


        $(document).ready(function() {
            $(".colors").select2({
                tags: true
            });
        });
    </script>
@endsection
