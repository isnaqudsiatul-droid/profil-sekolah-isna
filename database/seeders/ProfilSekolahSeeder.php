<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilSekolah::create([
            'nama_sekolah' => 'MTs Bahrul Hidayah',
            'nama_kepala_sekolah' => 'Rahman Assegaf',
            'npsn' => '20261945',
            'alamat' => 'Jl. Pendidikan Vokasi No. 45, Kompleks Pendidikan Kejuruan',
            'kontak' => '6285794291043',
            'visi' => 'Terwujudnya peserta didik yang beriman, berakhlak mulia, berprestasi, berwawasan luas, serta mampu menghadapi perkembangan zaman.',
            'misi' => 'MTs Bahrul Hidayah berkomitmen menanamkan dan meningkatkan keimanan serta ketakwaan kepada Allah SWT melalui pembelajaran dan pembiasaan nilai-nilai keagamaan. Membentuk peserta didik yang berakhlak mulia, disiplin, jujur, bertanggung jawab, dan peduli terhadap sesama. Menyelenggarakan pembelajaran yang aktif, kreatif, inovatif, dan berkualitas sesuai dengan perkembangan ilmu pengetahuan dan teknologi. Mengembangkan potensi dan bakat peserta didik dalam bidang akademik maupun nonakademik serta meningkatkan prestasi melalui berbagai kegiatan pembelajaran dan ekstrakurikuler. Menciptakan lingkungan sekolah yang aman, nyaman, bersih, sehat, dan kondusif serta membekali peserta didik dengan keterampilan dan wawasan untuk menghadapi perkembangan zaman.',
            'tahun_berdiri' => '1978',
            'deskripsi' => 'MTs Bahrul Hidayah adalah lembaga pendidikan Islam yang berkomitmen mencetak generasi beriman, berakhlak mulia, berprestasi, dan berwawasan luas. Dengan pembelajaran yang berkualitas dan lingkungan yang nyaman, kami mendukung setiap peserta didik untuk mengembangkan potensi dan meraih masa depan yang gemilang.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}