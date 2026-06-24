<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkreditasiInstitusi;
use App\Models\AkreditasiProdi;
use App\Models\Dosen;
use App\Models\Tendik;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TemplateController extends Controller
{
    private function getCategoryDetails($category)
    {
        switch ($category) {
            case 'akreditasi-institusi':
                return [
                    'filename' => 'template_akreditasi_institusi.xlsx',
                    'headers' => ['peringkat', 'no_sk', 'tanggal_akreditasi', 'tanggal_kadaluarsa', 'status'],
                    'example' => ['Unggul', '123/SK/BAN-PT/2026', '2026-06-18', '2031-06-18', 'Aktif'],
                    'model' => AkreditasiInstitusi::class,
                    'query' => function() { return AkreditasiInstitusi::all(); }
                ];
            case 'akreditasi-prodi':
                return [
                    'filename' => 'template_akreditasi_prodi.xlsx',
                    'headers' => ['prodi', 'strata', 'fakultas', 'peringkat', 'no_sertifikat', 'penyelenggaraan', 'tanggal_akreditasi', 'tanggal_kadaluarsa', 'status'],
                    'example' => ['Teknik Informatika', 'S1', 'Fakultas Teknik', 'Unggul', '456/SK/BAN-PT/2026', '2026', '2026-06-18', '2031-06-18', 'Aktif'],
                    'model' => AkreditasiProdi::class,
                    'query' => function() { return AkreditasiProdi::all(); }
                ];
            case 'dosen':
                return [
                    'filename' => 'template_data_dosen.xlsx',
                    'headers' => [
                        'kode_pt', 'nama_pt', 'fakultas', 'prodi_jurusan', 'nama', 'nuptk', 'nidn',
                        'tempat_lahir', 'tanggal_lahir', 'nip', 'nik', 'tmmd',
                        'status_kepegawaian', 'ikatan_kerja', 'pendidikan_terakhir',
                        'tahun_masuk', 'tahun_lulus', 'golongan', 'pangkat', 'jabatan', 'jabatan_awal', 'tmt_jabatan_awal',
                        'jabatan_terakhir', 'tmt_jabatan_terakhir', 'pangkat_terakhir',
                        'tmt_pangkat_terakhir', 'masa_kerja_gol_tahun', 'masa_kerja_gol_bulan',
                        'jenis_sertifikasi', 'tahun_sertifikasi', 'nomor_sertifikasi',
                        'sk_sertifikasi', 'status_keaktifan'
                    ],
                    'display_headers' => [
                        'Kode PT', 'Nama PT', 'Fakultas', 'Prodi/Jurusan', 'Nama Dosen', 'NUPTK', 'NIDN',
                        'Tempat Lahir', 'Tanggal Lahir', 'NIP', 'NIK', 'TMMD',
                        'Status Kepegawaian', 'Ikatan Kerja', 'Pendidikan Terakhir',
                        'Tahun Masuk', 'Tahun Lulus', 'Golongan', 'Pangkat', 'Jabatan Fungsional', 'Jabatan Awal', 'TMT Jabatan Awal',
                        'Jabatan Terakhir', 'TMT Jabatan Terakhir', 'Pangkat Terakhir',
                        'TMT Pangkat Terakhir', 'Masa Kerja Gol Tahun', 'Masa Kerja Gol Bulan',
                        'Jenis Sertifikasi', 'Tahun Sertifikasi', 'Nomor Sertifikasi',
                        'SK Sertifikasi', 'Status Keaktifan'
                    ],
                    'example' => [
                        '041XXX', 'Universitas Gunung Kidul', 'Fakultas Teknik', 'Teknik Informatika', 'Dr. Taufik Akbar, M.Kom.', '1234567890123456', '0001018001',
                        'Yogyakarta', '1980-01-01', '198001012005011001', '3404010101800001', '2005-01-01',
                        'PNS', 'Tetap', 'S3',
                        '2005', '2020', 'III/b', 'Penata Muda Tk. I', 'Lektor', 'Asisten Ahli', '2005-01-01',
                        'Lektor Kepala', '2020-01-01', 'Pembina (IV/a)',
                        '2020-01-01', '15', '6',
                        'Serdos', '2015', 'SERDOS/2015/001',
                        'SK/2015/001', 'Aktif'
                    ],
                    'model' => Dosen::class,
                    'query' => function() { return Dosen::all(); }
                ];
            case 'tendik':
                return [
                    'filename' => 'template_data_tendik.xlsx',
                    'headers' => ['nip', 'nama', 'unit_kerja', 'golongan', 'pangkat', 'jabatan', 'status_kepegawaian'],
                    'example' => ['198502022010011002', 'Budi Santoso', 'Biro Administrasi Akademik', 'III/b', 'Penata Muda Tingkat I', 'Staf Administrasi', 'PNS'],
                    'model' => Tendik::class,
                    'query' => function() { return Tendik::all(); }
                ];
            default:
                abort(404, 'Category not found');
        }
    }

    /**
     * Get display headers for a category. If display_headers key exists, use it;
     * otherwise format the field names nicely.
     */
    private function getDisplayHeaders($details)
    {
        if (isset($details['display_headers'])) {
            return $details['display_headers'];
        }

        return array_map(function($h) {
            return ucwords(str_replace('_', ' ', $h));
        }, $details['headers']);
    }

    /**
     * Apply common styling to a spreadsheet
     */
    private function styleSpreadsheet(Spreadsheet $spreadsheet, int $columnCount)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);

        // Style header row
        $headerRange = "A1:{$lastCol}1";
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB'],
                ],
            ],
        ]);

        // Auto-size columns
        for ($i = 1; $i <= $columnCount; $i++) {
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set row height for header
        $sheet->getRowDimension(1)->setRowHeight(30);

        return $sheet;
    }

    public function index()
    {
        $categories = [
            [
                'id' => 'akreditasi-institusi',
                'name' => 'Akreditasi Institusi',
                'description' => 'Data akreditasi tingkat universitas/institusi.',
                'fields' => ['peringkat', 'no_sk', 'tanggal_akreditasi', 'tanggal_kadaluarsa', 'status']
            ],
            [
                'id' => 'akreditasi-prodi',
                'name' => 'Akreditasi Prodi',
                'description' => 'Data akreditasi untuk semua program studi.',
                'fields' => ['prodi', 'strata', 'fakultas', 'peringkat', 'no_sertifikat', 'penyelenggaraan', 'tanggal_akreditasi', 'tanggal_kadaluarsa', 'status']
            ],
            [
                'id' => 'dosen',
                'name' => 'Data Dosen',
                'description' => 'Data dosen aktif Universitas Gunung Kidul.',
                'fields' => [
                    'kode_pt', 'nama_pt', 'fakultas', 'prodi_jurusan', 'nama', 'nuptk', 'nidn',
                    'tempat_lahir', 'tanggal_lahir', 'nip', 'nik', 'tmmd',
                    'status_kepegawaian', 'ikatan_kerja', 'pendidikan_terakhir',
                    'tahun_masuk', 'tahun_lulus', 'golongan', 'pangkat', 'jabatan', 'jabatan_awal', 'tmt_jabatan_awal',
                    'jabatan_terakhir', 'tmt_jabatan_terakhir', 'pangkat_terakhir',
                    'tmt_pangkat_terakhir', 'masa_kerja_gol_tahun', 'masa_kerja_gol_bulan',
                    'jenis_sertifikasi', 'tahun_sertifikasi', 'nomor_sertifikasi',
                    'sk_sertifikasi', 'status_keaktifan'
                ]
            ],
            [
                'id' => 'tendik',
                'name' => 'Data Tenaga Kependidikan',
                'description' => 'Data staf/tenaga kependidikan aktif.',
                'fields' => ['nip', 'nama', 'unit_kerja', 'golongan', 'pangkat', 'jabatan', 'status_kepegawaian']
            ],
        ];

        return view('admin.template.index', compact('categories'));
    }

    public function downloadTemplate($category)
    {
        $details = $this->getCategoryDetails($category);
        $headers = $details['headers'];
        $displayHeaders = $this->getDisplayHeaders($details);
        $example = $details['example'];
        $filename = $details['filename'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template');

        // Write display headers
        foreach ($displayHeaders as $colIndex => $header) {
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
            $sheet->setCellValue("{$col}1", $header);
        }

        // Write example row
        foreach ($example as $colIndex => $value) {
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
            $sheet->setCellValue("{$col}2", $value);
        }

        // Style the example row with light background
        $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($headers));
        $sheet->getStyle("A2:{$lastCol}2")->applyFromArray([
            'font' => ['italic' => true, 'color' => ['rgb' => '6B7280']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F9FAFB'],
            ],
        ]);

        $this->styleSpreadsheet($spreadsheet, count($headers));

        // Add a note sheet with instructions
        $instructionSheet = $spreadsheet->createSheet();
        $instructionSheet->setTitle('Petunjuk');
        $instructionSheet->setCellValue('A1', 'PETUNJUK PENGISIAN');
        $instructionSheet->setCellValue('A3', '1. Isi data pada sheet "Template"');
        $instructionSheet->setCellValue('A4', '2. Baris pertama adalah header, JANGAN diubah');
        $instructionSheet->setCellValue('A5', '3. Baris kedua adalah contoh data, boleh dihapus/diubah');
        $instructionSheet->setCellValue('A6', '4. Simpan file dalam format .xlsx');
        $instructionSheet->setCellValue('A7', '5. Upload file melalui menu Template & Export di admin');
        $instructionSheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $instructionSheet->getColumnDimension('A')->setWidth(60);

        $spreadsheet->setActiveSheetIndex(0);

        return $this->downloadXlsx($spreadsheet, $filename);
    }

    public function exportData($category)
    {
        $details = $this->getCategoryDetails($category);
        $headers = $details['headers'];
        $displayHeaders = $this->getDisplayHeaders($details);
        $queryFunc = $details['query'];
        $filename = str_replace('template_', 'export_', $details['filename']);

        $records = $queryFunc();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Export');

        // Write display headers
        foreach ($displayHeaders as $colIndex => $header) {
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
            $sheet->setCellValue("{$col}1", $header);
        }

        // Write data rows
        $rowNumber = 2;
        foreach ($records as $record) {
            foreach ($headers as $colIndex => $header) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
                $value = $record->$header ?? '';
                $sheet->setCellValue("{$col}{$rowNumber}", $value);
            }
            $rowNumber++;
        }

        // Style data rows with alternating colors
        if ($rowNumber > 2) {
            $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($headers));
            for ($r = 2; $r < $rowNumber; $r++) {
                $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E5E7EB'],
                        ],
                    ],
                ]);
                if ($r % 2 === 0) {
                    $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F9FAFB'],
                        ],
                    ]);
                }
            }
        }

        $this->styleSpreadsheet($spreadsheet, count($headers));

        return $this->downloadXlsx($spreadsheet, $filename);
    }

    /**
     * Stream download an XLSX file
     */
    private function downloadXlsx(Spreadsheet $spreadsheet, string $filename)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'xlsx_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ])->deleteFileAfterSend(true);
    }

    public function import(Request $request, $category)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        
        $details = $this->getCategoryDetails($category);
        $headers = $details['headers'];
        $displayHeaders = $this->getDisplayHeaders($details);
        $modelClass = $details['model'];

        // Build reverse map: lowercase display header -> database field name
        $displayToField = [];
        foreach ($headers as $i => $field) {
            $displayToField[strtolower($displayHeaders[$i])] = $field;
            // Also map the field name itself (snake_case)
            $displayToField[strtolower($field)] = $field;
            // Also map underscores replaced with spaces
            $displayToField[str_replace('_', ' ', strtolower($field))] = $field;
        }

        // Handle XLSX/XLS files
        if (in_array($extension, ['xlsx', 'xls'])) {
            return $this->importFromExcel($file, $headers, $displayToField, $modelClass, $category);
        }

        // Handle CSV files (backward compatibility)
        if ($extension === 'csv') {
            return $this->importFromCsv($file, $headers, $displayToField, $modelClass, $category);
        }

        return redirect()->back()->with('error', 'Format file tidak didukung. Gunakan file .xlsx atau .csv');
    }

    /**
     * Import data from XLSX/XLS file
     */
    private function importFromExcel($file, $headers, $displayToField, $modelClass, $category)
    {
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, false);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membaca file Excel. Pastikan format file benar. Detail: ' . $e->getMessage());
        }

        if (empty($rows)) {
            return redirect()->back()->with('error', 'File Excel kosong.');
        }

        // Get file headers from first row and clean them
        $fileHeaders = array_map(function($h) {
            if ($h === null) return '';
            return strtolower(trim($h));
        }, $rows[0]);

        // Map each file header column to its database field name
        $headerMap = []; // database_field => column_index
        $matchedFields = [];
        foreach ($fileHeaders as $colIndex => $fileHeader) {
            if (empty($fileHeader)) continue;
            
            // Check if this file header matches any known display/field name
            if (isset($displayToField[$fileHeader])) {
                $dbField = $displayToField[$fileHeader];
                $headerMap[$dbField] = $colIndex;
                $matchedFields[] = $dbField;
            }
        }

        // Verify all required headers are found
        foreach ($headers as $expectedField) {
            if (!isset($headerMap[$expectedField])) {
                return redirect()->back()->with('error', "Header Excel tidak sesuai. Kolom '{$expectedField}' tidak ditemukan.");
            }
        }

        // Process data rows (skip header)
        $dbData = [];
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $rowData = [];
            $hasData = false;

            foreach ($headerMap as $field => $index) {
                $val = isset($row[$index]) ? trim((string)$row[$index]) : null;
                if ($val === '' || strtolower($val) === 'null') {
                    $val = null;
                } else {
                    $hasData = true;
                    if ($this->isDateColumn($field)) {
                        $val = $this->parseDate($val);
                    }
                }
                $rowData[$field] = $val;
            }

            if (!$hasData) continue;

            $dbData[] = $rowData;
        }

        if (empty($dbData)) {
            return redirect()->back()->with('error', 'Tidak ada data valid yang ditemukan untuk diimpor.');
        }

        // Insert into database
        \DB::beginTransaction();
        try {
            foreach ($dbData as $data) {
                $modelClass::create($data);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data ke database. Detail Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', "Berhasil mengimpor " . count($dbData) . " data baru.");
    }

    /**
     * Import data from CSV file (backward compatibility)
     */
    private function importFromCsv($file, $headers, $displayToField, $modelClass, $category)
    {
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');
        if ($handle === false) {
            return redirect()->back()->with('error', 'Gagal membuka file.');
        }

        // Read BOM if present
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        // Detect separator
        $firstLine = fgets($handle);
        $separator = ';';
        if (str_starts_with(trim($firstLine), 'sep=')) {
            $separator = substr(trim($firstLine), 4, 1) ?: ';';
        } else {
            rewind($handle);
            if ($bom === "\xEF\xBB\xBF") {
                fseek($handle, 3);
            }
            $testLine = fgets($handle);
            $commaCount = substr_count($testLine, ',');
            $semicolonCount = substr_count($testLine, ';');
            if ($commaCount > $semicolonCount) {
                $separator = ',';
            }
            
            rewind($handle);
            if ($bom === "\xEF\xBB\xBF") {
                fseek($handle, 3);
            }
        }

        // Read header row
        $fileHeaders = fgetcsv($handle, 0, $separator);
        if (!$fileHeaders) {
            fclose($handle);
            return redirect()->back()->with('error', 'File CSV kosong atau tidak memiliki header.');
        }

        // Clean headers
        $fileHeaders = array_map(function($h) {
            return strtolower(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h)));
        }, $fileHeaders);

        // Map file headers to database fields using displayToField
        $headerMap = [];
        foreach ($fileHeaders as $colIndex => $fileHeader) {
            if (empty($fileHeader)) continue;
            if (isset($displayToField[$fileHeader])) {
                $headerMap[$displayToField[$fileHeader]] = $colIndex;
            }
        }

        // Verify all required headers found
        foreach ($headers as $expectedField) {
            if (!isset($headerMap[$expectedField])) {
                fclose($handle);
                return redirect()->back()->with('error', "Header CSV tidak sesuai. Kolom '{$expectedField}' tidak ditemukan.");
            }
        }

        // Read records
        $dbData = [];
        while (($row = fgetcsv($handle, 0, $separator)) !== false) {
            if (empty($row) || (count($row) === 1 && $row[0] === null)) {
                continue;
            }

            $rowData = [];
            $hasData = false;
            foreach ($headerMap as $field => $index) {
                $val = isset($row[$index]) ? trim($row[$index]) : null;
                if ($val === '' || strtolower($val) === 'null') {
                    $val = null;
                } else {
                    $hasData = true;
                    if ($this->isDateColumn($field)) {
                        $val = $this->parseDate($val);
                    }
                }
                $rowData[$field] = $val;
            }

            if (!$hasData) continue;

            $dbData[] = $rowData;
        }
        fclose($handle);

        if (empty($dbData)) {
            return redirect()->back()->with('error', 'Tidak ada data valid yang ditemukan untuk diimpor.');
        }

        \DB::beginTransaction();
        try {
            foreach ($dbData as $data) {
                $modelClass::create($data);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data ke database. Detail Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', "Berhasil mengimpor " . count($dbData) . " data baru.");
    }

    /**
     * Check if a field name is a date column.
     */
    private function isDateColumn(string $field): bool
    {
        $dateFields = [
            'tanggal_lahir',
            'tmt_jabatan_awal',
            'tmt_jabatan_terakhir',
            'tmt_pangkat_terakhir',
            'tanggal_akreditasi',
            'tanggal_kadaluarsa',
            'tmmd'
        ];
        return in_array(strtolower($field), $dateFields);
    }

    /**
     * Translate Indonesian month names to English.
     */
    private function translateIndonesianMonths($value)
    {
        $months = [
            'januari' => 'january',
            'februari' => 'february',
            'maret' => 'march',
            'april' => 'april',
            'mei' => 'may',
            'juni' => 'june',
            'juli' => 'july',
            'agustus' => 'august',
            'september' => 'september',
            'oktober' => 'october',
            'november' => 'november',
            'desember' => 'december',
            'agt' => 'aug',
            'okt' => 'oct',
            'des' => 'dec'
        ];

        return strtr(strtolower($value), $months);
    }

    /**
     * Parse date value to Y-m-d format.
     */
    private function parseDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        // If it's already in Y-m-d format
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return $value;
        }

        // Check if it's an Excel serial date (numeric and positive)
        if (is_numeric($value) && $value > 0 && $value < 100000) {
            try {
                $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float)$value);
                return $dateTime->format('Y-m-d');
            } catch (\Exception $e) {
                // fallback
            }
        }

        $value = is_string($value) ? $this->translateIndonesianMonths($value) : $value;

        // Try various common formats
        $formats = [
            'd/m/Y',
            'm/d/Y',
            'd-m-Y',
            'm-d-Y',
            'Y/m/d',
            'd/m/y',
            'm/d/y',
            'd-m-y',
            'm-d-y',
            'y/m/d',
            'd M Y',
            'd F Y',
        ];

        foreach ($formats as $format) {
            try {
                $date = \Carbon\Carbon::createFromFormat($format, $value);
                if ($date) {
                    return $date->format('Y-m-d');
                }
            } catch (\Exception $e) {
                // continue to next format
            }
        }

        // If all fail, try standard parsing
        try {
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            // Return original value so database validation can show original error if wrong
            return $value;
        }
    }
}
