<?php

/*
                                                                                    ,   ,                                
                                                                                    $,  $,     ,                         
                                                                                    "ss.$ss. .s'                         
                                                                            ,     .ss$$$$$$$$$$s,                        
                                                                            $. s$$$$$$$$$$$$$$`$$Ss                      
                                                                            "$$$$$$$$$$$$$$$$$$o$$$       ,              
                                                                           s$$$$$$$$$$$$$$$$$$$$$$$$s,  ,s               
                                                                          s$$$$$$$$$"$$$$$$""""$$$$$$"$$$$$,             
                                                                          s$$$$$$$$$$s""$$$$ssssss"$$$$$$$$"             
                                                                         s$$$$$$$$$$'         `"""ss"$"$s""              
                                                                         s$$$$$$$$$$,              `"""""$  .s$$s        
                                                                         s$$$$$$$$$$$$s,...               `s$$'  `       
                                                                     `ssss$$$$$$$$$$$$$$$$$$$$####s.     .$$"$.   , s-   
                                                                       `""""$$$$$$$$$$$$$$$$$$$$#####$$$$$$"     $.$'    
                                             Posable artist:                 "$$$$$$$$$$$$$$$$$$$$$####s""     .$$$|     
                                              -Michael_Patrick_Effendy         "$$$$$$$$$$$$$$$$$$$$$$$$##s    .$$" $    
                                                                               $$""$$$$$$$$$$$$$$$$$$$$$$$$$$$$$"   `    
                                                                              $$"  "$"$$$$$$$$$$$$$$$$$$$$S""""'         
                                                                         ,   ,"     '  $$$$$$$$$$$$$$$$####s             
                                                                         $.          .s$$$$$$$$$$$$$$$$$####"            
                                                             ,           "$s.   ..ssS$$$$$$$$$$$$$$$$$$$####"            
                                                             $           .$$$S$$$$$$$$$$$$$$$$$$$$$$$$#####"             
                                                             Ss     ..sS$$$$$$$$$$$$$$$$$$$$$$$$$$$######""              
                                                              "$$sS$$$$$$$$$$$$$$$$$$$$$$$$$$$########"                  
                                                       ,      s$$$$$$$$$$$$$$$$$$$$$$$$#########""'                      
                                                       $    s$$$$$$$$$$$$$$$$$$$$$#######""'      s'         ,           
                                                       $$..$$$$$$$$$$$$$$$$$$######"'       ....,$$....    ,$            
                                                        "$$$$$$$$$$$$$$$######"' ,     .sS$$$$$$$$$$$$$$$$s$$            
                                                          $$$$$$$$$$$$#####"     $, .s$$$$$$$$$$$$$$$$$$$$$$$$s.         
                                               )          $$$$$$$$$$$#####'      `$$$$$$$$$###########$$$$$$$$$$$.       
                                              ((          $$$$$$$$$$$#####       $$$$$$$$###"       "####$$$$$$$$$$      
                                              ) \         $$$$$$$$$$$$####.     $$$$$$###"             "###$$$$$$$$$   s'
                                             (   )        $$$$$$$$$$$$$####.   $$$$$###"                ####$$$$$$$$s$$' 
                                             )  ( (       $$"$$$$$$$$$$$#####.$$$$$###'                .###$$$$$$$$$$"   
                                             (  )  )   _,$"   $$$$$$$$$$$$######.$$##'                .###$$$$$$$$$$     
                                             ) (  ( \.         "$$$$$$$$$$$$$#######,,,.          ..####$$$$$$$$$$$"     
                                            (   )$ )  )        ,$$$$$$$$$$$$$$$$$$####################$$$$$$$$$$$"       
                                            (   ($$  ( \     _sS"  `"$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$S$$,       
                                             )  )$$$s ) )  .      .   `$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$"'  `$$      
                                              (   $$$Ss/  .$,    .$,,s$$$$$$##S$$$$$$$$$$$$$$$$$$$$$$$$S""        '      
                                                \)_$$$$$$$$$$$$$$$$$$$$$$$##"  $$        `$$.        `$$.                
                                                    `"S$$$$$$$$$$$$$$$$$#"      $          `$          `$                
                                                        `"""""""""""""'         '           '           '     
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengeluaran;

Route::get('/', function () {
    return view('welcome');
});

Route::view('home','home');
Route::view('index', 'index');
Route::view('layout', 'layout');
Route::view('rempah', 'daftar_rempah');
Route::view('pemesan', 'pemesan');
Route::view('transaksi', 'transaksi');
Route::view('laporan_cafe', 'laporan_cafe');
Route::view('laporan_po_harian', 'laporan_po_harian');
Route::view('cafes', 'cafes');
Route::view('daftar_cafe', 'daftar_cafe');
Route::view('riwayat_cafe', 'riwayat_cafe');
Route::view('riwayat_po','riwayat_po');
Route::view('laporan_cafe_bulanan','laporan_cafe_bulanan');
Route::view('laporan_po_bulanan','laporan_po_bulanan');

Route::post('rempah', [Pengeluaran::class, 'menu']);
Route::get('rempah', [Pengeluaran::class, 'tampilMenu']);

Route::get('edit-menu/{id}', [Pengeluaran::class, 'edit']); #EDIT MENU
Route::put('update-menu', [Pengeluaran::class, 'update_menu']); #UPDATE MENU
Route::get('delete/{id}', [Pengeluaran::class, 'kill']); #HAPUS MENU

Route::post('daftar_cafe', [Pengeluaran::class, 'cafe']);
Route::get('daftar_cafe', [Pengeluaran::class, 'tampilCafe']);

Route::get('edit-cafe/{id}', [Pengeluaran::class, 'edit_cafe']); #EDIT MENU
Route::put('update-menu-cafe', [Pengeluaran::class, 'update_menu_cafe']); #UPDATE MENU
Route::get('delete-cafe/{id}', [Pengeluaran::class, 'kill_cafe']); #HAPUS MENU

Route::get('transaksi', [Pengeluaran::class, 'tampilRempah']);
Route::post('transaksi', [Pengeluaran::class, 'dataRempah']);

Route::get('cafes', [Pengeluaran::class, 'tampilKafe']);
Route::post('cafes', [Pengeluaran::class, 'dataKafe']);

#RIWAYAT CAFE
Route::get('riwayat_cafe', [Pengeluaran::class, 'search']);
Route::get('detail/{id}', [Pengeluaran::class, 'detail']);
Route::get('edit-riwayat/{id}',[Pengeluaran::class, 'edit_riwayat_cafe']);
Route::put('update_c',[Pengeluaran::class,'update_cafe_riwayat']);
Route::get('hapus_riwayat/{id}', [Pengeluaran::class, 'kill_riwayat']);


#RIWAYAT PO
Route::get('riwayat_po', [Pengeluaran::class, 'search_po']);
Route::get('detailPo/{id}', [Pengeluaran::class, 'detailPo']);
Route::get('edit-riwayat-po/{id}',[Pengeluaran::class,'edit_riwayat_po']);
Route::put('update_p',[Pengeluaran::class,'update_po_riwayat']);
Route::get('hapus_riwayat_po/{id}',[Pengeluaran::class, 'kill_riwayat_po']);

#LAPORAN CAFE
Route::get('laporan_cafe_bulanan',[Pengeluaran::class, 'tampilLap']);
Route::get('/laporan_cafe_bulanan/search', [Pengeluaran::class, 'search_laporan']);

#LAPORAN PO
Route::get('laporan_po_bulanan',[Pengeluaran::class, 'tampilLapPo']);
Route::get('/laporan_po_bulanan/search_po', [Pengeluaran::class, 'search_laporan_po']);

#HOME
Route::get('home',[Pengeluaran::class,'home']);
