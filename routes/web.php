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

Route::get('/', function () {
    return view('proposal.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'ProposalsController@index')->name('home'); 
Route::get('/proposal', 'ProposalsController@create'); 
Route::get('/userproposal', 'ProposalsController@view'); 

Route::get('/userproposal/{id}', 'ProposalsController@open'); 
Route::get('/activate/{id}', 'ProposalsController@activate'); 
Route::get('/activate', 'ProposalsController@activatepage'); 

Route::get('/proposal','ProposalsController@create');
Route::post('/proposal','ProposalsController@store');

Route::get('/draft/{id}','ProposalsController@savedraft');

Route::get('/submitproposal/{id}','ProposalsController@finalsubmit')->name('finalsumit');

Route::get('/deletedraft/{id}','ProposalsController@destroy');
Route::post('/submitproposal/{id}','ProposalsController@finalsubmit')->name('finalsumit');
Route::get('/submitproposal','ProposalsController@update');



Route::get('/admin/{id}','AdminController@show');

Route::get('/admin/{id}/stage1','AdminController@stage1');
Route::get('/admin/{id}/stage2','AdminController@stage2');
Route::get('/admin/{id}/reject','AdminController@reject');
Route::get('/admin/{id}/accepted','AdminController@accept');

Route::get('/rejected','AdminController@rejected');
Route::get('/stageone','AdminController@stageone');
Route::get('/stagetwo','AdminController@stagetwo');
Route::get('/accepted','AdminController@accepted');
Route::get('/newproposals','AdminController@newproposals');
Route::get('/back','AdminController@goback');

Route::get('/rejecteduser','ProposalsController@rejected');
Route::get('/stageoneuser','ProposalsController@stageoneuser');
Route::get('/stagetwouser','ProposalsController@stagetwouser');
Route::get('/sentproposals','ProposalsController@view');
Route::get('/accepteduser','ProposalsController@accepteduser');
Route::get('/userback','ProposalsController@userback');
Route::get('/userdrafts','ProposalsController@userdrafts');
Route::post('/submitchange/{id}','ProposalsController@update');


