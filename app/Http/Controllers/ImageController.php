<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Str;
use Kreait\Firebase\Database;
use Auth;
use Session;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'images';
    }
    public function index()
    {
        //
        $expiresAt = new \DateTime('tomorrow');
        $imageReference = app('firebase.storage')->getBucket()->object("images/defT5uT7SDu9K5RFtIdl.png");

        if ($imageReference->exists()) {
          $image = $imageReference->signedUrl($expiresAt);
        } else {
          $image = null;
        }


        $images = $this->database->getReference($this->tablename)->getValue();
        return view('img',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //   'image' => 'required',
        // ]);
        // $input = $request->all();
        // $image = $request->file('image'); //image file from frontend

        // $student   = app('firebase.firestore')->database()->collection('images')->document('defT5uT7SDu9K5RFtIdl');
        // $firebase_storage_path = 'images/';
        // $name     = $student->id();
        // $localfolder = public_path('firebase-temp-uploads') .'/';
        // $extension = $image->getClientOriginalExtension();
        // $file      = $name. '.' . $extension;
        // if ($image->move($localfolder, $file)) {
        //   $uploadedfile = fopen($localfolder.$file, 'r');
        //   app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
        //   //will remove from local laravel folder
        //   unlink($localfolder . $file);
        //   Session::flash('message', 'Succesfully Uploaded');
//}

          //PASTED FROM STACKOVERFLOW https://stackoverflow.com/questions/38183813/firebase-storage-and-upload-from-php

          $storage = app('firebase.storage'); // This is an instance of Google\Cloud\Storage\StorageClient from kreait/firebase-php library
          $defaultBucket = $storage->getBucket();
          $firebase_storage_path = 'empImages/';
          $image = $request->file('image');
          $name = (string) Str::uuid().".".$image->getClientOriginalExtension(); // use Illuminate\Support\Str;
          $pathName = $image->getPathName();
          $file = fopen($pathName, 'r');
          $object = $defaultBucket->upload($file, [
          'name' => $firebase_storage_path . $name,
          'predefinedAcl' => 'publicRead'
     ]);
        //Store data in realtime database in table "images"
     $image_url = 'https://storage.googleapis.com/rmg-project-9e4cf.appspot.com/empImages/'.$name;


     //Taken from LoginController through Session
     $currentUserEmail = Session::get('currentMail');

     $postData = [
         'userEmail' => $currentUserEmail,
         'imageURL'=> $image_url,
     ];
     $postRef = $this->database->getReference($this->tablename)->push($postData);

        
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $imageDeleted = app('firebase.storage')->getBucket()->object("6513e9b8-577e-42db-b885-25420c9e03a0.jpg")->delete();
        Session::flash('message', 'Image Deleted');
        return back()->withInput();

        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        return back()->withInput();
    }
}
