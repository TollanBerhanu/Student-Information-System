{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Manage {{$role['name']}} privileges
            </h3>
        </div>
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("role_privilegeHandle") }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    @if ($errors->any())
                        <div class="alert alert-danger col-10 mx-auto">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <h3 class="card-title">
                        System: {{$role['system']['name']}}
                    </h3>
                </div>
                    <input type="hidden" name="id" value="{{$role['id']}}" />
                    <input type="hidden" name="data" value="{{ old('data') ? old('data') : $role['active_privilege']}}" id="role_privilege_data_array"/>
                    <div class="form-group row">
                    @foreach ($privileges as $privilege)
                        <label class="col-3 col-form-label">{{$privilege['name']}}</label>
                        <div class="col-3">
                           <span class="switch switch-sm switch-icon">
                            <label>
                             <input type="checkbox" onchange="privilege_selection(this)" id="{{'role_'.$privilege['id']."_privilege"}}" value="{{$privilege['id']}}" />
                             <span></span>
                            </label>
                           </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(Session::has('notification'))//this line works as expected

        var type = "{{ Session::get('alert_type', 'info') }}";
        //but the type var gets assigned with default value(info)
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;
        }
        @endif

        function privilege_selection(cb){
            let data = document.getElementById('role_privilege_data_array').value;
            data = JSON.parse(data);
            if(cb.checked){
                if(data.indexOf(cb.value) === -1){
                    data.push(cb.value);
                }
            }
            else {
                let temp = [];
                for(let item of data){
                    if(item !== cb.value){
                        temp.push(item);
                    }
                }
                data = temp;
            }
            // console.log(data);
            document.getElementById('role_privilege_data_array').value = JSON.stringify(data);
        }

        window.addEventListener('load', function (){
            let data = document.getElementById('role_privilege_data_array').value;
            data = JSON.parse(data);
            let temp = [];
            for(let item of data){
                temp.push(item+'');
                try{
                    // console.log(item);
                    document.getElementById('role_' + item + '_privilege').checked = true;
                    // console.log(item + " Done");
                }
                catch (ignored){}
            }
            document.getElementById('role_privilege_data_array').value = JSON.stringify(temp);
        })

    </script>
@endsection
