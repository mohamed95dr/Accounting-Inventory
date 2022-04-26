<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all();
        return view('users',['users'=>$users]);
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
        $validatedData = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:255',
        ],
        [
            'name.required' =>'يرجي ادخال اسم المستخدم',
            'name.unique' =>'اسم المستخدم مسجل مسبقا',

            'email.required' =>'يرجي ادخال الإيميل ',
            'email.unique' =>' الإيميل مسجل مسبقا',
        
            'phone.required' =>'يرجي ادخال  رقم الهاتف',
            'phone.unique' =>' رقم الهاتف مسجل مسبقا',
        
        ]);

             User::create([
                'name' => $request->name,
                'email' =>$request->email,
                'password' =>$request->password,

                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'Role' => $request->Role,


                // 'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة المستخدم بنجاح ');
            return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(user $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $users)
    {
        //
                //
                $id = $request->id;

                $this->validate($request, [
        
                    'name' => 'required|max:255|unique:users,name,'.$id,
                    'email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'salary' => 'required',
                    'Role' => 'required',
                ],[
        
                    'name.required' =>'يرجي ادخال اسم المستخدم',
                    'name.unique' =>'اسم المستخدم مسجل مسبقا',

                    'email.required' =>'يرجي ادخال الإيميل ',
                    'email.unique' =>' الإيميل مسجل مسبقا',
                
                    'phone.required' =>'يرجي ادخال  رقم الهاتف',
                    'phone.unique' =>' رقم الهاتف مسجل مسبقا',
                ]);
        
                $users = User::find($id);
                $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'salary' => $request->salary,
                    'Role' => $request->Role,
                ]);
        
                session()->flash('edit','تم تعديل المستخدم بنجاج');
                return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        User::find($id)->delete();
        session()->flash('delete','تم حذف المستخدم بنجاح');
        return redirect('/users');
    }
}
