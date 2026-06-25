<?php

namespace Database\Seeders;

use App\Models\PanitiaProfile;
use App\Models\RoleApplication;
use App\Models\User;
use App\Models\Ukm;
use Illuminate\Database\Seeder;

class PanitiaProfileSeeder extends Seeder
{
    public function run(): void
    {
        $panitiaUsers = User::where('role', 'panitia')->get();

        foreach ($panitiaUsers as $user) {
            if (PanitiaProfile::where('user_id', $user->getKey())->exists()) continue;

            $application = RoleApplication::where('user_id', $user->getKey())
                ->where('status', 'approved')
                ->first();

            if ($application) {
                $ukm = Ukm::find($application->ukm_id);
                PanitiaProfile::create([
                    'user_id' => $user->getKey(),
                    'asal_ukm' => $ukm?->nama_ukm ?? 'HMTI',
                    'no_rekening' => $application->nomor_rekening,
                ]);
            } else {
                $ukms = Ukm::pluck('nama_ukm')->toArray();
                PanitiaProfile::create([
                    'user_id' => $user->getKey(),
                    'asal_ukm' => $ukms[array_rand($ukms)],
                    'no_rekening' => '109002' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT),
                ]);
            }

            $this->command->info("PanitiaProfile created for user #{$user->getKey()} ({$user->name})");
        }
    }
}
