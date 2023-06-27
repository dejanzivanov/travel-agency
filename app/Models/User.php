<?php

namespace App\Models;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'last_name',
        'account_type',
        'phone_number',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAllUsersPostRequestDataTable(\Illuminate\Http\Request $request)
    {
//        $data = ???
        dd($request->all());

        return $data;


    }

    public static function fetchDatatableResult(string $sorting_column, $sorting_direction, $offset, $limit, $search)
    {

        $data = DB::table('users')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('account_type', 'like', '%' . $search . '%')
            ->orWhere('phone_number', 'like', '%' . $search . '%')
            ->orderBy($sorting_column, $sorting_direction)
            ->offset($offset)
            ->limit($limit)
            ->get();

        $data_filtered = DB::table('users')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('account_type', 'like', '%' . $search . '%')
            ->orWhere('phone_number', 'like', '%' . $search . '%')
            ->orderBy($sorting_column, $sorting_direction)
            ->get();

        $data_filtered_count = count($data_filtered);
        $records_total = DB::table('users')->count();

        return
        [
            'data' => $data,
            'recordsTotal' => $records_total,
            'recordsFiltered' => $data_filtered_count
        ];

    }

    public static function deleteUser(\Illuminate\Http\Request $request)
    {
        // get the id from request and delete that user in database

        $id = $request->id;
        $data = DB::table('users')->where('id', $id)->delete();
        return $data;
    }

    public static function createUser(\Illuminate\Http\Request $request)
    {
//        dd($request->all());

        try
        {
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->lastName,
                'account_type' => $request->accountType,
                'email' => $request->email,


                'phone_number' => $request->phoneNumber,
                'password' => bcrypt($request->password),
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 200);

        }


        return response()->json(['data' => $user], 200);
    }

    public static function getUserDataById(\Illuminate\Http\Request $request)
    {
        $id = $request->id;
        $data = DB::table('users')->where('id', $id)->get();
        return $data;
    }

    public static function updateUser(\Illuminate\Http\Request $request)
    {
        $id = $request->userId;
//
//        dd($request->all());
        if($request->password != null)
        {
            $password = bcrypt($request->password);
            $data = DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'last_name' => $request->lastName,
                    'account_type' => $request->accountType,
                    'email' => $request->email,
                    'phone_number' => $request->phoneNumber,
                    'password' => $password,
                    'updated_at' => Carbon::parse(Carbon::now())->format('Y-m-d H:i:s')
                ]);

        }
        else
        {
           $data = DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'last_name' => $request->lastName,
                'account_type' => $request->accountType,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                'updated_at' => Carbon::parse(Carbon::now())->format('Y-m-d H:i:s')
            ]);
        }

//        dd($data);
        return $data;
    }

    public function isAdmin()
    {
        return $this->account_type === 'admin';
    }
}
