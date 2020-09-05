<?php

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

 //********WelcomeController*********
  Route::get('/','WelcomeController@index')->name('welcome.show');

 //********DashboardController*********
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard.show');

   //********CheckController*********
  Route::get('/check','CheckController@index')->name('check.show');
  Route::post('/check','CheckController@validator')->name('checkPost.show');

 //********ListStudentsController*********
  Route::post('/listeE', 'ListeStudentsController@index')->name('liste.show');
  Route::post('/cours','ListeCoursController@index');
  Route::get('/cours/ajouter_cours','ListeCoursController@ajout');
  Route::post('/import', 'ListeStudentsController@import')->name('import.show');

 //********DashboardAdminController*********
  Route::get('/dashboard/adminProfesseur', 'DashboardAdminController@index');
  Route::get('/dashboard/adminEtudiant', 'DashboardAdminController@show');
  Route::post('/dashboard/adminEtudiant', 'DashboardAdminController@show');
  Route::get('/dashboard/ajouter_prof', 'DashboardAdminController@showAjoutProf');
  Route::post('/dashboard/ajouter_prof', 'DashboardAdminController@ajoutProf');
  Route::get('/dashboard/ajouter_etud', 'DashboardAdminController@showAjoutEtud');
  Route::post('/dashboard/ajouter_etud', 'DashboardAdminController@ajoutEtud');

  //********EditController*********
  Route::get('/dashboard/showAdminEditProf/{id}', 'EditController@showEditProf');
  Route::post('/dashboard/adminEditProf', 'EditController@editProf');
  Route::get('/dashboard/showAdminEditEtud/{id}', 'EditController@showEditEtud');
  Route::post('/dashboard/adminEditEtud', 'EditController@editEtud');
  
  //********ProfileController*********
  Route::get('/dashboard/profile-professeur', 'ProfileController@prof');
  Route::get('/dashboard/profile-admin', 'ProfileController@admin');
  Route::get('/dashboard/profile-etudiant', 'ProfileController@etudiant');
  Route::get('/register/edit','ProfileController@update');
  Route::get('/register/editEtudiant','ProfileController@update2');
  Route::get('/register/editAdmin','ProfileController@updateAdmin');
  Route::post('/dashboard/editProfil', 'ProfileController@edit');
  Route::post('/dashboard/editProfil2', 'ProfileController@edit2');
  Route::post('/dashboard/editProfilAdmin', 'ProfileController@editAdmin');
  
  //********SettingController*********
  Route::get('/dashboard/settings', 'SettingController@setting');
  Route::get('/professeur-emplois/{semestre}/{niveau}', 'SettingController@profEmp');
  Route::get('/etudiant-emplois/{semestre}/{niveau}', 'SettingController@etudEmp');
  Route::post('/dashboard/settingsChoose', 'SettingController@choose');
  Route::post('/dashboard/settingsAdd', 'SettingController@add');
  Route::post('/dashboard/settingsAnnee', 'SettingController@annee');
  Route::post('/dashboard/settingsEmplois', 'SettingController@emplois');
  
  //********ListCoursController*********
  Route::get('/cours', 'ListeCoursController@index'); 
  Route::get('/etudiant-listeCours/{libelle}', 'ListeCoursController@showToEtud'); 
  Route::get('/cours2', 'ListeCoursController@index2'); 
  Route::get('/cours-edit/{nomCours}', 'ListeCoursController@showedit'); 
  Route::get('/cours-delete/{id}', 'ListeCoursController@delete'); 
  Route::post('/cours/edit', 'ListeCoursController@edit'); 
  Route::post('/add', 'ListeCoursController@add');
  
  //********AffectDeleteController*********
  Route::get('/professeur-delete/{id}', 'AffectDeleteController@deleteProf'); 
  Route::get('/etudiant-delete/{id}', 'AffectDeleteController@deleteEtud');
  Route::get('/professeur-affecter/{id}', 'AffectDeleteController@affecter1');
  Route::post('/professeur-affecter1', 'AffectDeleteController@affecter2');
  Route::post('/professeur-affecter2', 'AffectDeleteController@affecter3');
  
   //********ArchiveController********* 
  Route::get('/etudiant-restore/{id}', 'ArchiveController@showrestoreEtud'); 
  Route::post('/etudiant-restore', 'ArchiveController@restoreEtud'); 
  Route::get('/professeur-restore/{id}', 'ArchiveController@restoreProf'); 
  Route::get('/dashboard/archive', 'ArchiveController@archive');

  //********NotesController*********
Route::get('/voir_notes/{libelle}/{idNiveau}/{idSemestre}','NotesController@export'  );
Route::get('/notes','NotesController@index'  );
Route::get('/voir_etudiant/{libelle}','NotesController@voir_etudiant'  );
Route::get('/ajouter_notes/{libelle}/{idNiveau}/{idSemestre}','NotesController@ajouter_notes'  );
Route::post('/ajouter_notes2/{libelle}/{idSemestre}/{idNiveau}','NotesController@ajouter_notes2'  );


Auth::routes();

