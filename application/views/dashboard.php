<?php if ($this->ion_auth->is_admin()) : ?>
    <div class="row">
        <?php foreach ($info_box as $info) : ?>
            <div class="col-lg-3 col-xs-6" style="cursor: pointer !important;" onclick="location.href='<?= base_url() . strtolower($info->title); ?>'">
                <div class="small-box bg-<?= $info->box ?>">
                    <div class="inner">
                        <h3><?= $info->total; ?></h3>
                        <p><?= $info->text; ?></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-<?= $info->icon ?>"></i>
                    </div>
                    <a href="<?= base_url() . strtolower($info->title); ?>" class="small-box-footer">
                        Lihat Selengkapnya <i class=" fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php elseif ($this->ion_auth->in_group('Dosen')) : ?>

    <div class="row">
        <div class="col-sm-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Akun</h3>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th>Nama</th>
                        <td><?= $dosen->nama_dosen ?></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td><?= $dosen->nip ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $dosen->email ?></td>
                    </tr>
                    <tr>
                        <th>Mata Kuliah</th>
                        <td><?= $dosen->nama_matkul ?></td>
                    </tr>
                    <tr>
                        <th>Daftar Kelas</th>
                        <td>
                            <ol class="pl-4">
                                <?php foreach ($kelas as $k) : ?>
                                    <li><?= $k->nama_kelas ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="box box-solid">
                <div class="box-header bg-yellow">
                    <h3 class="box-title">Perhatian!</h3>
                </div>
                <div class="box-body">
                    <p>Selamat datang di Sistem Ujian Online. Dibawah ini ada beberapa petunjuk penggunaan sistem ujian online dengan mudah.</p>
                    <ul class="pl-4">
                        <li>Hal Pertama, semua Daftar Soal terdapat pada bagian Bank Soal (Tab menu sebelah kiri).</li>
                        <li>Kedua, Anda dapat mengelola daftar soal untuk mengatur ujian pada bagian Bank Soal.</li>
                        <li>Setiap ujian harus memiliki nama, set pertanyaan, tanggal dan rincian waktu yang ditetapkan oleh Dosen.</li>
                        <li>Anda perlu menyalin dan membagikan (kepada mahasiswa) kode TOKEN, satu kali setelah membuat catatan Ujian.</li>
                        <li>Setelah siswa menyelesaikan ujian mereka, Anda dapat melihat hasil terperinci dari bagian "Hasil Ujian".</li>
                        <li>Selain itu, bagian hasil dapat diunduh dalam format PDF.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>

    <div class="row">
        <div class="col-sm-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Akun</h3>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th>NIM</th>
                        <td><?= $mahasiswa->nim ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= $mahasiswa->nama ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= $mahasiswa->jenis_kelamin === 'M' ? "Male" : "Female"; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $mahasiswa->email ?></td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td><?= $mahasiswa->nama_jurusan ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><?= $mahasiswa->nama_kelas ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="box box-solid">
                <div class="box-header bg-yellow">
                    <h3 class="box-title">Perhatian!</h3>
                </div>
                <div class="box-body">
                    <p>Selamat datang di Sistem Ujian Online. Dibawah ini ada beberapa petunjuk penggunaan sistem ujian online dengan mudah.</p>
                    <ul class="pl-4">
                        <li>Hal Pertama, semua Daftar Ujian terdapat pada bagian Ujian (Tab menu sebelah kiri).</li>
                        <li>Kedua, Anda hanya akan dapat melihat ujian sesuai dengan jurusan kuliah Anda.</li>
                        <li>Setiap ujian memiliki batas waktu yang ditentukan oleh Dosen.</li>
                        <li>Anda diharuskan memasukkan nomor TOKEN untuk memulai ujian online.</li>
                        <li>Anda harus masuk/memulai ujian dalam jangka waktu yang ditentukan (tanggal dan waktu), jika tidak, Anda tidak dapat mengikuti ujian.</li>
                        <li>Setelah Anda menyelesaikan ujian, Anda dapat melihat hasil ujian Anda.</li>
                        <li>Untuk ujian ulang, silakan berkonsultasi dengan Dosen Anda masing-masing!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>