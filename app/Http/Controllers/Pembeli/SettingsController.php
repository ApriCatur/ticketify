<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    // Menampilkan halaman settings pembeli
    public function index()
    {
        return view('Pembeli.settings'); // Sesuaikan huruf kapital folder 'Pembeli' jika diperlukan
    }

    // Memproses update Profile Details
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi inputan form frontend
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Tangani upload foto profil jika ada berkas masuk
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama di storage jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan foto baru ke direktori storage/app/public/profiles
            $path = $request->file('profile_picture')->store('profiles', 'public');
        }

        // Siapkan array untuk update data agar lebih aman dari error kolom database
        $updateData = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        if (isset($path)) {
            $updateData['profile_picture'] = $path;
        }

        // Eksekusi update langsung ke tabel users berdasarkan ID
        \App\Models\User::where('id', $user->id)->update($updateData);

        // Redirect disesuaikan dengan ->name('pembeli.settings') di web.php kamu
        return redirect()->route('pembeli.settings')->with('success', 'Informasi profil berhasil diperbarui.');
    }

    // Memproses update keamanan password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Periksa apakah password lama cocok dengan yang di database
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama yang kamu masukkan salah.']);
        }

        // Set password baru menggunakan Query Builder agar aman
        \App\Models\User::where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        // Redirect disesuaikan dengan ->name('pembeli.settings') di web.php kamu
        return redirect()->route('pembeli.settings')->with('success', 'Password akun berhasil diganti.');
    }
}
