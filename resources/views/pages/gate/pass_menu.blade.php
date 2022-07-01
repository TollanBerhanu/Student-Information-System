{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
  
        <form class="form-inline my-2 my-lg-0"style="margin-left: 20%!important" type="get" action="{{url('/gate/student/permitedStudent')}}">
          <input type="search" class="form-control mr-sm-2" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type=submit> Search</button>
            </form>
               
              </div>
              
      
         


@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
