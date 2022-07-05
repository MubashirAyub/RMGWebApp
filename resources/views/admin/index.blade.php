@extends('layouts.sidebar')
@section('content')
    <main class="mx-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Register New Member
                            </h4>

                        </div>

                        <div class="card-body">
                            <form action="{{ url('add-user') }}" method="POST" autocomplete="off" id="createUser">

                                @csrf

                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>First Name</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Last Name</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Date of Employment</label>
                                    <input type="date" onkeydown="return false" id="dateOfEmployment"
                                        name="dateOfEmployment" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>End of Employment</label>
                                    <input type="date" onkeydown="return false" id="endOfEmployment" name="endOfEmployment"
                                        class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Health Insurance</label>
                                    <input type="text" id="healthInsurance" name="healthInsurance" class="form-control"
                                        value="not entered">
                                </div>
                                <div class="form-group mb-3">
                                    <label>License Number</label>
                                    <input type="text" id="licenseNumber" name="licenseNumber" class="form-control"
                                        value="not entered">
                                </div>
                                <div class="form-group mb-3">
                                    <label>National ID</label>
                                    <input type="text" id="nationalID" name="nationalID" class="form-control"
                                        value="not entered">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        value="not entered">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Project</label>
                                    <input type="text" id="project" name="project" class="form-control"
                                        value="not entered">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Role</label>
                                    {{-- <input type="text" id="role" name="role" class="form-control" required> --}}
                                    <select class="form-control" id="role" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Social Insurance</label>
                                    <input type="text" id="socialInsurance" name="socialInsurance" class="form-control"
                                        value="not entered">
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" id="createUserButton" class="btn btn-primary"> REGISTER </button>
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
