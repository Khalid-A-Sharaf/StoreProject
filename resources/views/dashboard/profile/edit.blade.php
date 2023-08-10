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
                    <h4 class="content-title mb-0 my-auto">Profile</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        Edit Profile</span>
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
                            <form class="needs-validation" action="{{ route('dashboard.profile.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="mb-1">الاسم الاول :</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="first_name" {{-- value="{{ $user->profile->first_name }}" --}}>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="mb-1">الاسم الثاني :</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="last_name" {{-- value="{{ $user->profile->last_name }}" --}}>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="mb-1">تاريخ الميلاد</label>
                                        <input class="form-control" id="validationCustom01" type="date"
                                            name="birthday" {{-- value="{{ $user->profile->birthday }}" --}}>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="mb-1">Gender</label>
                                        <input class="form-control" :options="['male' => 'Male', 'femal' => 'Female']"
                                            id="validationCustom01" {{-- checked="{{ $user->profile->gender }}" --}} type="radio" name="gender"
                                            {{-- value="{{ $category->name }}" --}}>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">Street Address</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="street_address" {{-- value="{{ $user->profile->street_address }}" --}}>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">City</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="city" {{-- value="{{ $user->profile->city }}" --}}>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">State</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="state" {{-- value="{{ $user->profile->state }}" --}}>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">Postal Code</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="postal_code" {{-- value="{{ $user->profile->postal_code }}" --}}>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">Country</label>
                                        <select class="form-control form-select" name="country" {{-- value="{{ $user->profile->country }}" --}}>
                                            {{-- @foreach ($user->profile->country as $value => $text)
                                                <option value="{{ $value }}" @selected($value == $selected)>
                                                    {{ $text }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="mb-1">Locale</label>
                                        <select class="form-control form-select" name="locale" {{-- value="{{ $user->profile->locale }}" --}}>
                                            {{-- @foreach ($user->profile->locale as $value => $text)
                                                <option value="{{ $value }}" @selected($value == $selected)>
                                                    {{ $text }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>


                                {{-- <div class="form-group mb-0">
                                    <label for="validationCustom02" class="mb-1">الصورة :</label>
                                    <input class="form-control dropify" id="validationCustom02" type="file"
                                        name="image" data-default-file="{{ asset($category->image) }}">
                                </div> --}}

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
