

@extends('layouts.sidebar')

@section('content')
  {{-- Error and Status Card --}}

  @if(Session::has('message'))
    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
      <strong>{{ Session::get('message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <strong>{{$error}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endforeach
  @endif

  <div class="container">
    <div class="row">
      {{-- Uplode form and picture  --}}
      <div class="col-lg-6">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Upload Image</h3><br>
            {!! Form::open(['action' => 'App\Http\Controllers\ImageController@store', 'method' => 'POST' , 'files'=>true]) !!}

            <div class="form-group">
              {!! Form::label('image', 'Uplode Picture') !!}
              <br>
              {!! Form::file('image', null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}


            
          </div>
        </div>
      </div>
      {{-- <div class="col-lg-6 pt-lg-0 pt-3">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Image fetched from Firebase Storage.</h3>
            <img src="{{ $image }}" class="img-fluid" alt="Responsive image">
            <br>
            <a href="{{ $image }}">Link generated from Firebase</a>
            {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\ImageController@destroy',"delete"]]) !!}
            <div class="form-group pt-2">
              {!! Form::submit('Delete Image', ['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div> --}}



  <table id="table" data-toggle="table" data-toolbar="#toolbar"
  data-classes="table table-striped table-condensed" data-sort-name="Manager" data-search="true"
  data-sort-order="asc" data-pagination="true" data-show-export="true" data-click-to-select="true"
  data-row-style="rowNos" data-page-list="[10, 25, 50, 100, all]" data-show-export="true"
  data-id-field="id" data-response-handler="responseHandler" data-filter-control="true"
  data-hide-unused-select-options="true" data-detail-view-icon="false" data-show-columns="true">



  <thead>
      <tr>
          <th>Uploaded by/Employee Email</th>
          <th>Image</th>


          {{-- <th>EDIT</th> --}}
          <th>DELETE</th>
      </tr>
  </thead>
  <tbody>
    @if (is_array($images) || is_object($images))
      @forelse ($images as $key => $item)
          <tr>

              {{-- SHOW IMAGE URL --}}
              {{-- <td><a href="{{ $item['imageURL'] }}" target="_blank">{{ $item['imageURL'] }}</a></td> --}}
              
              <td>{{ $item['userEmail'] }}</td>

              {{-- SHOW IMAGE USING URL --}}
              <div id="thumpwrap">
              <td><a class="thumb" href="{{url($item['imageURL'])}}" target="_blank"><img src ="{{ $item['imageURL'] }}" height="130px" width="110px"><span><img src={{ $item['imageURL'] }} alt=""></span></a></td>
              </div>
              {{-- <td><a href="{{ url('edit-img/' . $key) }}" class="btn btn-sm btn-success"> EDIT</a></td> --}}


              <td>
                {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\ImageController@destroy',"delete"]]) !!}


                <div class="form-group pt-2">
                  {!! Form::submit('Delete Image', ['class'=>'btn btn-danger']) !!}
                </div>
              </td>

              {{-- <form action="{{ url('delete-img/' . $key) }}" method="POST">
                @csrf
            </form> --}}

          </tr>
      @empty
          <tr>
              <td colspan="7">No Record Found</td>
          </tr>


          
      @endforelse
      @endif
  </tbody>


</table>



@endsection()
