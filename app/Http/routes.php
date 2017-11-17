<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('members', 'MemberController');

Route::resource('doctors', 'DoctorController');

Route::get('searchDoctor', 'SearchDoctorController@index');
Route::get('echanneling', 'EchannelingController@index');
Route::get('medicalCheckup', 'MedicalCheckupController@index');
Route::get('organDonation', 'OrganDonationController@index');
Route::get('admin_panel', 'AdminController@index');
Route::resource('echanneling', 'EchannelingController');

Route::get('laboratary_details', 'LaborataryDetailsController@index');
Route::get('checkup_shedules/paymentDetails', 'CheckupSheduleController@paymentDetails');
Route::get('checkup_shedules/viewLabDetails', 'CheckupSheduleController@viewLabDetails');
Route::resource('checkup_shedules', 'CheckupSheduleController');
Route::GET('checkup_shedules/timeList/{id}', ['uses' => 'CheckupSheduleController@getAllTimeList', 'as' => 'checkup_shedules.getAll_list']);

Route::GET('checkup_reports/fasting_blood_report/{fsId}', ['uses' => 'FastingBloodCountController@getFastingBloodReport', 'as' => 'checkup_reports.getfastingreport']);
Route::GET('checkup_reports/full_blood_report/{id}', ['uses' => 'FullBloodCountController@getFullBloodReport', 'as' => 'checkup_reports.getreport']);
Route::GET('checkup_payments/report/{pid}', ['uses' => 'CheckupPaymentController@getPaymentInvoice', 'as' => 'checkup_payments.getinvoice']);

Route::resource('checkup_payments', 'CheckupPaymentController');
Route::get('patient_schedules/viewReports', 'PatientScheduleController@viewReports');
Route::get('patient_schedules/viewCompletedCheckups', 'PatientScheduleController@viewCompletedCheckups');
Route::get('patient_schedules/viewScheduledCheckups', 'PatientScheduleController@viewScheduledCheckups');
Route::resource('patient_shedules', 'PatientScheduleController');
Route::resource('full_blood_counts', 'FullBloodCountController');
Route::resource('fasting_blood_counts', 'FastingBloodCountController');
Route::GET('patient_shedules/list/{id}/{date}', ['uses' => 'PatientScheduleController@getTimeList', 'as' => 'patient_shedules.get_list']);
//Route::GET('patient_shedules/{pid}/edit/list/{id}/{date}', ['uses' => 'PatientScheduleController@getTimeList', 'as' => 'patient_shedules.get_list']);

Route::resource('feedback', 'FeedbackController');
Route::get('EC_Schedule/list_schedules', 'EC_ScheduleController@list_schedules');
Route::resource('EC_Schedule', 'EC_ScheduleController');
Route::get('/e_schedules/api', function () {
	$events = DB::table('e_schedules')->select('schedule_id', 'doc_id', 'room', 'shift_start as start', 'shift_end as end','max_bookings')->get();
	foreach($events as $event)
	{

		$event->url = url('EC_Schedule/' . $event->schedule_id);
	}
	return $events;
});


Route::resource('EC_DOC_RATES', 'EC_DocRateController');



Route::get('ServicesPages/angyography', 'ServicesPageController@angyography');
Route::get('ServicesPages/CTscanning', 'ServicesPageController@CTscanning');
Route::get('ServicesPages/PreventiveHealthCheck', 'ServicesPageController@PreventingChecks');
Route::get('ServicesPages/AboutLaborataries', 'ServicesPageController@AboutLaborataries');


Route::resource('doctorvisits', 'DoctorVisitController');
//Route::POST('doctorvisits/create/{id}', ['uses' => 'DoctorVisitController@storeDetails', 'as' => 'doctorvisits.storeDetails']);
Route::resource('recommendcheckups', 'RecommendCheckupController');
Route::resource('diagnosisupdates', 'DiagnosisUpdateController');
Route::resource('patientlist', 'PatientListController');

//Route::GET('patientlists/viewVisit/{id}','PatientListController@viewVisit');
Route::GET('patientlist/viewVisit/{id}', ['uses' => 'PatientListController@viewVisit', 'as' => 'patientlist.viewVisit']);
Route::GET('patientlist/viewAllVisits/{id}', ['uses' => 'PatientListController@viewAllVisits', 'as' => 'patientlist.viewAllVisits']);
Route::GET('patientlist/diagnosisCard/{id}', ['uses' => 'PatientListController@printCard', 'as' => 'patientlist.diagnosisCard']);
Route::resource('medicinecarts', 'MedicineCartController');
//Route::get('medicinecarts', 'MedicineCartController@EmptyCart');
Route::POST('medicinecarts/create', ['uses' => 'MedicineCartController@storeDetails', 'as' => 'medicinecarts.storeDetails']);
Route::GET('medicinecarts/pharmacyInvoice/{id}', ['uses' => 'MedicineCartController@printInvoice', 'as' => 'medicinecarts.pharmacyInvoice']);
Route::resource('medicines', 'MedicineController');
Route::GET('doctorvisits/prescription/{id}', ['uses' => 'DoctorVisitController@printPres', 'as' => 'doctorvisits.prescription']);




Route::get('echanneling', array('uses' => 'EchannelingController@search_doctors'));
Route::get('echanneling/showMoreDoctorSchedules/{id?}/{date?}', 'EchannelingController@showMoreDoctorSchedules');
Route::resource('echanneling', 'EchannelingController');
Route::resource('channeling_payments', 'ChannelingPaymentController');
Route::resource('patients', 'PatientController');
Route::resource('booking', 'BookingController');
Route::get('payment-status',array('as'=>'payment.status','uses'=>'ChannelingPaymentController@paymentInfo'));
Route::get('payment',array('as'=>'payment','uses'=>'ChannelingPaymentController@payment'));
Route::get('payment-cancel', function () {
	return 'Payment has been canceled';
});
Route::resource('channeling_payments', 'ChannelingPaymentController');


//lasanthi's routes
Route::resource('organs','OrganController');

Route::get('organvisits/bloodchart','OrganvisitController@bloodchart');
Route::get('organvisits/add','OrganvisitController@add');
Route::get('organvisits/visitchart','OrganvisitController@visitchart');
Route::resource('organvisits/hospitals','OrganvisitController@hospitals');
Route::resource('organvisits','OrganvisitController');


Route::get('orgontypevisits/organchart','OrgontypevisitController@organchart');
Route::get('orgontypevisits/visitchart','OrgontypevisitController@visitchart');
//Route::get('orgontypevisits/hospitals','OrgontypevisitController@hospitals');
Route::resource('orgontypevisits','OrgontypevisitController');






