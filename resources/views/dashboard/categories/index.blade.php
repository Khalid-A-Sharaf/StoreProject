@extends('layouts.blank')

@section('css')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 20px
        }
    </style>
    {{-- <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet"> --}}
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة قسم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    <div class="page-body">
        <!-- Container-fluid starts-->
        {{-- <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>أقسام المنتجات
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Digital</li>
                        <li class="breadcrumb-item active">Sub Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> --}}
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <form class="form-inline search-form search-box">

                        </form>
                        <div class="card-header">
                            {{-- <div class="btn-group"> --}}
                            {{-- <a href="{{ route('dashboard.categories.trash') }}"
                        class="btn btn-info">
                    </a> --}}
                            <div class="d-flex justify-content-between">
                                <a class="modal-effect btn btn-outline-primary" data-effect="effect-scale"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" href="">
                                    <i class="fas fa-plus" style="padding-left: 8px"></i> Create Category</a>
                            </div>
                            {{-- </div> --}}
                        </div>


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <div class="table-responsive table-desi">
                                <table class="table table-bordered dataTable" style="text-align: center" role="grid"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>الإسم</th>
                                            <th>الصورة</th>
                                            <th>نوع القسم</th>
                                            <th>الاعدادات</th>

                                        </tr>
                                    </thead>

                                    <tbody id="table">
                                        @foreach ($categories as $category)
                                            <tr>

                                                <td>{{ $category->name }}</td>
                                                <td><img style="height: 80px; width: 70px"
                                                        src="{{ asset($category->image) }}" alt="">
                                                </td>
                                                <td>{{ $category->parent->name }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="#" onclick="confirmDestroy({{ $category->id }},this)"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->withQueryString()->links() }}
                            </div> --}}


                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table caption-top table-hover" style="text-align: center" id="dataTable"
                                        width="100%" cellspacing="0">

                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td><img style="height: 80px; width: 70px"
                                                            src="{{ asset($category->image) }}" alt=""></td>
                                                    <td>{{ $category->parent->name }}</td>
                                                    <td> <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" onclick="confirmDestroy({{ $category->id }},this)"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                        @php
                                            $i++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data found</td>
                                        </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data" --}}
                    <form id="create-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Create New Category
                            </h5>
                            {{-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button> --}}
                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="validationCustom01" class="m-0">Name :</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter Name"
                                    name="name">
                            </div>


                            <div class="form-group">
                                <label for="validationCustom01" class="mb-1">Main Category :</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="" selected>Main Category</option>
                                    @foreach ($mainCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label for="validationCustom02" class="mb-1">Image :</label>
                                <input class="form-control dropify" id="image" type="file" name="image">
                            </div>

                        </div>

                        {{-- <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div> --}}

                        <div class="modal-footer">
                            <button class="btn btn-success" onclick="store()" type="button">Confirm</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>






    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">تأكيد</button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>
                    </form>
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
            axios.delete('/dashboard/categories/' + id)
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
            timer: 5000,
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
        // window.bootstrap = bootstrap;
        function store() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('parent_id', document.getElementById('parent_id').value);
            formData.append('image', document.getElementById('image').files[0]);
            // formData.append('phone', document.getElementById('phone').value);
            // formData.append('dateted', document.getElementById('dateted').value);
            // formData.append('group', document.getElementById('group').value);
            axios.post('/dashboard/categories', formData)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    Toast.fire({
                        icon: response.data.icon,
                        title: response.data.message
                    })
                    // toastr.success(response.data.message);

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    // toastr.error(error.response.data.message);
                    Toast.fire({
                        icon: error.response.data.icon,
                        title: error.response.data.message
                    })
                })
                .finally(function() {
                    // always executed
                    const truck_modal = document.querySelector('#exampleModal');
                    const modal = bootstrap.Modal.getInstance(truck_modal);
                    modal.hide();
                });
        }
    </script>
@endsection
