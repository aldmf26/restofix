<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AddKokiController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\dataOrderanController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\DpController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\LoginAdministratorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginSoondobuController;
use App\Http\Controllers\LoginTakemoriController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MencuciController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\OrderanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\SoldOutController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\tabelDistribusiController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VoidController;
use App\Http\Controllers\VoucherHapusController;
use App\Http\Controllers\WaktuTungguController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/error', function(){
    return view('errors.403aldi');
})->name('error');

Route::get('/voucher_hapus', [VoucherHapusController::class, 'index'])->name('voucher_hapus');
Route::get('/point_kerja', [OrderController::class, 'index'])->name('point_kerja');
Route::get('/henKategori', [OrderController::class, 'index'])->name('henKategori');

Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/tb_order3', [APIController::class, 'tb_order3'])->name('tb_order3');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/loginTakemori', [LoginTakemoriController::class, 'index'])->name('loginTakemori');
Route::get('/loginSoondobu', [LoginSoondobuController::class, 'index'])->name('loginSoondobu');
Route::get('/loginAdministrator', [LoginAdministratorController::class, 'index'])->name('loginAdministrator');
Route::post('/aksiLoginAdm', [LoginAdministratorController::class, 'aksiLoginAdm'])->name('aksiLoginAdm');
Route::post('/aksiLoginTkm', [LoginTakemoriController::class, 'aksiLoginTkm'])->name('aksiLoginTkm');
Route::post('/aksiLoginSdb', [LoginSoondobuController::class, 'aksiLoginSdb'])->name('aksiLoginSdb');
Route::get('/logoutTkm', [LoginTakemoriController::class, 'logoutTkm'])->name('logoutTkm');
Route::get('/logoutSdb', [LoginSoondobuController::class, 'logoutSdb'])->name('logoutSdb');
Route::get('/logoutAdm', [LoginAdministratorController::class, 'logoutAdm'])->name('logoutAdm');
Route::get('/gantiPassAdm', [LoginAdministratorController::class, 'gantiPassAdm'])->name('gantiPassAdm');


// Administrator
Route::get('/administrator', [AdministratorController::class, 'index'])->name('administrator')->middleware('auth');
Route::post('/addAdministrator', [AdministratorController::class, 'addAdministrator'])->name('addAdministrator')->middleware('auth');
Route::get('/deleteAdministrator', [AdministratorController::class, 'deleteAdministrator'])->name('deleteAdministrator')->middleware('auth');
Route::patch('/editAdministrator', [AdministratorController::class, 'editAdministrator'])->name('editAdministrator')->middleware('auth');
Route::get('/karyawanExport', [AdministratorController::class, 'karyawanExport'])->name('karyawanExport')->middleware('auth');
Route::post('/karyawanImport', [AdministratorController::class, 'karyawanImport'])->name('karyawanImport')->middleware('auth');

// Akunting
Route::get('/accounting', [AccountingController::class, 'index'])->name('accounting')->middleware('auth');
Route::get('/getNoAkun', [AccountingController::class, 'getNoAkun'])->name('getNoAkun')->middleware('auth');
Route::get('/getAkunBiaya', [AccountingController::class, 'getAkunBiaya'])->name('getAkunBiaya')->middleware('auth');
Route::get('/katAkun', [AccountingController::class, 'katAkun'])->name('katAkun')->middleware('auth');
Route::post('/addKategoriAkun', [AccountingController::class, 'addKategoriAkun'])->name('addKategoriAkun')->middleware('auth');
Route::get('/delKetAkun', [AccountingController::class, 'delKetAkun'])->name('delKetAkun')->middleware('auth');
Route::post('/addPostCenter', [AccountingController::class, 'addPostCenter'])->name('addPostCenter')->middleware('auth');
Route::get('/delPostCenter', [AccountingController::class, 'delPostCenter'])->name('delPostCenter')->middleware('auth');
Route::get('/get_data_post_center', [AccountingController::class, 'get_data_post_center'])->name('get_data_post_center')->middleware('auth');
Route::get('/dashboard', [AccountingController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/akun', [AccountingController::class, 'akun'])->name('akun')->middleware('auth');
Route::post('/addAkun', [AccountingController::class, 'addAkun'])->name('addAkun')->middleware('auth');
Route::patch('/editAkun', [AccountingController::class, 'editAkun'])->name('editAkun')->middleware('auth');
Route::get('/deleteAkun', [AccountingController::class, 'deleteAkun'])->name('deleteAkun')->middleware('auth');
Route::post('/importAkun', [AccountingController::class, 'importAkun'])->name('importAkun')->middleware('auth');
Route::get('/exportAkun', [AccountingController::class, 'exportAkun'])->name('exportAkun')->middleware('auth');
Route::post('/relasiAkun', [AccountingController::class, 'relasiAkun'])->name('relasiAkun')->middleware('auth');
Route::post('/add_relation_akun', [AccountingController::class, 'add_relation_akun'])->name('add_relation_akun')->middleware('auth');

// lap bulanan
Route::get('/lapBulanan', [AccountingController::class, 'lapBulanan'])->name('lapBulanan')->middleware('auth');
Route::get('/excelLapBulanan', [AccountingController::class, 'excelLapBulanan'])->name('excelLapBulanan')->middleware('auth');
Route::get('/lapExportAll', [AccountingController::class, 'lapExportAll'])->name('lapExportAll')->middleware('auth');
Route::get('/getDetailLap', [AccountingController::class, 'getDetailLap'])->name('getDetailLap')->middleware('auth');
Route::get('/getDetailLap2', [AccountingController::class, 'getDetailLap2'])->name('getDetailLap2')->middleware('auth');

// cash flow
Route::get('/cashFlow', [AccountingController::class, 'cashFlow'])->name('cashFlow')->middleware('auth');
Route::post('/save_budget', [AccountingController::class, 'save_budget'])->name('save_budget')->middleware('auth');
Route::get('/get_detail2', [AccountingController::class, 'get_detail2'])->name('get_detail2')->middleware('auth');
Route::get('/get_detail', [AccountingController::class, 'get_detail'])->name('get_detail')->middleware('auth');
Route::get('/export_all', [AccountingController::class, 'export_all'])->name('export_all')->middleware('auth');

// profit & loss
Route::get('/pl', [AccountingController::class, 'pl'])->name('pl')->middleware('auth');

// akunting 2
Route::get('/jPenutup', [AccountingController::class, 'jPenutup'])->name('jPenutup')->middleware('auth');
Route::get('/printJPenutup', [AccountingController::class, 'printJPenutup'])->name('printJPenutup')->middleware('auth');
Route::get('/excelJPenutup', [AccountingController::class, 'excelJPenutup'])->name('excelJPenutup')->middleware('auth');
Route::post('/importJPenutup', [AccountingController::class, 'importJPenutup'])->name('importJPenutup')->middleware('auth');
Route::post('/addJPenutup', [AccountingController::class, 'addJPenutup'])->name('addJPenutup')->middleware('auth');
Route::get('/get_akun_penutup', [AccountingController::class, 'get_akun_penutup'])->name('get_akun_penutup')->middleware('auth');
Route::get('/getPenutup', [AccountingController::class, 'getPenutup'])->name('getPenutup')->middleware('auth');

// laba rugi
Route::get('/labaRugi', [AccountingController::class, 'labaRugi'])->name('labaRugi')->middleware('auth');
Route::get('/printLabaRugi', [AccountingController::class, 'printLabaRugi'])->name('printLabaRugi')->middleware('auth');
Route::get('/excelLabaRugi', [AccountingController::class, 'excelLabaRugi'])->name('excelLabaRugi')->middleware('auth');

// neraca saldo penutup
Route::get('/neracaSaldoPenutup', [AccountingController::class, 'neracaSaldoPenutup'])->name('neracaSaldoPenutup')->middleware('auth');

// neraca saldo baru
Route::get('/neracaSaldoBaru', [AccountingController::class, 'neracaSaldoBaru'])->name('neracaSaldoBaru')->middleware('auth');
Route::get('/addSaldoAwal', [AccountingController::class, 'addSaldoAwal'])->name('addSaldoAwal')->middleware('auth');
Route::get('/saveSaldoAwal', [AccountingController::class, 'saveSaldoAwal'])->name('saveSaldoAwal')->middleware('auth');
Route::get('/saldoAwalDanger', [AccountingController::class, 'saldoAwalDanger'])->name('saldoAwalDanger')->middleware('auth');

// cancel jurnal
Route::get('/cancelJurnal', [AccountingController::class, 'cancelJurnal'])->name('cancelJurnal')->middleware('auth');
Route::post('/saveCancel', [AccountingController::class, 'saveCancel'])->name('saveCancel')->middleware('auth');

Route::get('/jPenyesuaian1', [AccountingController::class, 'jPenyesuaian1'])->name('jPenyesuaian1')->middleware('auth');
Route::get('/edit_get_jurnal', [AccountingController::class, 'edit_get_jurnal'])->name('edit_get_jurnal')->middleware('auth');
Route::post('/edit_penyesuaian', [AccountingController::class, 'edit_penyesuaian'])->name('edit_penyesuaian')->middleware('auth');
Route::get('/get_relation_akun', [AccountingController::class, 'get_relation_akun'])->name('get_relation_akun')->middleware('auth');
Route::get('/get_relation_peralatan', [AccountingController::class, 'get_relation_peralatan'])->name('get_relation_peralatan')->middleware('auth');
Route::get('/get_relation_atk', [AccountingController::class, 'get_relation_atk'])->name('get_relation_atk')->middleware('auth');
Route::get('/get_relation_daging', [AccountingController::class, 'get_relation_daging'])->name('get_relation_daging')->middleware('auth');
Route::get('/excel_atk', [AccountingController::class, 'excel_atk'])->name('excel_atk')->middleware('auth');
Route::get('/print_atk', [AccountingController::class, 'print_atk'])->name('print_atk')->middleware('auth');
Route::post('/add_penyesuaian_atk', [AccountingController::class, 'add_penyesuaian_atk'])->name('add_penyesuaian_atk')->middleware('auth');
Route::post('/add_penyesuaian_daging', [AccountingController::class, 'add_penyesuaian_daging'])->name('add_penyesuaian_daging')->middleware('auth');
Route::get('/deletePenyesuaian', [AccountingController::class, 'deletePenyesuaian'])->name('deletePenyesuaian')->middleware('auth');
Route::post('/add_penyesuaian_peralatan', [AccountingController::class, 'add_penyesuaian_peralatan'])->name('add_penyesuaian_peralatan')->middleware('auth');
Route::post('/add_penyesuaian_akun', [AccountingController::class, 'add_penyesuaian_akun'])->name('add_penyesuaian_akun')->middleware('auth');
Route::get('/get_relation_aktiva', [AccountingController::class, 'get_relation_aktiva'])->name('get_relation_aktiva')->middleware('auth');
Route::post('/add_penyesuaian_aktiva', [AccountingController::class, 'add_penyesuaian_aktiva'])->name('add_penyesuaian_aktiva')->middleware('auth');
Route::get('/jPenyesuaian2', [AccountingController::class, 'jPenyesuaian2'])->name('jPenyesuaian2')->middleware('auth');
Route::post('/add_penyesuaian', [AccountingController::class, 'add_penyesuaian'])->name('add_penyesuaian')->middleware('auth');
Route::get('/get_aktiva', [AccountingController::class, 'get_aktiva'])->name('get_aktiva')->middleware('auth');
Route::get('/jumlah_akv', [AccountingController::class, 'jumlah_akv'])->name('jumlah_akv')->middleware('auth');
Route::get('/exportJP2', [AccountingController::class, 'exportJP2'])->name('exportJP2')->middleware('auth');

Route::get('/jPemasukan', [AccountingController::class, 'jPemasukan'])->name('jPemasukan')->middleware('auth');
Route::get('/delJpem', [AccountingController::class, 'delJpem'])->name('delJpem')->middleware('auth');
Route::post('/updateJpem', [AccountingController::class, 'updateJpem'])->name('updateJpem')->middleware('auth');
Route::get('/jPengeluaran', [AccountingController::class, 'jPengeluaran'])->name('jPengeluaran')->middleware('auth');
Route::get('/jPengeluaran2', [AccountingController::class, 'jPengeluaran2'])->name('jPengeluaran2')->middleware('auth');
Route::get('/loadFormJP', [AccountingController::class, 'loadFormJP'])->name('loadFormJP')->middleware('auth');
Route::get('/edit_jurnal', [AccountingController::class, 'edit_jurnal'])->name('edit_jurnal')->middleware('auth');
Route::post('/saveEditJurnal', [AccountingController::class, 'saveEditJurnal'])->name('saveEditJurnal')->middleware('auth');
Route::post('/addjPengeluaran', [AccountingController::class, 'addjPengeluaran'])->name('addjPengeluaran')->middleware('auth');
Route::post('/addjAtk', [AccountingController::class, 'addjAtk'])->name('addjAtk')->middleware('auth');
Route::post('/addjPeralatan', [AccountingController::class, 'addjPeralatan'])->name('addjPeralatan')->middleware('auth');
Route::post('/addjAktiva', [AccountingController::class, 'addjAktiva'])->name('addjAktiva')->middleware('auth');
Route::post('/addjStok', [AccountingController::class, 'addjStok'])->name('addjStok')->middleware('auth');
Route::post('/getProjek', [AccountingController::class, 'getProjek'])->name('getProjek')->middleware('auth');
Route::get('/getPost', [AccountingController::class, 'getPost'])->name('getPost')->middleware('auth');
Route::get('/getPost2', [AccountingController::class, 'getPost2'])->name('getPost2')->middleware('auth');
Route::get('/getHargaAktiva', [AccountingController::class, 'getHargaAktiva'])->name('getHargaAktiva')->middleware('auth');
Route::get('/deletejPengeluaran', [AccountingController::class, 'deletejPengeluaran'])->name('deletejPengeluaran')->middleware('auth');

Route::get('/neracaSaldo', [AccountingController::class, 'neracaSaldo'])->name('neracaSaldo')->middleware('auth');
Route::get('/addNeracaSaldo', [AccountingController::class, 'addNeracaSaldo'])->name('addNeracaSaldo')->middleware('auth');
Route::get('/bukuBesar', [AccountingController::class, 'bukuBesar'])->name('bukuBesar')->middleware('auth');
Route::get('/detailBukuBesar', [AccountingController::class, 'detailBukuBesar'])->name('detailBukuBesar')->middleware('auth');
Route::get('/printBukuBesar', [AccountingController::class, 'printBukuBesar'])->name('printBukuBesar')->middleware('auth');
Route::get('/exportBukuBesar', [AccountingController::class, 'exportBukuBesar'])->name('exportBukuBesar')->middleware('auth');
Route::get('/exportDetailBukuBesar', [AccountingController::class, 'exportDetailBukuBesar'])->name('exportDetailBukuBesar')->middleware('auth');

// more
Route::get('/kelPeralatan', [AccountingController::class, 'kelPeralatan'])->name('kelPeralatan')->middleware('auth');
Route::post('/editKelPeralatan', [AccountingController::class, 'editKelPeralatan'])->name('editKelPeralatan')->middleware('auth');

// list bahan
Route::get('/lBahan', [AccountingController::class, 'lBahan'])->name('lBahan')->middleware('auth');
Route::get('/mBahan', [AccountingController::class, 'mBahan'])->name('mBahan')->middleware('auth');
Route::post('/saveMbahan', [AccountingController::class, 'saveMbahan'])->name('saveMbahan')->middleware('auth');
Route::post('/editMbahan', [AccountingController::class, 'editMbahan'])->name('editMbahan')->middleware('auth');
Route::get('/delMbahan', [AccountingController::class, 'delMbahan'])->name('delMbahan')->middleware('auth');
Route::get('/getSatuanResep', [AccountingController::class, 'getSatuanResep'])->name('getSatuanResep')->middleware('auth');
Route::get('/getMerkBahan', [AccountingController::class, 'getMerkBahan'])->name('getMerkBahan')->middleware('auth');
Route::get('/getLbahan', [AccountingController::class, 'getLbahan'])->name('getLbahan')->middleware('auth');
Route::get('/tbhBahan', [AccountingController::class, 'tbhBahan'])->name('tbhBahan')->middleware('auth');
Route::get('/getEditMbahan', [AccountingController::class, 'getEditMbahan'])->name('getEditMbahan')->middleware('auth');
Route::get('/getKategoriMakanan', [AccountingController::class, 'getKategoriMakanan'])->name('getKategoriMakanan')->middleware('auth');
Route::get('/delKategoriMakanan', [AccountingController::class, 'delKategoriMakanan'])->name('delKategoriMakanan')->middleware('auth');
Route::post('/addKategoriMakanan', [AccountingController::class, 'addKategoriMakanan'])->name('addKategoriMakanan')->middleware('auth');
Route::post('/saveLbahan', [AccountingController::class, 'saveLbahan'])->name('saveLbahan')->middleware('auth');
Route::post('/editLbahan', [AccountingController::class, 'editLbahan'])->name('editLbahan')->middleware('auth');
Route::get('/delLbahan', [AccountingController::class, 'delLbahan'])->name('delLbahan')->middleware('auth');
Route::get('/stokMakanan', [AccountingController::class, 'stokMakanan'])->name('stokMakanan')->middleware('auth');
Route::get('/delStokMakanan', [AccountingController::class, 'delStokMakanan'])->name('delStokMakanan')->middleware('auth');
Route::get('/lResep', [AccountingController::class, 'lResep'])->name('lResep')->middleware('auth');
Route::post('/saveResep', [AccountingController::class, 'saveResep'])->name('saveResep')->middleware('auth');
Route::get('/delResep', [AccountingController::class, 'delResep'])->name('delResep')->middleware('auth');
Route::post('/editResep', [AccountingController::class, 'editResep'])->name('editResep')->middleware('auth');
Route::get('/getEditResep', [AccountingController::class, 'getEditResep'])->name('getEditResep')->middleware('auth');
Route::get('/delEditResep', [AccountingController::class, 'delEditResep'])->name('delEditResep')->middleware('auth');
Route::get('/getBiayaPenunjang', [AccountingController::class, 'getBiayaPenunjang'])->name('getBiayaPenunjang')->middleware('auth');
Route::post('/saveBiayaPenunjang', [AccountingController::class, 'saveBiayaPenunjang'])->name('saveBiayaPenunjang')->middleware('auth');
// menu
Route::get('/accMenu', [AccountingController::class, 'accMenu'])->name('accMenu')->middleware('auth');
Route::post('/saveAccMenu', [AccountingController::class, 'saveAccMenu'])->name('saveAccMenu')->middleware('auth');
Route::post('/saveMenuUrutan', [AccountingController::class, 'saveMenuUrutan'])->name('saveMenuUrutan')->middleware('auth');
Route::post('/saveAccSubMenu', [AccountingController::class, 'saveAccSubMenu'])->name('saveAccSubMenu')->middleware('auth');
Route::post('/editAccMenu', [AccountingController::class, 'editAccMenu'])->name('editAccMenu')->middleware('auth');
Route::post('/editSubMenu', [AccountingController::class, 'editSubMenu'])->name('editSubMenu')->middleware('auth');
Route::get('/deleteAccMenu', [AccountingController::class, 'deleteAccMenu'])->name('deleteAccMenu')->middleware('auth');
Route::get('/deleteAccSubMenu', [AccountingController::class, 'deleteAccSubMenu'])->name('deleteAccSubMenu')->middleware('auth');

// user acc
Route::get('/accUser', [AccountingController::class, 'accUser'])->name('accUser')->middleware(['auth']);
Route::post('/accPermission', [AccountingController::class, 'accPermission'])->name('accPermission')->middleware('auth');

// export
Route::get('/exportJPengeluaran', [AccountingController::class, 'exportJPengeluaran'])->name('exportJPengeluaran')->middleware('auth');
Route::get('/exportJPemasukan', [AccountingController::class, 'exportJPemasukan'])->name('exportJPemasukan')->middleware('auth');
// ---------------------------------------------


Route::get('/gaji', [GajiController::class, 'index'])->name('gaji')->middleware('auth');
Route::post('/addGaji', [GajiController::class, 'addGaji'])->name('addGaji')->middleware('auth');
Route::patch('/editGaji', [GajiController::class, 'editGaji'])->name('editGaji')->middleware('auth');
Route::get('/gajiExport', [GajiController::class, 'gajiExport'])->name('gajiExport')->middleware('auth');
Route::post('/gajiImport', [GajiController::class, 'gajiImport'])->name('gajiImport')->middleware('auth');
Route::get('/gajiExportTemplate', [GajiController::class, 'gajiExportTemplate'])->name('gajiExportTemplate')->middleware('auth');
Route::get('/gajiSum', [GajiController::class, 'gajiSum'])->name('gajiSum')->middleware('auth');
Route::get('/tabelGaji', [GajiController::class, 'tabelGaji'])->name('tabelGaji')->middleware('auth');
Route::get('/gaji_export_new', [GajiController::class, 'gaji_export_new'])->name('gaji_export_new')->middleware('auth');

Route::get('/status', [StatusController::class, 'index'])->name('status')->middleware('auth');
Route::post('/addStatus', [StatusController::class, 'addStatus'])->name('addStatus')->middleware('auth');
Route::patch('/editStatus', [StatusController::class, 'editStatus'])->name('editStatus')->middleware('auth');
Route::get('/deleteStatus', [StatusController::class, 'deleteStatus'])->name('deleteStatus')->middleware('auth');

Route::get('/posisi', [PosisiController::class, 'index'])->name('posisi')->middleware('auth');
Route::post('/addPosisi', [PosisiController::class, 'addPosisi'])->name('addPosisi')->middleware('auth');
Route::patch('/editPosisi', [PosisiController::class, 'editPosisi'])->name('editPosisi')->middleware('auth');
Route::get('/deletePosisi', [PosisiController::class, 'deletePosisi'])->name('deletePosisi')->middleware('auth');
// ----------------------------------------------------------------------

// Menu Database --------------------------------------------------------
Route::get('/menu', [MenuController::class, 'index'])->name('menu')->middleware('auth');
Route::get('/tblMenu', [MenuController::class, 'tblMenu'])->name('tblMenu')->middleware('auth');
Route::get('/cariMenu', [MenuController::class, 'cariMenu'])->name('cariMenu')->middleware('auth');
Route::post('/addMenu', [MenuController::class, 'addMenu'])->name('addMenu')->middleware('auth');
Route::get('/deleteMenu', [MenuController::class, 'deleteMenu'])->name('deleteMenu')->middleware('auth');
Route::post('/updateMenu', [MenuController::class, 'updateMenu'])->name('updateMenu')->middleware('auth');
Route::post('/editMenuCheck', [MenuController::class, 'editMenuCheck'])->name('editMenuCheck')->middleware('auth');
Route::post('/plusDistribusi', [MenuController::class, 'plusDistribusi'])->name('plusDistribusi')->middleware('auth');
Route::post('/importMenu', [MenuController::class, 'importMenu'])->name('importMenu')->middleware('auth');
Route::get('/exportMenu', [MenuController::class, 'exportMenu'])->name('exportMenu')->middleware('auth');
Route::get('/station', [MenuController::class, 'station'])->name('station')->middleware('auth');
Route::post('/addStation', [MenuController::class, 'addStation'])->name('addStation')->middleware('auth');
Route::get('/delStation', [MenuController::class, 'delStation'])->name('delStation')->middleware('auth');
// -----------------------------------------------                

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan')->middleware('auth');
Route::post('/addKaryawan', [KaryawanController::class, 'addKaryawan'])->name('addKaryawan')->middleware('auth');
Route::get('/deleteKaryawan', [KaryawanController::class, 'deleteKaryawan'])->name('deleteKaryawan')->middleware('auth');
Route::patch('/editKaryawan', [KaryawanController::class, 'editKaryawan'])->name('editKaryawan')->middleware('auth');

Route::get('/discount', [DiscountController::class, 'index'])->name('discount')->middleware('auth');
Route::post('/addDiscount', [DiscountController::class, 'addDiscount'])->name('addDiscount')->middleware('auth');
Route::get('/deleteDiscount', [DiscountController::class, 'deleteDiscount'])->name('deleteDiscount')->middleware('auth');
Route::get('/in_discount', [DiscountController::class, 'in_discount'])->name('in_discount')->middleware('auth');
Route::get('/un_discount', [DiscountController::class, 'un_discount'])->name('un_discount')->middleware('auth');
Route::get('/un_discount', [DiscountController::class, 'un_discount'])->name('un_discount')->middleware('auth');
Route::post('/addVoucher', [DiscountController::class, 'addVoucher'])->name('addVoucher')->middleware('auth');
Route::patch('/editVoucher', [DiscountController::class, 'editVoucher'])->name('editVoucher')->middleware('auth');
Route::get('/deleteVoucher', [DiscountController::class, 'deleteVoucher'])->name('deleteVoucher')->middleware('auth');
Route::get('/in_voucher', [DiscountController::class, 'in_voucher'])->name('in_voucher')->middleware('auth');
Route::get('/un_voucher', [DiscountController::class, 'un_voucher'])->name('un_voucher')->middleware('auth');
Route::get('/voucher_pembayaran', [DiscountController::class, 'voucher_pembayaran'])->name('voucher_pembayaran')->middleware('auth');
Route::get('/exportVoucher', [DiscountController::class, 'exportVoucher'])->name('exportVoucher')->middleware('auth');
Route::get('/downloadDiscount', [DiscountController::class, 'downloadDiscount'])->name('downloadDiscount');

Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi')->middleware('auth');
Route::post('/addDistribusi', [DistribusiController::class, 'addDistribusi'])->name('addDistribusi')->middleware('auth');
Route::post('/updateDistribusi', [DistribusiController::class, 'updateDistribusi'])->name('updateDistribusi')->middleware('auth');
Route::post('/inputDistribusi', [DistribusiController::class, 'inputDistribusi'])->name('inputDistribusi')->middleware('auth');
Route::get('tabelDistribusi', [tabelDistribusiController::class, 'index'])->name('tabelDistribusi')->middleware('auth');

Route::get('/ongkir', [OngkirController::class, 'index'])->name('ongkir')->middleware('auth');
Route::post('/editOngkir', [OngkirController::class, 'editOngkir'])->name('editOngkir')->middleware('auth');
Route::post('/editBatasOngkir', [OngkirController::class, 'editBatasOngkir'])->name('editBatasOngkir')->middleware('auth');

Route::get('/users', [UsersController::class, 'index'])->name('users')->middleware('auth');
Route::post('/permission', [UsersController::class, 'permission'])->name('permission')->middleware('auth');
Route::get('/importPermission', [UsersController::class, 'importPermission'])->name('importPermission')->middleware('auth');
Route::post('/addUsers', [UsersController::class, 'addUsers'])->name('addUsers')->middleware('auth');
Route::post('/editUrutan', [UsersController::class, 'editUrutan'])->name('editUrutan')->middleware('auth');
Route::post('/tbhMenu', [UsersController::class, 'tbhMenu'])->name('tbhMenu');
Route::get('/adminMenu', [UsersController::class, 'adminMenu'])->name('adminMenu')->middleware('auth');
Route::get('/restoMenu', [UsersController::class, 'restoMenu'])->name('restoMenu')->middleware('auth');


Route::get('/soldOut', [SoldOutController::class, 'index'])->name('soldOut')->middleware('auth');
Route::post('/addSoldOut', [SoldOutController::class, 'addSoldOut'])->name('addSoldOut')->middleware('auth');
Route::get('/hapusSoldOut', [SoldOutController::class, 'hapusSoldOut'])->name('hapusSoldOut')->middleware('auth');

Route::get('/waktuTunggu', [WaktuTungguController::class, 'index'])->name('waktuTunggu')->middleware('auth');
Route::post('/addWaktuTunggu', [WaktuTungguController::class, 'addWaktuTunggu'])->name('addWaktuTunggu')->middleware('auth');
Route::get('/hapusWaktuTunggu', [WaktuTungguController::class, 'hapusWaktuTunggu'])->name('hapusWaktuTunggu')->middleware('auth');
Route::get('/get_peringatan', [WaktuTungguController::class, 'get_peringatan'])->name('get_peringatan')->middleware('auth');

Route::get('/limit', [LimitController::class, 'index'])->name('limit')->middleware('auth');
Route::post('/add_limit', [LimitController::class, 'add_limit'])->name('add_limit')->middleware('auth');
Route::get('/hapus_limit', [LimitController::class, 'hapus_limit'])->name('hapus_limit')->middleware('auth');
// ---------------------------------------------------------------------------

// menu catatan -------------------------------------------------------------------------
Route::get('/driver', [DriverController::class, 'index'])->name('driver')->middleware('auth');
Route::post('/printDriver', [DriverController::class, 'printDriver'])->name('printDriver')->middleware('auth');

Route::get('/kasbon', [KasbonController::class, 'index'])->name('kasbon')->middleware('auth');
Route::post('/addKasbon', [KasbonController::class, 'addKasbon'])->name('addKasbon')->middleware('auth');
Route::get('/deleteKasbon', [KasbonController::class, 'deleteKasbon'])->name('deleteKasbon')->middleware('auth');
Route::patch('/editKasbon', [KasbonController::class, 'editKasbon'])->name('editKasbon')->middleware('auth');
Route::post('/printKasbon', [KasbonController::class, 'printKasbon'])->name('printKasbon')->middleware('auth');

Route::get('/mencuci', [MencuciController::class, 'index'])->name('mencuci')->middleware('auth');
Route::post('/addMencuci', [MencuciController::class, 'addMencuci'])->name('addMencuci')->middleware('auth');
Route::get('/deleteMencuci', [MencuciController::class, 'deleteMencuci'])->name('deleteMencuci')->middleware('auth');
Route::patch('/editMencuci', [MencuciController::class, 'editMencuci'])->name('editMencuci')->middleware('auth');

Route::get('/denda', [DendaController::class, 'index'])->name('denda')->middleware('auth');
Route::post('/printDenda', [DendaController::class, 'printDenda'])->name('printDenda')->middleware('auth');
Route::post('/printDendaPerorang', [DendaController::class, 'printDendaPerorang'])->name('printDendaPerorang')->middleware('auth');
Route::post('/addDenda', [DendaController::class, 'addDenda'])->name('addDenda')->middleware('auth');
Route::get('/deleteDenda', [DendaController::class, 'deleteDenda'])->name('deleteDenda')->middleware('auth');
Route::patch('/editDenda', [DendaController::class, 'editDenda'])->name('editDenda')->middleware('auth');

Route::get('/tips', [TipsController::class, 'index'])->name('tips')->middleware('auth');
Route::post('/addTips', [TipsController::class, 'addTips'])->name('addTips')->middleware('auth');
Route::patch('/editTips', [TipsController::class, 'editTips'])->name('editTips')->middleware('auth');
Route::get('/deleteTips', [TipsController::class, 'deleteTips'])->name('deleteTips')->middleware('auth');

Route::get('/dp', [DpController::class, 'index'])->name('dp')->middleware('auth');
Route::get('/delDp', [DpController::class, 'delDp'])->name('delDp')->middleware('auth');
Route::post('/addDp', [DpController::class, 'addDp'])->name('addDp')->middleware('auth');
// --------------------------------------------------------------------------------------

Route::get('/addKoki', [AddKokiController::class, 'index'])->name('addKoki')->middleware('auth');
Route::post('/absenKoki', [AddKokiController::class, 'absenKoki'])->name('absenKoki')->middleware('auth');
Route::post('/delAbsKoki', [AddKokiController::class, 'delAbsKoki'])->name('delAbsKoki')->middleware('auth');

Route::get('/absen', [AbsenController::class, 'index'])->name('absen')->middleware('auth');
Route::get('/tabelAbsenM', [AbsenController::class, 'tabelAbsenM'])->name('tabelAbsenM')->middleware('auth');
Route::post('/addAbsenM', [AbsenController::class, 'addAbsenM'])->name('addAbsenM')->middleware('auth');
Route::post('/updateAbsenM', [AbsenController::class, 'updateAbsenM'])->name('updateAbsenM')->middleware('auth');
Route::post('/deleteAbsenM', [AbsenController::class, 'deleteAbsenM'])->name('deleteAbsenM')->middleware('auth');
Route::get('/downloadAbsen', [AbsenController::class, 'downloadAbsen'])->name('downloadAbsen')->middleware('auth');

Route::post('/addAbsen', [AbsenController::class, 'addAbsen'])->name('addAbsen')->middleware('auth');
Route::post('/updateAbsen', [AbsenController::class, 'updateAbsen'])->name('updateAbsen')->middleware('auth');
Route::post('/deleteAbsen', [AbsenController::class, 'deleteAbsen'])->name('deleteAbsen')->middleware('auth');
Route::get('/tabel',[TabelController::class,'index'])->name('tabel')->middleware('auth');
Route::get('/tabelKoki',[TabelController::class,'tabelKoki'])->name('tabelKoki')->middleware('auth');

Route::get('/welcome',[WelcomeController::class,'welcome'])->name('welcome')->middleware('auth');

// menu orderan --------------------------------------------------------------------------
Route::get('/orderan', [OrderanController::class, 'index'])->name('orderan');

Route::get('/dataOrderan', [dataOrderanController::class, 'index'])->name('dataOrderan');
Route::get('/order1', [dataOrderanController::class, 'order1'])->name('order1');
Route::post('/edit_order', [dataOrderanController::class, 'edit_order'])->name('edit_order');
Route::post('/edit_orderAdmin', [dataOrderanController::class, 'edit_orderAdmin'])->name('edit_orderAdmin');
Route::get('/drop', [dataOrderanController::class, 'drop'])->name('drop');
Route::get('/orderan_void', [dataOrderanController::class, 'orderan_void'])->name('orderan_void');

Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
Route::post('/hapus_invoice', [InvoiceController::class, 'hapus_invoice'])->name('hapus_invoice');
Route::get('/invoice1', [InvoiceController::class, 'invoice1'])->name('invoice1');

Route::get('/void', [VoidController::class, 'index'])->name('void');
// ---------------------------------------------------------------------------------------

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/summary', [LaporanController::class, 'summary'])->name('summary');
Route::get('/exportSummary', [LaporanController::class, 'exportSummary'])->name('exportSummary');
Route::get('/item', [LaporanController::class, 'item'])->name('item');
Route::get('/get_telat', [LaporanController::class, 'get_telat'])->name('get_telat');
Route::get('/get_ontime', [LaporanController::class, 'get_ontime'])->name('get_ontime');
Route::get('/export_item', [LaporanController::class, 'export_item'])->name('export_item');

Route::get('/head', [HeadController::class, 'index'])->name('head');

Route::get('/meja', [MejaController::class, 'index'])->name('meja');

// Order -----------------------------------------------
Route::get('/get_order', [OrderController::class, 'get'])->name('get_order');
Route::get('/search', [OrderController::class, 'cari'])->name('search');
Route::get('/item_menu', [OrderController::class, 'get_harga'])->name('item_menu');

Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
Route::get('/keranjang', [OrderController::class, 'keranjang'])->name('keranjang');
Route::get('/destroy_card', [OrderController::class, 'destroy_card'])->name('destroy_card');
Route::get('/delete_order', [OrderController::class, 'delete_order'])->name('delete_order');
Route::get('/min_cart', [OrderController::class, 'min_cart'])->name('min_cart');
Route::get('/plus_cart', [OrderController::class, 'plus_cart'])->name('plus_cart');

Route::get('/get_meja', [OrderController::class, 'get_meja'])->name('get_meja');
Route::get('/payment', [OrderController::class, 'payment'])->name('payment');
Route::post('/create', [OrderController::class, 'create'])->name('create');
// End Order --------------------------------------------------

// Meja ----------------------------------------------
Route::get('/distribusi2', [MejaController::class, 'distribusi'])->name('distribusi2');
Route::get('/waitress', [MejaController::class, 'waitress'])->name('waitress');
Route::post('/pilih_waitress', [MejaController::class, 'pilih_waitress'])->name('pilih_waitress');
Route::post('/un_waitress', [MejaController::class, 'un_waitress'])->name('un_waitress');
Route::post('/meja_selesai', [MejaController::class, 'meja_selesai'])->name('meja_selesai');
Route::get('/get_karyawan', [MejaController::class, 'get_karyawan'])->name('get_karyawan');
Route::get('/get_karyawanExport', [MejaController::class, 'get_karyawanExport'])->name('get_karyawanExport');
Route::get('/get_user', [MejaController::class, 'get_user'])->name('get_user');
Route::get('/save_pesanan', [MejaController::class, 'save_pesanan'])->name('save_pesanan_new');
Route::get('/tambah_pesanan', [MejaController::class, 'tambah_pesanan'])->name('tambah_pesanan');
Route::get('/get_harga', [MejaController::class, 'get_harga'])->name('get_harga');
Route::get('/bill', [MejaController::class, 'bill'])->name('billing');
Route::get('/checker', [MejaController::class, 'checker'])->name('checker');
Route::get('/copy_checker', [MejaController::class, 'copy_checker'])->name('copy_checker');
Route::get('/edit_pembayaran', [MejaController::class, 'edit_pembayaran'])->name('edit_pembayaran');
Route::get('/get_pembayaran', [MejaController::class, 'get_pembayaran'])->name('get_pembayaran');
Route::get('/check_pembayaran', [MejaController::class, 'check_pembayaran'])->name('check_pembayaran');
Route::get('/clear', [MejaController::class, 'clear'])->name('clear');
// End Meja -----------------------------------------------------

Route::get('/check_pembayaran', [OrderanController::class, 'check_pembayaran'])->name('check_pembayaran');
Route::get('/list_orderan', [OrderanController::class, 'list_orderan'])->name('list_orderan');
Route::post('/save_transaksi', [OrderanController::class, 'save_transaksi'])->name('save_transaksi');
Route::get('/get_dp', [OrderanController::class, 'get_dp'])->name('get_dp');
Route::get('/get_discount', [OrderanController::class, 'get_discount'])->name('get_discount');
Route::get('/perhitungan', [OrderanController::class, 'perhitungan'])->name('perhitungan');
Route::get('/voucher', [OrderanController::class, 'voucher'])->name('voucher');
Route::get('/list_order2', [OrderanController::class, 'list_order2'])->name('list_order2');
Route::get('/pembayaran2', [OrderanController::class, 'pembayaran2'])->name('pembayaran2');
Route::get('/print_nota', [OrderanController::class, 'print_nota'])->name('print_nota');
Route::get('/voucher', [OrderanController::class, 'voucher'])->name('voucher');
Route::get('/all_checker', [OrderanController::class, 'all_checker'])->name('all_checker');

// head ---------------------------------------------------------
Route::get('/get_head', [HeadController::class, 'get_head'])->name('get_head');
Route::get('/getSearchHead', [HeadController::class, 'getSearchHead'])->name('getSearchHead');
Route::post('/koki1', [HeadController::class, 'koki1'])->name('koki1');
Route::post('/koki2', [HeadController::class, 'koki2'])->name('koki2');
Route::post('/koki3', [HeadController::class, 'koki3'])->name('koki3');
Route::post('/un_koki1', [HeadController::class, 'un_koki1'])->name('un_koki1');
Route::post('/un_koki2', [HeadController::class, 'un_koki2'])->name('un_koki2');
Route::post('/un_koki3', [HeadController::class, 'un_koki3'])->name('un_koki3');
Route::get('/head_selesei', [HeadController::class, 'head_selesei'])->name('head_selesei');
Route::get('/distribusi3', [HeadController::class, 'distribusi'])->name('distribusi3');
Route::get('/view1jam', [HeadController::class, 'view1jam'])->name('view1jam');
// end head -----------------------------------------------------

// tambah sub navbar menu
Route::get('/tb_denda', [RestoController::class, 'tb_denda'])->name('tb_denda');
Route::get('/tb_tips', [RestoController::class, 'tb_tips'])->name('tb_tips');
Route::get('/tb_kasbon', [RestoController::class, 'tb_kasbon'])->name('tb_kasbon');

Route::get('/tb_jurnal', [APIController::class, 'tb_jurnal'])->name('tb_jurnal');


Route::get('/point_kitchen', [APIController::class, 'tb_jurnal'])->name('point_kitchen');
Route::get('/kom_serve', [APIController::class, 'tb_jurnal'])->name('kom_serve');
Route::get('/setOrang', [APIController::class, 'tb_jurnal'])->name('setOrang');