<?php
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    public function Header()
    {
        $image_file = K_PATH_IMAGES . 'bsi.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'Hasil Ujian Mahasiswa', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gracias Kevin');
$pdf->SetTitle('Hasil Ujian');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$mulai = strftime('%A, %d %B %Y', strtotime($ujian->tgl_mulai));
$selesai = strftime('%A, %d %B %Y', strtotime($ujian->terlambat));

// create some HTML content
$html = <<<EOD
<p>
Berikut adalah hasil dari ujian online yang telah dilaksanakan. </br>
Semua informasi yang ada di bawah adalah Nilai Tertinggi, Nilai Terendah, dan Rata rata dari mahasiswa tersebut!
</p>
<table>
    <tr>
        <th><b>Nama Ujian</b></th>
        <td>{$ujian->nama_ujian}</td>
        <th><b>Ujian</b></th>
        <td>{$ujian->nama_matkul}</td> 
    </tr>
    <tr>
        <th><b>Total Pertanyaan.</b></th>
        <td>{$ujian->jumlah_soal}</td>
        <th><b>Dosen</b></th>
        <td>{$ujian->nama_dosen}</td>
    </tr>
    <tr>
        <th><b>Waktu Mulai</b></th>
        <td>{$ujian->waktu} Menit</td>
        <th><b>Nilai Terendah</b></th>
        <td>{$nilai->min_nilai}</td>
    </tr>
    <tr>
        <th><b>Tanggal Mulai</b></th>
        <td>{$mulai}</td>
        <th><b>Nilai Tertinggi</b></th>
        <td>{$nilai->max_nilai}</td>
    </tr>
    <tr>
        <th><b>Tanggal Selesai</b></th>
        <td>{$selesai}</td>
        <th><b>Nilai Rata - rata</b></th>
        <td>{$nilai->avg_nilai}</td>
    </tr>
</table>
EOD;

$html .= <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">#</th>
            <th width="35%"><b>Nama</b></th>
            <th width="15%"><b>Kelas</b></th>
            <th width="25%"><b>Jurusan</b></th>
            <th width="10%"><b>Total Benar</b></th>
            <th width="10%"><b>Nilai</b></th>
        </tr>        
    </thead>
    <tbody>
EOD;

$no = 1;
foreach ($hasil as $row) {
    $html .= <<<EOD
    <tr>
        <td align="center" width="5%">{$no}</td>
        <td width="35%">{$row->nama}</td>
        <td width="15%">{$row->nama_kelas}</td>
        <td width="25%">{$row->nama_jurusan}</td>
        <td width="10%">{$row->jml_benar}</td>
        <td width="10%">{$row->nilai}</td>
    </tr>
EOD;
    $no++;
}

$html .= <<<EOD
    </tbody>
</table>
EOD;

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('tes.pdf', 'I');
