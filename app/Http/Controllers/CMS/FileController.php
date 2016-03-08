<?php

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use Sugar\File;
use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use View;
use Sugar\User;
use Validator;
use Mail;

class FileController extends CmsController
{
    public function __construct()
    {
        parent::__construct();
        View::share('section', 'files');
    }

    /**
     * Retrieve all file
     * @return Collection
     */

    public function index()
    {
        $admin=null;
        foreach(Auth::user()->roles as $role){
            $admin = $role->name;
        }
        if($admin == 'admin')
        {
            $paginator = File::paginate(20);
        }
        else
        {
            $paginator = File::where('user_id', '=', Auth::user()->id)->paginate(20);
        }
       
        $file_list = collect($paginator->items());
        $data = compact('paginator', 'file_list');
        return view('cms.files.index', $data);
    }

    public function create()
    {
        return view('cms.files.create');
    }

    public function store(Request $request)
    {
        $input = [];
        if ($request->file('file')) {
            $file = $request->file('file');
            $validator = Validator::make(
                [
                    'file' => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:csv',
                ]
            );

            if ($validator->fails()) {
                return redirect('admin/files/create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $name = time() . '-' . $file->getClientOriginalName();

            $input['name'] = $name;
            $input['status'] = 'New batch';
            $input['user_id'] = Auth::user()->id;
            $path = File::uploadBatchFilePath();
            // Moves file to folder on server
            $file->move($path, $name);            
            $result = File::create(['name' => $name,
                'user_id' => Auth::user()->id, 'status'=>$input['status'],]);
            \Session::flash('flash_message', 'File has been uploaded.');
            return redirect('admin/files');

        } else {
            \Session::flash('error_message', 'You have to upload a file');
            return redirect('admin/files/create');
        }
    }

    public function delete($file)
    {
        if (!empty($file->name)) {

            $file_path = User::uploadFilePath() . $file->name;
            if (file_exists($file_path)) {
                unlink(User::uploadFilePath() . $file->name);
                File::find($file->id)->delete();
                \Session::flash('flash_message', 'Your File has been deleted');
                return redirect('admin/files');
            }
            else
            {
                 \Session::flash('flash_message', 'Your File has been deleted');
                return redirect('admin/files');
            }
        } else {
            \Session::flash('error_message', 'Your file is not deleted');
            return redirect('admin/files');
        }
    }

    public function download($file)
    {
        //dd($file);
         
         $email = \Mail::send('emails.test', array('name' => 'The New Topic'),   function($message){
            $message->from('admin@Biotelemoni.com', 'Sender Name');
            $message->to('omarfaruk.sust@gmail.com', 'The New Topic')->subject('Test Email');
        });

        // $subject=['name'=>'omarfaruk'];
        //  $email = Mail::send('emails.test', ['key' => 'value'], function($message) use ($subject) {
        //   // note: if you don't set this, it will use the defaults from config/mail.php
        //   $message->from('amrakotha@gmail.com', 'Sender Name');
        //   $message->to('omarfaruk.sust@gmail.com', 'John Smith')
        //     ->subject($subject);
        //  });

        dd($email);

        /*$file_name = User::uploadFilePath() . $file->name;
        $headers = array(
            'Content-Type: application/csv',
            'Content-Disposition:attachment; filename="test.csv"',
            'Content-Transfer-Encoding:binary',
            'Content-Length:' . filesize($file_name),
        );
        $input['download_counter']=$file->download_counter+1;
        File::where('id', $file->id)->update(['download_counter' => $file->download_counter+1]);

        return Response::download($file_name, 'output.csv');*/

    }

    public function share($file)
    {
        $userList = User::where('id', '!=', Auth::user()->id)->select('id', 'email')->lists('email','id');
        return view('cms.files.share', compact('file','userList') );
    }

    public function filestore(Request $request)
    {
        
        $usersID = $request['useremail'];
        $users = User::whereIn('id', $usersID)->get();

        foreach ($users as $key => $user) {
            $this->sendEmail($user);
        }
         
        dd($usersID);
    }

    public function sendEmail($user){
        \Mail::send('emails.fileshare', ['user' => $user], function ($message) use ($user) {
            $message->from(Auth::user()->email, 'Biotelemoni');

            $message->to($user->email);
        });

        dd('d');
    }

}
