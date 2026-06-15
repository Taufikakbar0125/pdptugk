/* ===== PDPT UGK — Data Pages JavaScript ===== */

// ══════════════════════════════════════════════
// DUMMY DATA — Akreditasi Prodi
// ══════════════════════════════════════════════

const AKRED_PRODI_DATA = window.DB_AKRED_PRODI_DATA || [
    { fak:'FKIP', prodi:'Administrasi Pendidikan - S1', akred:'Unggul', thn:'2010-11-03', noSert:'395/SK/LAMDIK/Ak/S/III/2023', tglAkred:'2023-06-07', expired:'2028-06-06' },
    { fak:'FKIP', prodi:'Pendidikan Non Formal - S1', akred:'A', thn:'2010-11-03', noSert:'11899/SK/BAN-PT/AK-ISK/S/X/2021', tglAkred:'2010-12-30', expired:'2015-12-30' },
    { fak:'FKIP', prodi:'Pendidikan Luar Biasa - S1', akred:'Unggul', thn:'2016-04-08', noSert:'11109/SK/BAN-PT/AK-ISK/S/IX/2021', tglAkred:'2021-09-28', expired:'2025-12-13' },
    { fak:'FKIP', prodi:'Bimbingan dan Konseling - S1', akred:'Unggul', thn:'2010-11-03', noSert:'848/SK/LAMDIK/Ak/S/XII/2022', tglAkred:'2022-09-13', expired:'2027-09-12' },
    { fak:'FKIP', prodi:'Teknologi Pendidikan - S1', akred:'Unggul', thn:'2010-11-03', noSert:'12386/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-11-16', expired:'2025-11-15' },
    { fak:'FKIP', prodi:'Pendidikan Guru PAUD - S1', akred:'Unggul', thn:'2010-11-03', noSert:'1282/SK/LAMDIK/Ak-P/S/VIII/2025', tglAkred:'2025-08-06', expired:'2030-08-05' },
    { fak:'FKIP', prodi:'Kebijakan Pendidikan - S1', akred:'Unggul', thn:'2012-06-28', noSert:'1282/SK/LAMDIK/Ak-P/S/VIII/2025', tglAkred:'2025-08-06', expired:'2030-08-05' },
    { fak:'FKIP', prodi:'Pendidikan Guru SD - S1', akred:'A', thn:'2007-11-29', noSert:'13386/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-15', expired:'2026-08-27' },
    { fak:'FBS', prodi:'Pendidikan Bahasa dan Sastra Indonesia - S1', akred:'Unggul', thn:'2010-11-03', noSert:'431/SK/LAMDIK/Ak/S/X/2022', tglAkred:'2022-10-24', expired:'2027-08-22' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Inggris - S1', akred:'Unggul', thn:'2010-11-03', noSert:'10986/SK/BAN-PT/Akred-Itni/S/IX/2021', tglAkred:'2021-09-21', expired:'2026-09-21' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Jerman - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13174/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-15', expired:'2026-05-28' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Perancis - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13451/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-21', expired:'2024-04-30' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Jawa - S1', akred:'Unggul', thn:'2013-02-26', noSert:'13173/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-15', expired:'2026-10-07' },
    { fak:'FBS', prodi:'Pendidikan Seni Rupa - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13184/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-15', expired:'2025-11-24' },
    { fak:'FBS', prodi:'Pendidikan Kriya - S1', akred:'Unggul', thn:'2022-10-24', noSert:'366/SK/LAMDIK/Ak/S/X/2022', tglAkred:'2022-10-24', expired:'2027-08-07' },
    { fak:'FEB', prodi:'Manajemen - S1', akred:'Unggul', thn:'2010-11-03', noSert:'5421/SK/BAN-PT/Akred/S/I/2020', tglAkred:'2020-01-28', expired:'2025-01-28' },
    { fak:'FEB', prodi:'Akuntansi - S1', akred:'A', thn:'2010-11-03', noSert:'3107/SK/BAN-PT/Akred/S/VIII/2019', tglAkred:'2019-08-27', expired:'2024-08-27' },
    { fak:'FEB', prodi:'Pendidikan Ekonomi - S1', akred:'Unggul', thn:'2010-11-03', noSert:'12876/SK/BAN-PT/AK-ISK/S/XI/2021', tglAkred:'2021-11-30', expired:'2026-11-30' },
    { fak:'FEB', prodi:'Ekonomi Pembangunan - S1', akred:'B', thn:'2015-06-18', noSert:'1874/SK/BAN-PT/Akred/S/VI/2018', tglAkred:'2018-06-26', expired:'2023-06-26' },
    { fak:'FT', prodi:'Pendidikan Teknik Elektro - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13342/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-21', expired:'2026-12-21' },
    { fak:'FT', prodi:'Pendidikan Teknik Mesin - S1', akred:'A', thn:'2010-11-03', noSert:'11234/SK/BAN-PT/AK-ISK/S/X/2021', tglAkred:'2021-10-05', expired:'2026-10-05' },
    { fak:'FT', prodi:'Teknik Informatika - S1', akred:'Unggul', thn:'2012-09-15', noSert:'982/SK/LAMDIK/Ak/S/VII/2023', tglAkred:'2023-07-18', expired:'2028-07-18' },
    { fak:'FT', prodi:'Teknik Sipil - D3', akred:'B', thn:'2010-11-03', noSert:'8923/SK/BAN-PT/Akred/D/IX/2020', tglAkred:'2020-09-15', expired:'2025-09-15' },
    { fak:'FMIPA', prodi:'Pendidikan Matematika - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13287/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-21', expired:'2026-12-21' },
    { fak:'FMIPA', prodi:'Pendidikan Fisika - S1', akred:'A', thn:'2010-11-03', noSert:'10876/SK/BAN-PT/AK-ISK/S/IX/2021', tglAkred:'2021-09-14', expired:'2026-09-14' },
    { fak:'FMIPA', prodi:'Pendidikan Kimia - S1', akred:'Unggul', thn:'2010-11-03', noSert:'11453/SK/BAN-PT/AK-ISK/S/X/2021', tglAkred:'2021-10-19', expired:'2026-10-19' },
    { fak:'FMIPA', prodi:'Pendidikan Biologi - S1', akred:'A', thn:'2010-11-03', noSert:'12109/SK/BAN-PT/AK-ISK/S/XI/2021', tglAkred:'2021-11-09', expired:'2026-11-09' },
    { fak:'FMIPA', prodi:'Statistika - D3', akred:'B', thn:'2014-03-12', noSert:'7654/SK/BAN-PT/Akred/D/VI/2020', tglAkred:'2020-06-23', expired:'2025-06-23' },
    { fak:'FIS', prodi:'Pendidikan Kewarganegaraan - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13109/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-14', expired:'2026-12-14' },
    { fak:'FIS', prodi:'Pendidikan Geografi - S1', akred:'A', thn:'2010-11-03', noSert:'12543/SK/BAN-PT/AK-ISK/S/XI/2021', tglAkred:'2021-11-23', expired:'2026-11-23' },
    { fak:'FIS', prodi:'Pendidikan Sejarah - S1', akred:'Unggul', thn:'2010-11-03', noSert:'11987/SK/BAN-PT/AK-ISK/S/XI/2021', tglAkred:'2021-11-02', expired:'2026-11-02' },
    { fak:'FIS', prodi:'Ilmu Administrasi Negara - S1', akred:'Dalam Proses', thn:'2019-08-14', noSert:'-', tglAkred:'-', expired:'-' },
    { fak:'FIK', prodi:'Pendidikan Jasmani - S1', akred:'Unggul', thn:'2010-11-03', noSert:'13476/SK/BAN-PT/AK-ISK/S/XII/2021', tglAkred:'2021-12-21', expired:'2026-12-21' },
    { fak:'FIK', prodi:'Pendidikan Kepelatihan Olahraga - S1', akred:'A', thn:'2010-11-03', noSert:'11654/SK/BAN-PT/AK-ISK/S/X/2021', tglAkred:'2021-10-26', expired:'2026-10-26' },
    { fak:'FIK', prodi:'Ilmu Keolahragaan - S1', akred:'B', thn:'2013-05-20', noSert:'9876/SK/BAN-PT/Akred/S/XII/2020', tglAkred:'2020-12-08', expired:'2025-12-08' },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Akreditasi Institusi (Riwayat)
// ══════════════════════════════════════════════

const AKRED_INSTITUSI_DATA = [
    { no:1, lembaga:'BAN-PT', peringkat:'Unggul', noSert:'1456/SK/BAN-PT/Akred/PT/IX/2023', tglAkred:'2023-09-15', expired:'2028-09-15', status:'Aktif' },
    { no:2, lembaga:'BAN-PT', peringkat:'A', noSert:'3892/SK/BAN-PT/Akred/PT/XII/2018', tglAkred:'2018-12-11', expired:'2023-12-11', status:'Kadaluarsa' },
    { no:3, lembaga:'BAN-PT', peringkat:'B', noSert:'7234/SK/BAN-PT/Akred/PT/VI/2013', tglAkred:'2013-06-25', expired:'2018-06-25', status:'Kadaluarsa' },
    { no:4, lembaga:'BAN-PT', peringkat:'B', noSert:'4561/SK/BAN-PT/Akred/PT/IX/2008', tglAkred:'2008-09-18', expired:'2013-09-18', status:'Kadaluarsa' },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Akreditasi ASIC
// ══════════════════════════════════════════════

const AKRED_ASIC_DATA = window.DB_AKRED_ASIC_DATA || [
    { prodi:'German Language Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS88248/0719', tglAkred:'23/07/2019' },
    { prodi:'Dance Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS16632/0719', tglAkred:'23/07/2019' },
    { prodi:'Educational Management Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS60615/0719', tglAkred:'23/07/2019' },
    { prodi:'Educational Technology Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS47864/0719', tglAkred:'23/07/2019' },
    { prodi:'Guidance and Counselling Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS36497/0719', tglAkred:'23/07/2019' },
    { prodi:'Indonesian Language and Literature Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS69819/0719', tglAkred:'23/07/2019' },
    { prodi:'Indonesian Language Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS63868/0719', tglAkred:'23/07/2019' },
    { prodi:'Javanese Language Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS80404/0719', tglAkred:'23/07/2019' },
    { prodi:'Physical Education, Health and Recreation Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS74589/0719', tglAkred:'23/07/2019' },
    { prodi:'Sport Coaching Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS63471/0719', tglAkred:'23/07/2019' },
    { prodi:'Sport Science Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS57007/0719', tglAkred:'23/07/2019' },
    { prodi:'Accounting Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS41235/0719', tglAkred:'23/07/2019' },
    { prodi:'Economics Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS52891/0719', tglAkred:'23/07/2019' },
    { prodi:'English Language Education Study Program', period:'8th July 2019 - 7th July 2023', akred:'AS71456/0719', tglAkred:'23/07/2019' },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Akreditasi ASIIN
// ══════════════════════════════════════════════

const AKRED_ASIIN_DATA = window.DB_AKRED_ASIIN_DATA || [
    { prodi:'Chemistry', period:'20 March 2020 - 09 October 2021', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Biology', period:'20 March 2020 - 09 October 2021', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Chemistry Education', period:'20 March 2020 - 30 September 2025', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Mathematics Education', period:'20 March 2020 - 30 September 2025', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Mathematics', period:'20 March 2020 - 30 September 2025', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Biology Education', period:'20 March 2020 - 09 October 2021', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Chemistry Education', period:'20 March 2020 - 09 October 2021', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Mathematics Education', period:'20 March 2020 - 30 September 2025', akred:'', tglAkred:'06/04/2021' },
    { prodi:'Magister of Electronic and Informatic Engineering Education', period:'17 September 2021 - 30 September 2021', akred:'', tglAkred:'05/10/2021' },
    { prodi:'Pendidikan IPA', period:'2020-2025', akred:'', tglAkred:'2021-04-06' },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Dosen
// ══════════════════════════════════════════════

const DOSEN_DATA = window.DB_DOSEN_DATA || [
    { fak:'FBS', prodi:'Pendidikan Seni Rupa', nama:'Prof. Dr. Drs. I Wayan Suardana M.Sn.', pendidikan:'S3', gol:'IV/e', pangkat:'Pembina Utama', jabatan:'Guru Besar', status:'PNS' },
    { fak:'FIK', prodi:'Pendidikan Kepelatihan Olahraga', nama:'Prof. Dr. Drs. Fauzi M.Si.', pendidikan:'S3', gol:'IV/d', pangkat:'Pembina Utama Madya', jabatan:'Guru Besar', status:'PNS' },
    { fak:'FT', prodi:'Pendidikan Teknik Mesin', nama:'Dr. Ir. Drs. Widarto M.Pd.', pendidikan:'S3', gol:'IV/c', pangkat:'Pembina Utama Muda', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FT', prodi:'Pendidikan Teknik Elektronika dan Informatika', nama:'Dr. Ratna Wardani M.T.', pendidikan:'S3', gol:'IV/b', pangkat:'Pembina Tingkat I', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FMIPA', prodi:'Pendidikan Matematika', nama:'Caturiyati S.Si., M.Si.', pendidikan:'S2', gol:'III/d', pangkat:'Penata Tingkat I', jabatan:'Lektor', status:'PNS' },
    { fak:'FBS', prodi:'Pendidikan Seni Musik', nama:'Panca Putri Rusdewanti S.Pd., M.Pd.', pendidikan:'S2', gol:'III/d', pangkat:'Penata Tingkat I', jabatan:'Lektor', status:'PNS' },
    { fak:'FKIP', prodi:'Pendidikan Luar Biasa', nama:'Nur Azizah S.Pd., M.Ed., Ph.D.', pendidikan:'S3', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FIS', prodi:'Administrasi Publik', nama:'Utami Dewi S.IP., MPP., Ph.D.', pendidikan:'S3', gol:'III/d', pangkat:'Penata Tingkat I', jabatan:'Lektor', status:'PNS' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Daerah', nama:'Dr. Venny Indria Ekowati S.Pd., M.Litt.', pendidikan:'S3', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FIK', prodi:'Pendidikan Kepelatihan Olahraga', nama:'Dr. Lismadiana S.Pd., M.Pd.', pendidikan:'S3', gol:'IV/c', pangkat:'Pembina Utama Muda', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FEB', prodi:'Manajemen', nama:'Dr. Muniya Alteza M.Si.', pendidikan:'S3', gol:'IV/b', pangkat:'Pembina Tingkat I', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FEB', prodi:'Akuntansi', nama:'Prof. Dr. Siswanto M.Pd.', pendidikan:'S3', gol:'IV/d', pangkat:'Pembina Utama Madya', jabatan:'Guru Besar', status:'PNS' },
    { fak:'FMIPA', prodi:'Pendidikan Fisika', nama:'Drs. Yusman Wiyatmo M.Si.', pendidikan:'S2', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FMIPA', prodi:'Pendidikan Kimia', nama:'Dr. Jaslin Ikhsan M.App.Sc.', pendidikan:'S3', gol:'IV/c', pangkat:'Pembina Utama Muda', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FMIPA', prodi:'Pendidikan Biologi', nama:'Dr. Slamet Suyanto M.Ed.', pendidikan:'S3', gol:'IV/b', pangkat:'Pembina Tingkat I', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FT', prodi:'Teknik Informatika', nama:'Herman Dwi Surjono Ph.D.', pendidikan:'S3', gol:'IV/c', pangkat:'Pembina Utama Muda', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FT', prodi:'Pendidikan Teknik Elektro', nama:'Dr. Samsul Hadi M.Pd., M.T.', pendidikan:'S3', gol:'IV/b', pangkat:'Pembina Tingkat I', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FKIP', prodi:'Bimbingan dan Konseling', nama:'Dr. Budi Astuti M.Si.', pendidikan:'S3', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FKIP', prodi:'Teknologi Pendidikan', nama:'Deni Hardianto M.Pd.', pendidikan:'S2', gol:'III/d', pangkat:'Penata Tingkat I', jabatan:'Lektor', status:'PNS' },
    { fak:'FIS', prodi:'Pendidikan Geografi', nama:'Dr. Mukminan M.Pd.', pendidikan:'S3', gol:'IV/d', pangkat:'Pembina Utama Madya', jabatan:'Guru Besar', status:'PNS' },
    { fak:'FIS', prodi:'Pendidikan Sejarah', nama:'Dr. Dyah Kumalasari M.Pd.', pendidikan:'S3', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FIK', prodi:'Pendidikan Jasmani', nama:'Dr. Hari Amirullah Rachman M.Pd.', pendidikan:'S3', gol:'IV/c', pangkat:'Pembina Utama Muda', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FBS', prodi:'Pendidikan Bahasa Inggris', nama:'Ashadi Ed.D.', pendidikan:'S3', gol:'IV/b', pangkat:'Pembina Tingkat I', jabatan:'Lektor Kepala', status:'PNS' },
    { fak:'FEB', prodi:'Pendidikan Ekonomi', nama:'Aula Ahmad Hafidh S.F. M.Si.', pendidikan:'S2', gol:'III/d', pangkat:'Penata Tingkat I', jabatan:'Lektor', status:'PNS' },
    { fak:'FKIP', prodi:'Pendidikan Guru SD', nama:'Dr. Ali Mustadi M.Pd.', pendidikan:'S3', gol:'IV/a', pangkat:'Pembina', jabatan:'Lektor Kepala', status:'PNS' },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Tenaga Kependidikan
// ══════════════════════════════════════════════

const TENDIK_DATA = window.DB_TENDIK_DATA || [
    { nama:'Ariani S.Pd.T., M.Pd.', nip:'198307212015041001', gol:'III/c', pangkat:'Penata', unitKerja:'Kantor Wakil Rektor Bidang Sumber Daya Manusia dan Hukum', status:'PNS' },
    { nama:'Cholimah Mulyanti S.E., M.Pd', nip:'196911082009102001', gol:'III/c', pangkat:'Penata', unitKerja:'Fakultas Kedokteran', status:'PNS' },
    { nama:'Sigit Prabowo S.H.', nip:'196810082002121003', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Fakultas Kedokteran', status:'PNS' },
    { nama:'Supriyono S.I.P., M.Or', nip:'197102091989031001', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Fakultas Psikologi', status:'PNS' },
    { nama:'Harsudi S.I.P.', nip:'197007162007011004', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Fakultas Matematika dan Ilmu Pengetahuan Alam', status:'PNS' },
    { nama:'Prasetya Edi Angkasa A.Md., S.Pd.', nip:'197106202000121002', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Direktorat Kemahasiswaan dan Alumni', status:'PNS' },
    { nama:'Siti Efanah', nip:'196910152002122001', gol:'III/b', pangkat:'Penata Muda Tingkat I', unitKerja:'Sekolah Pascasarjana', status:'PNS' },
    { nama:'Yansri Widayanti S.Pd.', nip:'197201021998032002', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Kantor Wakil Rektor Bidang Kerja Sama dan Sistem Informasi', status:'PNS' },
    { nama:'Drs. Bambang Sunaryo', nip:'196504121990031002', gol:'IV/a', pangkat:'Pembina', unitKerja:'Fakultas Teknik', status:'PNS' },
    { nama:'Sri Mulyani A.Md.', nip:'197803152006042001', gol:'III/c', pangkat:'Penata', unitKerja:'Fakultas Ekonomi dan Bisnis', status:'PNS' },
    { nama:'Eko Prasetyo S.Kom.', nip:'198506232010011003', gol:'III/c', pangkat:'Penata', unitKerja:'UPT Pusat Teknologi Informasi dan Komunikasi', status:'PNS' },
    { nama:'Rini Widiastuti S.E.', nip:'197912082003122001', gol:'III/d', pangkat:'Penata Tingkat I', unitKerja:'Biro Akademik, Kemahasiswaan, dan Informasi', status:'PNS' },
    { nama:'Agus Supriyadi', nip:'196807151992031004', gol:'III/a', pangkat:'Penata Muda', unitKerja:'Fakultas Ilmu Sosial', status:'PNS' },
    { nama:'Wahyu Setyaningsih S.Pd.', nip:'198201152006042002', gol:'III/c', pangkat:'Penata', unitKerja:'Fakultas Bahasa dan Seni', status:'PNS' },
    { nama:'Dian Permata Sari A.Md.', nip:'199003212015042001', gol:'III/b', pangkat:'Penata Muda Tingkat I', unitKerja:'Perpustakaan', status:'Kontrak' },
    { nama:'Ahmad Fauzan S.T.', nip:'198812052012011002', gol:'III/c', pangkat:'Penata', unitKerja:'UPT Laboratorium', status:'PNS' },
    { nama:'Nur Hidayah S.Sos.', nip:'199105102016042001', gol:'III/b', pangkat:'Penata Muda Tingkat I', unitKerja:'Biro Umum, Perencanaan, dan Keuangan', status:'PPPK' },
    { nama:'Susanto', nip:'197504032000031002', gol:'II/d', pangkat:'Pengatur Tingkat I', unitKerja:'Fakultas Ilmu Keolahragaan', status:'PNS' },
    { nama:'Fitri Rahmawati S.Pd.', nip:'198907232014042001', gol:'III/b', pangkat:'Penata Muda Tingkat I', unitKerja:'Fakultas Keguruan dan Ilmu Pendidikan', status:'PNS' },
    { nama:'Budi Santoso S.E.', nip:'198005122008011003', gol:'III/c', pangkat:'Penata', unitKerja:'Biro Umum, Perencanaan, dan Keuangan', status:'PNS' },
];


// ══════════════════════════════════════════════
// SHARED HELPERS
// ══════════════════════════════════════════════

function getAkredClass(akred) {
    const lower = akred.toLowerCase();
    if (lower === 'unggul') return 'unggul';
    if (lower === 'a') return 'a';
    if (lower === 'b') return 'b';
    if (lower === 'c') return 'c';
    return 'proses';
}

function fileBtnHtml(filePdf) {
    if (filePdf) {
        return `<a href="/storage/${filePdf}" target="_blank" class="btn-file" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #334155; border-radius: 4px; font-size: 0.75rem; font-weight: 500; border: 1px solid #e2e8f0; transition: all 0.2s;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Lihat PDF
        </a>`;
    }
    return `<span style="color: #94a3b8; font-size: 0.75rem;">-</span>`;
}

function emptyRow(cols, msg) {
    return `<tr><td colspan="${cols}"><div class="empty-state">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <p>${msg || 'Tidak ada data yang sesuai dengan filter.'}</p>
    </div></td></tr>`;
}


// ══════════════════════════════════════════════
// GENERIC PAGINATION ENGINE
// ══════════════════════════════════════════════

function createPaginator(config) {
    let currentPage = 1;
    let filteredData = [...config.allData];
    const perPage = config.perPage || 15;

    function render() {
        const tbody = document.getElementById(config.tbodyId);
        const countEl = document.getElementById(config.countId);
        const infoEl = document.getElementById(config.infoId);
        const pagEl = document.getElementById(config.pagId);
        if (!tbody) return;

        const total = filteredData.length;
        const totalPages = Math.max(1, Math.ceil(total / perPage));
        if (currentPage > totalPages) currentPage = totalPages;

        const start = (currentPage - 1) * perPage;
        const end = Math.min(start + perPage, total);
        const page = filteredData.slice(start, end);

        if (countEl) countEl.textContent = `${total} Items`;
        if (infoEl) infoEl.textContent = `Menampilkan ${total ? start + 1 : 0}–${end} dari ${total} data`;

        tbody.innerHTML = page.length ? page.map((r, i) => config.rowFn(r, start + i)).join('') : emptyRow(config.cols);

        if (pagEl) pagEl.innerHTML = buildPagBtns(currentPage, totalPages, config.pagFnName);
    }

    function goTo(p) { currentPage = p; render(); scrollToEl(config.scrollTarget || '.table-section'); }
    function setData(d) { filteredData = d; currentPage = 1; render(); }
    function reset() { filteredData = [...config.allData]; currentPage = 1; render(); }

    // expose goTo globally
    window[config.pagFnName] = goTo;

    return { render, goTo, setData, reset, getData: () => filteredData };
}

function buildPagBtns(cur, total, fnName) {
    let h = `<button class="page-btn" ${cur===1?'disabled':''} onclick="${fnName}(${cur-1})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></button>`;
    const max = 7;
    let s = Math.max(1, cur - Math.floor(max/2));
    let e = Math.min(total, s + max - 1);
    if (e - s < max - 1) s = Math.max(1, e - max + 1);
    if (s > 1) { h += `<button class="page-btn" onclick="${fnName}(1)">1</button>`; if (s > 2) h += `<span style="padding:0 4px;color:var(--text-light)">…</span>`; }
    for (let p = s; p <= e; p++) h += `<button class="page-btn ${p===cur?'active':''}" onclick="${fnName}(${p})">${p}</button>`;
    if (e < total) { if (e < total-1) h += `<span style="padding:0 4px;color:var(--text-light)">…</span>`; h += `<button class="page-btn" onclick="${fnName}(${total})">${total}</button>`; }
    h += `<button class="page-btn" ${cur===total?'disabled':''} onclick="${fnName}(${cur+1})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></button>`;
    return h;
}

function scrollToEl(sel) { const el = document.querySelector(sel); if (el) el.scrollIntoView({ behavior:'smooth', block:'start' }); }


// ══════════════════════════════════════════════
// PAGE: AKREDITASI PRODI
// ══════════════════════════════════════════════

let prodiPaginator = null;

function initAkredProdi() {
    const tbody = document.getElementById('prodiTableBody');
    if (!tbody) return;

    prodiPaginator = createPaginator({
        allData: AKRED_PRODI_DATA,
        tbodyId: 'prodiTableBody', countId: 'prodiCount', infoId: 'paginationInfo', pagId: 'pagination',
        pagFnName: 'goToProdiPage', cols: 9, perPage: 15,
        rowFn: (r, i) => `<tr>
            <td class="row-num">${i+1}</td>
            <td><span class="fak-badge">${r.fakultas || r.fak}</span></td>
            <td class="prodi-name">${r.prodi}</td>
            <td><span class="akred-badge ${getAkredClass(r.peringkat || r.akred)}">${r.peringkat || r.akred}</span></td>
            <td class="date-cell">${r.penyelenggaraan || r.thn}</td>
            <td class="sertifikat-cell">${r.no_sertifikat || r.noSert}</td>
            <td class="date-cell">${r.tanggal_akred_fmt || r.tanggal_akreditasi || r.tglAkred}</td>
            <td class="date-cell">${r.tanggal_kadaluarsa_fmt || r.tanggal_kadaluarsa || r.expired}</td>
            <td>${fileBtnHtml(r.file_pdf)}</td>
        </tr>`
    });

    // Populate fakultas filter
    const fakFilter = document.getElementById('filterFakultas');
    if (fakFilter) {
        [...new Set(AKRED_PRODI_DATA.map(r => r.fak))].sort().forEach(f => {
            const o = document.createElement('option'); o.value = f; o.textContent = f; fakFilter.appendChild(o);
        });
    }

    prodiPaginator.render();
}

window.applyFilters = function() {
    if (!prodiPaginator) return;
    const fak = (document.getElementById('filterFakultas') || {}).value || '';
    const akred = (document.getElementById('filterAkred') || {}).value || '';
    const filtered = AKRED_PRODI_DATA.filter(r => {
        if (fak && r.fak !== fak) return false;
        if (akred && r.akred !== akred) return false;
        return true;
    });
    prodiPaginator.setData(filtered);
};

window.resetFilters = function() {
    const f1 = document.getElementById('filterFakultas'); if (f1) f1.value = '';
    const f2 = document.getElementById('filterProdi'); if (f2) f2.value = '';
    const f3 = document.getElementById('filterAkred'); if (f3) f3.value = '';
    if (prodiPaginator) prodiPaginator.reset();
};

window.exportData = function() { alert('Export Data — Fitur ini akan segera tersedia.'); };


// ══════════════════════════════════════════════
// PAGE: AKREDITASI INSTITUSI
// ══════════════════════════════════════════════

function initAkredInstitusi() {
    const tbody = document.getElementById('institusiTableBody');
    if (!tbody) return;
    tbody.innerHTML = AKRED_INSTITUSI_DATA.map(r => `<tr>
        <td class="row-num">${r.no}</td>
        <td><span class="fak-badge">${r.lembaga}</span></td>
        <td><span class="akred-badge ${getAkredClass(r.peringkat)}">${r.peringkat}</span></td>
        <td class="sertifikat-cell">${r.noSert}</td>
        <td class="date-cell">${r.tglAkred}</td>
        <td class="date-cell">${r.expired}</td>
        <td><span class="akred-badge ${r.status === 'Aktif' ? 'unggul' : 'proses'}">${r.status}</span></td>
        <td>${fileBtnHtml()}</td>
    </tr>`).join('');
}


// ══════════════════════════════════════════════
// PAGE: AKREDITASI ASIC
// ══════════════════════════════════════════════

function initAkredASIC() {
    const tbody = document.getElementById('asicTableBody');
    if (!tbody) return;
    const countEl = document.getElementById('asicCount');
    if (countEl) countEl.textContent = `${AKRED_ASIC_DATA.length} Items`;

    tbody.innerHTML = AKRED_ASIC_DATA.map((r, i) => `<tr>
        <td class="row-num">${i+1}</td>
        <td class="prodi-name">${r.prodi}</td>
        <td class="date-cell">${r.period}</td>
        <td><span class="fak-badge">${r.accreditation_code || r.akred}</span></td>
        <td class="date-cell">${r.created_at_fmt || r.tglAkred}</td>
        <td>${fileBtnHtml(r.file_pdf)}</td>
    </tr>`).join('');
}


// ══════════════════════════════════════════════
// PAGE: AKREDITASI ASIIN
// ══════════════════════════════════════════════

function initAkredASIIN() {
    const tbody = document.getElementById('asiinTableBody');
    if (!tbody) return;
    const countEl = document.getElementById('asiinCount');
    if (countEl) countEl.textContent = `${AKRED_ASIIN_DATA.length} Items`;

    tbody.innerHTML = AKRED_ASIIN_DATA.map((r, i) => `<tr>
        <td class="row-num">${i+1}</td>
        <td class="prodi-name">${r.prodi}</td>
        <td class="date-cell">${r.period}</td>
        <td>${(r.accreditation_code || r.akred) ? `<span class="fak-badge">${r.accreditation_code || r.akred}</span>` : '<span style="color:var(--text-light)">—</span>'}</td>
        <td class="date-cell">${r.created_at_fmt || r.tglAkred}</td>
        <td>${fileBtnHtml(r.file_pdf)}</td>
    </tr>`).join('');
}


// ══════════════════════════════════════════════
// PAGE: DATA DOSEN
// ══════════════════════════════════════════════

let dosenPaginator = null;

function initDataDosen() {
    const tbody = document.getElementById('dosenTableBody');
    if (!tbody) return;

    dosenPaginator = createPaginator({
        allData: DOSEN_DATA,
        tbodyId: 'dosenTableBody', countId: 'dosenCount', infoId: 'dosenPagInfo', pagId: 'dosenPagination',
        pagFnName: 'goToDosenPage', cols: 9, perPage: 15,
        rowFn: (r, i) => `<tr>
            <td class="row-num">${i+1}</td>
            <td><span class="fak-badge">${r.fak}</span></td>
            <td class="prodi-name" style="font-weight:500;font-size:.8rem">${r.prodi}</td>
            <td class="prodi-name">${r.nama}</td>
            <td><span class="fak-badge">${r.pendidikan}</span></td>
            <td class="date-cell">${r.gol}</td>
            <td style="font-size:.78rem">${r.pangkat}</td>
            <td style="font-size:.78rem">${r.jabatan}</td>
            <td><span class="akred-badge ${r.status==='PNS'?'a':'proses'}">${r.status}</span></td>
        </tr>`
    });

    // Populate fakultas filter
    const fakFilter = document.getElementById('filterDosenFak');
    if (fakFilter) {
        [...new Set(DOSEN_DATA.map(r => r.fak))].sort().forEach(f => {
            const o = document.createElement('option'); o.value = f; o.textContent = f; fakFilter.appendChild(o);
        });
    }

    dosenPaginator.render();
}

window.applyDosenFilter = function() {
    if (!dosenPaginator) return;
    const fak = (document.getElementById('filterDosenFak') || {}).value || '';
    const nama = (document.getElementById('filterDosenNama') || {}).value || '';
    const filtered = DOSEN_DATA.filter(r => {
        if (fak && r.fak !== fak) return false;
        if (nama && !r.nama.toLowerCase().includes(nama.toLowerCase())) return false;
        return true;
    });
    dosenPaginator.setData(filtered);
};

window.resetDosenFilter = function() {
    const f1 = document.getElementById('filterDosenFak'); if (f1) f1.value = '';
    const f2 = document.getElementById('filterDosenNama'); if (f2) f2.value = '';
    if (dosenPaginator) dosenPaginator.reset();
};


// ══════════════════════════════════════════════
// PAGE: DATA TENAGA KEPENDIDIKAN
// ══════════════════════════════════════════════

let tendikPaginator = null;

function initDataTendik() {
    const tbody = document.getElementById('tendikTableBody');
    if (!tbody) return;

    tendikPaginator = createPaginator({
        allData: TENDIK_DATA,
        tbodyId: 'tendikTableBody', countId: 'tendikCount', infoId: 'tendikPagInfo', pagId: 'tendikPagination',
        pagFnName: 'goToTendikPage', cols: 7, perPage: 15,
        rowFn: (r, i) => `<tr>
            <td class="row-num">${i+1}</td>
            <td class="prodi-name">${r.nama}</td>
            <td class="date-cell" style="font-size:.78rem">${r.nip}</td>
            <td class="date-cell">${r.gol}</td>
            <td style="font-size:.78rem">${r.pangkat}</td>
            <td style="font-size:.8rem;max-width:250px">${r.unitKerja}</td>
            <td><span class="akred-badge ${r.status==='PNS'?'a':r.status==='PPPK'?'b':'proses'}">${r.status}</span></td>
        </tr>`
    });

    // Populate unit kerja filter
    const ukFilter = document.getElementById('filterTendikUnit');
    if (ukFilter) {
        [...new Set(TENDIK_DATA.map(r => r.unitKerja))].sort().forEach(u => {
            const o = document.createElement('option'); o.value = u; o.textContent = u.length > 50 ? u.substring(0,47)+'...' : u; ukFilter.appendChild(o);
        });
    }

    tendikPaginator.render();
}

window.applyTendikFilter = function() {
    if (!tendikPaginator) return;
    const unit = (document.getElementById('filterTendikUnit') || {}).value || '';
    const nama = (document.getElementById('filterTendikNama') || {}).value || '';
    const filtered = TENDIK_DATA.filter(r => {
        if (unit && r.unitKerja !== unit) return false;
        if (nama && !r.nama.toLowerCase().includes(nama.toLowerCase())) return false;
        return true;
    });
    tendikPaginator.setData(filtered);
};

window.resetTendikFilter = function() {
    const f1 = document.getElementById('filterTendikUnit'); if (f1) f1.value = '';
    const f2 = document.getElementById('filterTendikNama'); if (f2) f2.value = '';
    if (tendikPaginator) tendikPaginator.reset();
};


// ══════════════════════════════════════════════
// NAVBAR INTERACTIONS (shared)
// ══════════════════════════════════════════════

(function initNavbar() {
    const dropdownItems = document.querySelectorAll('.nav-item:not(a)');
    dropdownItems.forEach(item => {
        if (!item.querySelector('.nav-dropdown')) return;
        item.addEventListener('click', (e) => {
            if (e.target.closest('.nav-dropdown-item')) return;
            e.stopPropagation();
            const isOpen = item.classList.contains('open');
            dropdownItems.forEach(d => d.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    });
    document.addEventListener('click', () => { dropdownItems.forEach(d => d.classList.remove('open')); });

    const navToggle = document.getElementById('navToggle');
    const navItems = document.getElementById('navItems');
    if (navToggle && navItems) {
        navToggle.addEventListener('click', () => { navItems.classList.toggle('mobile-open'); });
    }
})();


// ══════════════════════════════════════════════
// INIT — auto-detect page and initialize
// ══════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', () => {
    initAkredProdi();
    initAkredInstitusi();
    initAkredASIC();
    initAkredASIIN();
    initDataDosen();
    initDataTendik();
});
