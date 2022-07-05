<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Session;



class RegisterController extends Controller
{
    protected $auth;
    public function __construct(Database $database)
    {

        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/rmg-project-9e4cf-firebase-adminsdk-ic8no-988a1cf17b.json')
        ->withDatabaseUri('https://rmg-project-9e4cf-default-rtdb.europe-west1.firebasedatabase.app');

        $this->database = $database;

        $this->auth = $factory->createAuth();
        //$this->database = $factory->createDatabase();

        $this->tablename = 'usersWeb';


    }

    // public function index()
    // {

    //         $users = $this->database->getReference($this->tablename)->getValue();
           
    //             return view('admin.accounts', compact('users'));
            
            
    // }



    //To add new user by admin
    public function create()
    {
        return view('admin.index');
    }


    //To Add new user by manager
    public function createNew()
    {
        return view('manager.m_add');
    }

    public function store(Request $request)
    {
        // $string= 'rmg0001';
        // $id = substr($string,-4,4);
        // $newID = $id+1;
        // $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);


        $email = $request->email;
        $pass = $request->password;

        $newID = uniqid('rmg');

        //$customToken = $auth->createCustomToken($newID);

        $postData = [
            'id'=> $newID,
            'email'=> $request->email,
            'firstName'=> $request->firstName,
            'lastName'=> $request->lastName,
            'username'=> $request->username,
            'password'=> $request->password,
            'dateOfEmployment'=> $request->dateOfEmployment,
            'endOfEmployment'=> $request->endOfEmployment,
            'healthInsurance'=> $request->healthInsurance,
            'licenseNumber'=> $request->licenseNumber,
            'nationalID'=> $request->nationalID,
            'phoneNumber'=> $request->phoneNumber,
            'project'=> $request->project,
            'role'=> $request->role,
            'socialInsurance'=> $request->socialInsurance,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        $newUser = $this->auth->createUserWithEmailAndPassword($email, $pass);
        
        //dd($newUser);

        if($newUser)
        {
            return redirect('en/admin_dashboard')->with('status',"User added successfully");
        }
        else
        {
            return redirect('en/admin_dashboard')->with('status',"User not added...");
        }
    }



    public function storeNew(Request $request)
    {
        // $string= 'rmg0001';
        // $id = substr($string,-4,4);
        // $newID = $id+1;
        // $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);

        $email = $request->email;
        $pass = $request->password;


        $newID = uniqid('rmg');

        $postData = [
            'id'=> $newID,
            'email'=> $request->email,
            'firstName'=> $request->firstName,
            'lastName'=> $request->lastName,
            'username'=> $request->username,
            'password'=> $request->password,
            'dateOfEmployment'=> $request->dateOfEmployment,
            'endOfEmployment'=> $request->endOfEmployment,
            'healthInsurance'=> $request->healthInsurance,
            'licenseNumber'=> $request->licenseNumber,
            'nationalID'=> $request->nationalID,
            'phoneNumber'=> $request->phoneNumber,
            'project'=> $request->project,
            'role'=> $request->role,
            'socialInsurance'=> $request->socialInsurance,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);
        $newUser = $this->auth->createUserWithEmailAndPassword($email, $pass);
        dd($newUser);


        if($postRef)
        {
            return redirect('en/manager_dashboard')->with('status',"User added successfully");
        }
        else
        {
            return redirect('en/manager_dashboard')->with('status',"User not added...");
        }
    }



    // To Update data by admin
    public function edit($id)
    {
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata)
        {
            return view('admin.edit',compact('editdata','key'));
        }
        else
        {
            return view('admin.accounts')->with('status',"User Id not found...");
        }
    }
    public function update(Request $request, $id)
    {
        $key = $id;
        $updateData = [
        'email'=> $request->email,
        'firstName'=> $request->firstName,
        'lastName'=> $request->lastName,
        'username'=> $request->username,
        'password'=> $request->password,
        'dateOfEmployment'=> $request->dateOfEmployment,
        'endOfEmployment'=> $request->endOfEmployment,
        'healthInsurance'=> $request->healthInsurance,
        'licenseNumber'=> $request->licenseNumber,
        'nationalID'=> $request->nationalID,
        'phoneNumber'=> $request->phoneNumber,
        'project'=> $request->project,
        'role'=> $request->role,
        'socialInsurance'=> $request->socialInsurance,
    ];
        $res_updated=$this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_updated)
        {
            return redirect('en/admin_dashboard')->with('status',"User Updated Successfully...");
        }
        else
        {
            return redirect('en/admin_dashboard')->with('status',"User not updated...");
        }
    }

// To Update data by manager
public function editNew($id)
{
    $key = $id;
    $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();
    if($editdata)
    {
        return view('manager.edit',compact('editdata','key'));
    }
    else
    {
        return view('manager.accounts')->with('status',"User Id not found...");
    }
}
public function updateNew(Request $request, $id)
{
    $key = $id;
    $updateData = [
    'email'=> $request->email,
    'firstName'=> $request->firstName,
    'lastName'=> $request->lastName,
    'username'=> $request->username,
    'password'=> $request->password,
    'dateOfEmployment'=> $request->dateOfEmployment,
    'endOfEmployment'=> $request->endOfEmployment,
    'healthInsurance'=> $request->healthInsurance,
    'licenseNumber'=> $request->licenseNumber,
    'nationalID'=> $request->nationalID,
    'phoneNumber'=> $request->phoneNumber,
    'project'=> $request->project,
    'role'=> $request->role,
    'socialInsurance'=> $request->socialInsurance,
];
    $res_updated=$this->database->getReference($this->tablename.'/'.$key)->update($updateData);
    if($res_updated)
    {
        return redirect('en/manager_dashboard')->with('status',"User Updated Successfully...");
    }
    else
    {
        return redirect('en/manager_dashboard')->with('status',"User not updated...");
    }
}



 
    // To Delete data by admin
    public function destroy($id)
    {
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data)
        {
            return redirect('en/admin_dashboard')->with('status',"User Deleted Successfully...");
        }
        else
        {
            return redirect('en/admin_dashboard')->with('status',"User not deleted...");
        }
    }



    // To Delete data by manager
    public function destroyNew($id)
    {
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data)
        {
            return redirect('en/manager_dashboard')->with('status',"User Deleted Successfully...");
        }
        else
        {
            return redirect('en/manager_dashboard')->with('status',"User not deleted...");
        }
    }



     
        //To Fetch Data for admin
        public function accounts()
        {   
            
            $users = $this->database->getReference($this->tablename)->getValue();
            return view('admin.accounts', compact('users'));
        }

        //To Fetch Data for manager
        public function managerAccounts()
        {
            $users = $this->database->getReference($this->tablename)->orderByChild("role")->equalTo("normal")->getValue();
            return view('manager.accounts', compact('users'));
        }

}
