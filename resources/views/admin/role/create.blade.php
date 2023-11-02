@extends('layouts.admin_layout')

@push('style')
    <style>
        input.chk-btn {
            display: none;
        }
        input.chk-btn + label {
            border: 1px solid gray;
            background: ghoswhite;
            padding: 5px 8px;
            cursor: pointer;
            border-radius: 5px;
        }
        input.chk-btn:not(:checked) + label:hover {
            box-shadow: 0px 1px 3px;
        }
        input.chk-btn + label:active, input.chk-btn:checked + label {
            box-shadow: 0px 0px 3px inset;
            background: #eee;
        }

    </style>
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Role</h1>

    <form action="{{ route('role.storerole') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <label for="">Role</label>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="ro" placeholder="Role Name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            

            <div class="form-group col-md-12 col-xs-6 col-sm-6 col-lg-12">
                <div class="card {{ $errors->has('permission') ? 'border-danger' : '' }}">
                    <div class="card-header">
                        Permissions - 
                        <input type="checkbox" id='selectall' class='chk-btn' />
                        <label for='selectall'>Select All</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="permission[]"  type="checkbox" id="permission-{{ $permission->id }}" value="{{ $permission->name }}" {{ (collect(old('permission'))->contains($permission->name) ? "checked" : "") }}> 
                                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @error('permission')
                    <p class="text-danger">Permission cannot be blank</p>
                @enderror
            </div>
        </div>

        
        <button type="submit" class="btn btn-dark">Create</button>
    </form>
@endsection


@push('scripts')
<script>
    $("#selectall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endpush