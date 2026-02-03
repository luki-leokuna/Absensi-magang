<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
   public function index()
   {
     // mengambil data user, dengan urutan admin, mentor, dan peserta
     // load relasi mentor untuk mengetahui peserta mentornya siapa
     $users = User::with('mentor')
     ->orderByRaw("CASE
     WHEN role = 'admin' THEN 1
     WHEN role = 'mentor' THEN 2
     ELSE 3 END")
     ->orderBy('name')
     ->paginate(10); // 10 orang per halaman

     return view('admin.users.index', compact('users'));
   }

   // menampilkan form tambah user
   public function create()
   {
    //daftar mentor untuk dropdown (kalau mau nambah anak magang)
    $mentors = User::where('role', 'mentor')->get();
    return view('admin.users.create', compact('mentors'));
   }

   // simpan user baru ke database
   public function store(Request $request)
   {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
        'password'=>['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:admin,mentor,intern'],
        'divisi'=>['nullable', 'string'],
        'mentor_id'=> ['nullable', 'exists:users,id'],
        'nip' => ['nullable', 'string'],
        'institution'=> ['nullable', 'string'],
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'divisi' => $request->divisi,
        'mentor_id'=> $request->role === 'intern' ? $request->mentor_id : null,
        'nip' => $request->nip,
        'institution' => $request->institution,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
   }

   // Menampilkan form edit
   public function edit(User $user)
   {
    $mentors = User::where('role', 'mentor')->get();
    return view('admin.users.edit', compact('user', 'mentors'));
   }

   // Update Data User
   public function update(Request $request, User $user)
   {
    $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'unique:users,email,'. $user->id],
    'role' => ['required', 'in:admin,mentor,intern'],
    ]);

    // Update data dasar
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'divisi' => $request->divisi,
        'mentor_id'=> $request->role === 'intern' ? $request->mentor_id : null,
        'nip' => $request->nip,
        'institution' => $request->institution,
    ]);

    // Update password hanya jika diisi
    if ($request->filled('password')) {
        $request->validate([
            'password' => ['confirmed', Rules\Password::defaults()],
        ]);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

       }

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbaharui!');
    }

    // Hapus User
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}

