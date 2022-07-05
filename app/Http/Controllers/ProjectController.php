<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;



use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Session;

class ProjectController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'projectsWeb';
    }


    
    //To Fetch Data
    public function indexpro()
    {
            $projects = $this->database->getReference($this->tablename)->getValue();
            return view('Projects.projectdetails', compact('projects'));
    }



    //To Insert Data
    public function createpro()
    {
        return view('Projects.add');
    }
 
    public function storepro(Request $request)
    {
        // $string= 'rmg0001';
        // $id = substr($string,-4,4);
        // $newID = $id+1;
        // $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);


        $newID = uniqid('rmg_proj');

        $postData = [
            'projectID'=> $newID,
            'id'=> $request->id,
            'clientName'=> $request->clientName,
            'dateOfEnd'=> $request->dateOfEnd,
            'dateOfStart'=> $request->dateOfStart,
            'gewerk'=> $request->gewerk,
            'location'=> $request->location,
            'projectName'=> $request->projectName,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef)
        {
            return redirect('projectdetails')->with('status',"Project added successfully");
        }
        else
        {
            return redirect('projectdetails')->with('status',"Project not added...");
        }
    }



    // To Update data
    public function editpro($id)
    {
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata)
        {
            return view('Projects.edit',compact('editdata','key'));
        }
        else
        {
            return view('Projects.projectdetails')->with('status',"Project Id not found...");
        }
    }
    public function updatepro(Request $request, $id)
    {
        $key = $id;
        $updateData = [
            'id'=> $request->id,
            'clientName'=> $request->clientName,
            'dateOfEnd'=> $request->dateOfEnd,
            'dateOfStart'=> $request->dateOfStart,
            'gewerk'=> $request->gewerk,
            'location'=> $request->location,
            'projectName'=> $request->projectName,
    ];
        $res_updated=$this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($res_updated)
        {
            return redirect('projectdetails')->with('status',"Project Updated Successfully...");
        }
        else
        {
            return redirect('projectdetails')->with('status',"Project not updated...");
        }
    }





    // To Delete data
    public function destroypro($id)
    {
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data)
        {
            return redirect('projectdetails')->with('status',"Project Deleted Successfully...");
        }
        else
        {
            return redirect('projectdetails')->with('status',"Project not deleted...");
        }
    }
}
