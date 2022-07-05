@extends('layouts.sidebar')
@section('content')


<main class="mx-auto">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                        <h4>
                            Update Project
                        </h4>

                </div>

                <div class="card-body">
                    <form action="{{ url('update-project/'.$key) }}" method="POST" id="createProject">
                          
                             @csrf 
                             @method('PUT')
                        

                             <div class="form-group mb-3">
                                <label>Client Name</label>
                                <input type="text" id="clientName" name="clientName" value="{{$editdata['clientName']}}" class="form-control" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Project Name</label>
                                <input type="text" id="projectName" name="projectName"  value="{{$editdata['projectName']}}" class="form-control" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Location</label>
                                <input type="text" id="location" name="location"  value="{{$editdata['location']}}" class="form-control" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Gewerk</label>
                                <input type="text" id="gewerk" name="gewerk"  value="{{$editdata['gewerk']}}" class="form-control" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Id</label>
                                <input type="text" id="id" name="id"  value="{{$editdata['id']}}" class="form-control" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Date of Start</label>
                                <input type="date" onkeydown="return false" id="dateOfStart" name="dateOfStart"  value="{{$editdata['dateOfStart']}}" class="form-control"  required >
                            </div>
    
                            <div class="form-group mb-3">
                                <label>Date of End</label>
                                <input type="date" onkeydown="return false" id="dateOfEnd" name="dateOfEnd"  value="{{$editdata['dateOfEnd']}}" class="form-control"  required >
                            </div>

                        <div class="form-group mb-3">
                            <button type="submit" id="createProjectButton" class="btn btn-primary"> UPDATE </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection



<script>


var today = new Date().toISOString().split('T')[0];
document.getElementsByName("dateOfStart")[0].setAttribute('min', today);

var today = new Date().toISOString().split('T')[0];
document.getElementsByName("dateOfEnd")[0].setAttribute('min', today);


</script>
{{-- @push('script')
<script>

$(document).ready(function(){

        var firebaseConfig = {
            apiKey: "{{ config('services.firebase.apikey')}}",
            authDomain: "{{ config('services.firebase.authDomain')}}",
            databaseURL: "{{ config('services.firebase.databaseURL')}}",
            projectId: "{{ config('services.firebase.projectId')}}",
            storageBucket: "{{ config('services.firebase.storageBucket')}}",
            messagingSenderId: "{{ config('services.firebase.messagingSenderId')}}",
            appId: "{{ config('services.firebase.appId')}}",
            measurementId: "{{ config('services.firebase.measurementId')}}"
};

 // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  var tableIndex = 0;
  var lastUserId = 0;
  var database = firebase.database();



  $(#createUserButton).on('click', function(){
      var userRowData = $('#createUser').serializeArray();
      var email= document.getElementById('email').value;
      var fName= document.getElementById('firstName').value;
      var lName= document.getElementById('lasttName').value;

      var userId = lastUserId + 1;


      if(email=='')
      {
          alert("Email is required");
          $('#email').focus();
          return false;
      }
      else if(fName=='')
      {
          alert("First name is required");
          $('#firstName').focus();
          return false;
      }
      else if(lName=='')
      {
          alert("Last name is required");
          $('#lastName').focus();
          return false;
      }

      //Insert Data into Firebase
      firebase.database().ref('users/' + userId).set([
          email: email,
          firstName: fName,
          lastName: lName,

      ]);

      lastUserId = userId;


      console.log(userRowData)
      return false
  });

});

        


</script>
    
@endpush --}}
