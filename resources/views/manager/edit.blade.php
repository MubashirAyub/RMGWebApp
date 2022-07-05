@extends('layouts.msidebar')
@section('content')


<main class="mx-auto">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                        <h4>
                            Update Member
                        </h4>

                </div>

                <div class="card-body">
                    <form action="{{ url('update-newuser/'.$key) }}" method="POST" id="createUser">
                          
                             @csrf 
                             @method('PUT')
                        



                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="text" id="email" name="email" value="{{$editdata['email']}}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>First Name</label>
                            <input type="text" id="firstName" name="firstName" value="{{$editdata['firstName']}}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input type="text" id="lastName" name="lastName" value="{{$editdata['lastName']}}" class="form-control" required>
                        </div>



                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" id="username" name="username" value="{{$editdata['username']}}"  class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" id="password" name="password" value="{{$editdata['password']}}"  class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Date of Employment</label>
                            <input type="date" onkeydown="return false" id="dateOfEmployment" name="dateOfEmployment" value="{{$editdata['dateOfEmployment']}}"  class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>End of Employment</label>
                            <input type="date" onkeydown="return false" id="endOfEmployment" name="endOfEmployment" value="{{$editdata['endOfEmployment']}}"  class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Health Insurance</label>
                            <input type="text" id="healthInsurance" name="healthInsurance" value="{{$editdata['healthInsurance']}}" value="not entered"  class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>License Number</label>
                            <input type="text" id="licenseNumber" name="licenseNumber" value="{{$editdata['licenseNumber']}}" value="not entered"   class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>National ID</label>
                            <input type="text" id="nationalID" name="nationalID" value="{{$editdata['nationalID']}}" value="not entered"  class="form-control">
                        </div>
                       
                        <div class="form-group mb-3">
                            <label>Phone Number</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" value="{{$editdata['phoneNumber']}}" value="not entered"  class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Project</label>
                            <input type="text" id="project" name="project"  value="{{$editdata['project']}}" value="not entered" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            {{-- <input type="text" id="role" name="role"  value="{{$editdata['role']}}" class="form-control" required> --}}

                            <select class="form-control"  value="{{$editdata['role']}}" id="role" name="role">
                                <option value="normal">Normal</option>
                            </select>


                        </div>
                        <div class="form-group mb-3">
                            <label>Social Insurance</label>
                            <input type="text" id="socialInsurance" name="socialInsurance" value="{{$editdata['socialInsurance']}}" value="not entered"  class="form-control">
                        </div>



                        <div class="form-group mb-3">
                            <button type="submit" id="createUserButton" class="btn btn-primary"> UPDATE </button>
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
document.getElementsByName("dateOfEmployment")[0].setAttribute('min', today);

var today = new Date().toISOString().split('T')[0];
document.getElementsByName("endOfEmployment")[0].setAttribute('min', today);


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
