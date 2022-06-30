
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="row">
<div class="col-lg-12 margin-6">
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
  
        <form class="form-inline my-2 my-lg-0" method="get" action="{{url('/gate/PermitedStudent')}}">
          <input type="search" class="form-control mr-sm-2" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type=submit>  <i class="fas fa-search fa-fw"></i></button>
            </form>
               <h1 style="margin-left:20%!important" class="col-md-6">Permited</h1>
              </div>
              
  
    <div class="card-body">
    
             <table id="example1" class="table table-bordered table-striped">
           
               <tbody>
               
               @foreach($searchStud as $a)
               <tr>
             
             <td><img src="{{asset ('uploads/profile/righticon1.jpg')}}" width="200px" height="400px" alt=""></td>
             <td>
             <a class="btn btn-info" href="{{ route('student.show',$a->id) }}">
               <img src="{{asset ('uploads/profile/'.$a->image )}}" width="400px" height="400px" alt=""></a> 
              
             </td>
             <td><img src="{{asset ('uploads/profile/righticon1.jpg')}}" width="200px" height="400px" alt=""></td>
                <td>
                <form action="{{ route('student.destroy',$a->id) }}" method="POST">   
                
                </tr>
                 @csrf
                 @method('DELETE')      
            <td>    
             </form>
        </td>
         @endforeach
               </tbody>
            
             </table>
           </div>
          </div>
           </div>
         </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
