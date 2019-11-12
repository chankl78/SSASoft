<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Login
Route::get('/', array('before' => 'installadmin', 'uses' => 'LeadersPortalLoginController@getIndex'));
Route::get('/Login', array('before' => 'installadmin', 'uses' => 'LoginController@getIndex'));
Route::get('/getLogout', 'LoginController@getLogout');
Route::get('/public/getLogout', 'LoginController@getLogout');
Route::controller('Login', 'LoginController');

// Security Login
Route::get('/securitylogin', array('before' => 'installadmin', 'uses' => 'SecurityLoginController@getIndex'));

// Retrieve Password
Route::controller('password', 'RemindersController');

// Install Admin
Route::get('/installadmin', 'InstallAdminController@getIndex');
Route::post('/installadmin', 'InstallAdminController@postSetup');

// Dashboard
Route::get('/Dashboard', array('before' => 'auth', 'uses' => 'DashboardController@getIndex'));
Route::get('/Dashboard/userlogs', 'DashboardController@userlogs');

// User Profile
Route::get('/UserProfile', array('before' => 'auth', 'uses' => 'UserController@getIndex'));
Route::post('/UserProfile', 'UserController@postUser');
Route::post('/UserProfile/postPassword', 'UserController@postPassword');
Route::get('/UserProfile/getUserLogs', 'UserController@getUserLogs');

// Access Rights
Route::get('/AccessRights', array('before' => 'auth', 'uses' => 'AccessRightsController@getIndex'));
Route::get('/AccessRights/User/{id}', array('before' => 'auth', 'uses' => 'AccessRightsController@getUser'));
Route::get('/AccessRights/User/getUserAccessRightsListing/{id}', 'AccessRightsController@getUserAccessRightsListing');
Route::post('/AccessRights/User/putUserACDetail/{id}', 'AccessRightsController@putUserACDetail');
Route::post('/AccessRights/User/ResetPassword/{id}', 'AccessRightsController@putUserResetPassword');
Route::post('/AccessRights/User/postAccessRightsAdd', 'AccessRightsController@postAccessRightsAdd');
Route::post('/AccessRights/User/postAccessRightsUpdate', 'AccessRightsController@postAccessRightsUpdate');
Route::post('/AccessRights/User/deleteRights/{id}', 'AccessRightsController@deleteAccessRights');
Route::get('/AccessRights/getUsersListing', 'AccessRightsController@getUsersListing');
Route::post('/AccessRights/User/deleteUser/{id}', 'AccessRightsController@deleteUser');

Route::get('/AccessRights/Roles', array('before' => 'auth', 'uses' => 'AccessRightsController@getRolesIndex'));
Route::post('/AccessRights/postRoles', 'AccessRightsController@postRole');
Route::post('/AccessRights/putRoles', 'AccessRightsController@putRole');
Route::post('/AccessRights/deleteRoles/{id}', 'AccessRightsController@deleteRole');
Route::get('/AccessRights/getRolesListing', 'AccessRightsController@getRolesListing');

Route::get('/AccessRights/AccessTypes', array('before' => 'auth', 'uses' => 'AccessRightsController@getAccessTypesIndex'));
Route::get('/AccessRights/getAccessTypesListing', 'AccessRightsController@getAccessTypesListing');
Route::post('/AccessRights/postAccessType', 'AccessRightsController@postAccessType');
Route::post('/AccessRights/deleteAccessType/{id}', 'AccessRightsController@deleteAccessType');
Route::post('/AccessRights/putAccessType/{id}', 'AccessRightsController@putAccessType');

Route::get('/AccessRights/Status', array('before' => 'auth', 'uses' => 'AccessRightsController@getStatusIndex'));
Route::get('/AccessRights/getStatusListing', 'AccessRightsController@getStatusListing');
Route::post('/AccessRights/postStatus', 'AccessRightsController@postStatus');
Route::post('/AccessRights/deleteStatus/{id}', 'AccessRightsController@deleteStatus');
Route::post('/AccessRights/putStatus/{id}', 'AccessRightsController@putStatus');

// Common Setup
Route::get('/Common/StaffListing', array('before' => 'auth', 'uses' => 'StaffController@getIndex'));
Route::get('/Common/getStaffListing', 'StaffController@getStaffListing');
Route::post('/Common/postStaff', 'StaffController@postStaff');
Route::post('/Common/deleteStaff/{id}', 'StaffController@deleteStaff');
Route::post('/Common/putStaff', 'StaffController@putStaff');

// Vehicle
Route::get('/Vehicle/VehicleListing', array('before' => 'auth', 'uses' => 'VehicleListingController@getIndex'));
Route::get('/Vehicle/getListing', 'VehicleListingController@getListing');
Route::post('/Vehicle/postVehicle', 'VehicleListingController@postVehicle');
Route::post('/Vehicle/putVehicle/{id}', 'VehicleListingController@putVehicle');
Route::post('/Vehicle/deleteVehicle/{id}', 'VehicleListingController@deleteVehicle');

// Vehicle Booking Listing
Route::get('/Vehicle/VehicleBookingListing', array('before' => 'auth', 'uses' => 'VehicleBookingListingController@getIndex'));
Route::get('/Vehicle/VehicleBookingListing/getListing', 'VehicleBookingListingController@getListing');
Route::post('/Vehicle/VehicleBookingListing/postModule', 'VehicleBookingListingController@postModule');
Route::post('/Vehicle/VehicleBookingListing/putModule/{id}', 'VehicleBookingListingController@putModule');
Route::post('/Vehicle/VehicleBookingListing/deleteModule/{id}', 'VehicleBookingListingController@deleteModule');

// Vehicle Booking Status
Route::get('/Vehicle/VehicleBookingStatus', array('before' => 'auth', 'uses' => 'VehicleBookingStatusController@getIndex'));
Route::get('/Vehicle/zBookingStatus/getListing', 'VehicleBookingStatusController@getListing');
Route::post('/Vehicle/zBookingStatus/postStatus', 'VehicleBookingStatusController@postStatus');
Route::post('/Vehicle/zBookingStatus/putStatus/{id}', 'VehicleBookingStatusController@putStatus');
Route::post('/Vehicle/zBookingStatus/deleteStatus/{id}', 'VehicleBookingStatusController@deleteStatus');

Route::get('/VehicleBooking', array('before' => 'auth', 'uses' => 'VehicleController@getIndex'));
Route::get('/Vehicle/CashCard', array('before' => 'auth', 'uses' => 'VehicleController@getCashCardIndex'));
Route::get('/Vehicle/getCa', 'VehicleController@getCashCardListing');
Route::get('/Vehicle/BookingStatus', array('before' => 'auth', 'uses' => 'VehicleController@getBookingStatusIndex'));
Route::get('/Vehicle/getBookingStatusListing', 'VehicleController@getBookingStatusListing');
Route::get('/Vehicle/MaintenanceType', array('before' => 'auth', 'uses' => 'VehicleController@getMaintenanceTypeIndex'));
Route::get('/Vehicle/getMaintenanceTypeListing', 'VehicleController@getMaintenanceTypeListing');
Route::get('/Vehicle/Drivers', array('before' => 'auth', 'uses' => 'VehicleController@getDriversIndex'));
Route::get('/Vehicle/getDriversListing', 'VehicleController@getDriversListing');
Route::get('/Vehicle/Vehicle', array('before' => 'auth', 'uses' => 'VehicleController@getVehiclesIndex'));
Route::get('/Vehicle/getVehiclesListing', 'VehicleController@getVehiclesListing');

// Attendance
Route::get('/Attendance', array('before' => 'auth', 'uses' => 'AttendanceController@getIndex'));
Route::get('/Attendance/getAttendanceListing', 'AttendanceController@getAttendanceListing');
Route::get('/Attendance/getDiscussionMeetingNotSubmitted', 'AttendanceController@getDiscussionMeetingNotSubmitted');

Route::post('/Attendance/deleteAttendance/{id}', 'AttendanceController@deleteAttendance');
Route::post('/Attendance/postAttendanceACCheck/{id}', 'AttendanceController@postAttendanceACCheck');
Route::post('/Attendance/postCreateDMAttendance', 'AttendanceController@postCreateDMAttendance');
Route::post('/Attendance/postCreateDMLevelDivisionAttendance', 'AttendanceController@postCreateDMLevelDivisionAttendance');
Route::post('/Attendance/postCreateEventTrainingAttendance', 'AttendanceController@postCreateEventTrainingAttendance');
Route::post('/Attendance/postCreateGroupCodePrefixTrainingAttendance', 'AttendanceController@postCreateGroupCodePrefixTrainingAttendance');
Route::post('/Attendance/postClosedDMAttendance', 'AttendanceController@postClosedDMAttendance');
Route::post('/Attendance/postDMStatsUpdate', 'AttendanceController@postDMStatsUpdate');

// Attendance Detail
Route::get('/Attendance/Detail/{id}', array('before' => 'auth', 'uses' => 'AttendanceDetailController@getIndex'));
Route::get('/Attendance/Detail/getAttendeesListing/{id}', 'AttendanceDetailController@getAttendeesListing');
Route::get('/Attendance/Detail/getrhqstatsListing/{id}', 'AttendanceDetailController@getrhqstatsListing');
Route::post('/Attendance/Detail/putAttendance/{id}', 'AttendanceDetailController@putAttendance');
Route::post('/Attendance/Detail/putAttendance1/{id}', 'AttendanceDetailController@putAttendance1');
Route::post('/Attendance/Detail/putAttendance2/{id}', 'AttendanceDetailController@putAttendance2');
Route::post('/Attendance/Detail/putAttendancesr/{id}', 'AttendanceDetailController@putAttendancesr');
Route::post('/Attendance/Detail/putAttendancehv/{id}', 'AttendanceDetailController@putAttendancehv');
Route::post('/Attendance/Detail/postNricSearch/{id}', 'AttendanceDetailController@postNricSearch');
Route::post('/Attendance/Detail/postNricSearchExpress/{id}', 'AttendanceDetailController@postNricSearchExpress');
Route::post('/Attendance/Detail/postMassForwardtoEvent/{id}', 'AttendanceDetailController@postMassForwardtoEvent');
Route::post('/Attendance/Detail/postDMMassInsertByDistrict/{id}', 'AttendanceDetailController@postDMMassInsertByDistrict');
Route::post('/Attendance/Detail/postAddMember/{id}', 'AttendanceDetailController@postAddMember');
Route::post('/Attendance/Detail/postAddNewFriend/{id}', 'AttendanceDetailController@postAddNewFriend');
Route::post('/Attendance/Detail/deleteAllAttendee/{id}', 'AttendanceDetailController@deleteAllAttendee');
Route::post('/Attendance/Detail/deleteAttendee/{id}', 'AttendanceDetailController@deleteAttendee');
Route::post('/Attendance/Detail/putAttendedAttendee/{id}', 'AttendanceDetailController@putAttendedAttendee');
Route::post('/Attendance/Detail/putAbsentAttendee/{id}', 'AttendanceDetailController@putAbsentAttendee');
Route::post('/Attendance/Detail/putEditMember/{id}', 'AttendanceDetailController@putEditMember');
Route::get('/Attendance/Detail/getZone/{id}','AttendanceDetailController@getZone');
Route::get('/Attendance/Detail/getChapter/{id}','AttendanceDetailController@getChapter');

// Event Registration By Members
Route::get('/eventregistration', 'EventMemRegistrationController@getIndex');
Route::post('/eventregistration/postNricSearch/{id}', 'EventMemRegistrationController@postNricSearch');
Route::post('/eventregistration/postNricSearchExpress/{id}', 'EventMemRegistrationController@postNricSearchExpress');
Route::post('/eventregistration/postSearchByNric', 'EventMemRegistrationController@postSearchByNric');
Route::post('/eventregistration/postAddMember/{id}', 'EventMemRegistrationController@postAddMember');
Route::post('/eventregistration/postAddMemberSD/{id}', 'EventMemRegistrationController@postAddMemberSD');
Route::post('/eventregistration/postRegisterForEvent', 'EventMemRegistrationController@postRegisterForEvent');
Route::get('/friendshipmeeting', 'EventMemRegistrationController@getFriendshipMeetingIndex');
Route::get('/studentdivisioneventregistration', 'EventMemRegistrationController@getStudentDivisionIndex');
Route::get('/concertregistration', 'EventMemRegistrationController@getConcertIndex');

// Event
Route::get('/Event', array('before' => 'auth', 'uses' => 'EventController@getIndex'));
Route::get('/Event/getEventListing', 'EventController@getEventListing');
Route::post('/Event/postEvent', 'EventController@postEvent');
Route::post('/Event/postEventACCheck/{id}', 'EventController@postEventACCheck');
Route::post('/Event/deleteEvent/{id}', 'EventController@deleteEvent');
Route::post('/Event/Detail/putEvent/{id}', 'EventController@putEvent');

// Event Detail
Route::get('/Event/Detail/{id}', array('before' => 'auth', 'uses' => 'EventDetailController@getIndex'));
Route::get('/Event/Detail/getParticipantListing/{id}', 'EventDetailController@getParticipantListing');
Route::get('/Event/Detail/getSecurityPassListing/{id}', 'EventDetailController@getSecurityPassListing');
Route::post('/Event/Detail/deleteParticipant/{id}', 'EventDetailController@deleteParticipant');
Route::post('/Event/Detail/updateorganisationdetail/{id}', 'EventDetailController@postOrganisationDetail');
Route::post('/Event/Detail/SecurityPass/{id}', 'EventDetailController@postSecurityPass');
Route::post('/Event/Detail/deleteSecurityPass/{id}', 'EventDetailController@deleteSecurityPass');
Route::post('/Event/Detail/deleteAllSecurityPass/{id}', 'EventDetailController@deleteAllSecurityPass');
Route::get('/Event/Detail/getAccessRightsCheck/', 'EventDetailController@AccessRightsCheck');

// Event Card
Route::get('/Event/Detail/getEventCardListing/{id}', 'EventDetailController@getEventCardListing');
Route::post('/Event/Detail/postEventCardAssign/{id}', 'EventDetailController@postEventCardAssign');
Route::post('/Event/Detail/postEventCardByBarcodeReturn/{id}', 'EventDetailController@postEventCardByBarcodeReturn');
Route::post('/Event/Detail/postEventCardReturn/{id}', 'EventDetailController@postEventCardReturn');
Route::post('/Event/Detail/deleteEventCard/{id}', 'EventDetailController@deleteEventCard');
Route::post('/Event/Detail/deleteEventCardWithdrawn/{id}', 'EventDetailController@deleteEventCardWithdrawn');
Route::post('/Event/Detail/deleteEventCardLost/{id}', 'EventDetailController@deleteEventCardLost');
Route::get('/Event/getEventCardNameSearch', 'EventDetailController@getEventCardNameSearch');
Route::post('/Event/Detail/postAddEventCard/{id}', 'EventDetailController@postAddEventCard');

// Event Item
Route::get('/Event/Detail/getEventItemListing/{id}', 'EventDetailController@getEventItemListing');
Route::post('/Event/Detail/postEventItem', 'EventDetailController@postEventItem');
Route::post('/Event/Detail/deleteEventItem/{id}', 'EventDetailController@deleteEventItem');
Route::post('/Event/Detail/putEventItem/{id}', 'EventDetailController@putEventItem');

// Event Show
Route::get('/Event/Detail/getEventShowListing/{id}', 'EventDetailController@getEventShowListing');
Route::post('/Event/Detail/postEventShow', 'EventDetailController@postEventShow');
Route::post('/Event/Detail/deleteEventShow/{id}', 'EventDetailController@deleteEventShow');
Route::post('/Event/Detail/putEventShow/{id}', 'EventDetailController@putEventShow');

// Event Group
Route::get('/Event/Detail/getEventGroupListing/{id}', 'EventDetailController@getEventGroupListing');
Route::post('/Event/Detail/postEventGroup', 'EventDetailController@postEventGroup');
Route::post('/Event/Detail/deleteEventGroup/{id}', 'EventDetailController@deleteEventGroup');
Route::post('/Event/Detail/putEventGroup/{id}', 'EventDetailController@putEventGroup');

// Event Statistic
Route::get('/Event/Detail/getEventProgPerformer/{id}', 'EventDetailController@getEventProgPerformer');
Route::get('/Event/Detail/getEventProgPerformerOnly/{id}', 'EventDetailController@getEventProgPerformerOnly');
Route::get( '/Event/Detail/getEventProgPerformerOnlyAllStatus/{id}', 'EventDetailController@getEventProgPerformerOnlyAllStatus');
Route::get('/Event/Detail/getEventRoleByStatus/{id}', 'EventDetailController@getEventRoleByStatus');

// Event Attendance
Route::post('/Event/Detail/postAccessRightsTrainer/{id}', 'EventDetailController@postAccessRightsTrainer');
Route::get('/Event/Detail/getEventAttendanceListing/{id}', 'EventDetailController@getEventAttendanceListing');
Route::post('/Event/Detail/postEventAttendance/{id}', 'EventDetailController@postEventAttendance');
Route::post('/Event/Detail/deleteEventAttendance/{id}', 'EventDetailController@deleteEventAttendance');

Route::get('/Event/Detail/EventAttendance/{id}', array('before' => 'auth', 'uses' => 'EventAttendanceController@getIndex'));
Route::get('/Event/Detail/EventAttendance/getAttendeesListing/{id}', 'EventAttendanceController@getAttendeesListing');
Route::get('/Event/Detail/EventAttendance/getrhqstatsListing/{id}', 'EventAttendanceController@getrhqstatsListing');
Route::get('/Event/Detail/EventAttendance/getpositionstatsListing/{id}', 'EventAttendanceController@getpositionstatsListing');

Route::get('/Event/Detail/EventAttendance/getParticipantListing/{id}', 'EventAttendanceController@getParticipantListing');
Route::post('/Event/Detail/EventAttendance/postAttendedAttendee/{id}', 'EventAttendanceController@postAttendedAttendee');
Route::post('/Event/Detail/EventAttendance/postAbsentAttendee/{id}', 'EventAttendanceController@postAbsentAttendee');

Route::post('/Event/Detail/EventAttendance/putAttendance/{id}', 'EventAttendanceController@putAttendance');
Route::post('/Event/Detail/EventAttendance/postNricSearch/{id}', 'EventAttendanceController@postNricSearch');
// Route::get('/Event/Detail/EventAttendance/getEventAttendanceNameSearch', 'EventAttendanceController@getEventAttendanceNameSearch');
Route::post('/Event/Detail/EventAttendance/postNricSearchExpress/{id}', 'EventAttendanceController@postNricSearchExpress');
Route::post('/Event/Detail/EventAttendance/postSPSearch/{id}', 'EventAttendanceController@postSPSearch');
Route::post('/Event/Detail/EventAttendance/postAddMember/{id}', 'EventAttendanceController@postAddMember');
Route::post('/Event/Detail/EventAttendance/postAddNewFriend/{id}', 'EventAttendanceController@postAddNewFriend');
Route::post('/Event/Detail/EventAttendance/putEditMember/{id}', 'EventAttendanceController@putEditMember');
Route::post('/Event/Detail/EventAttendance/deleteAttendee/{id}', 'EventAttendanceController@deleteAttendee');
Route::post('/Event/Detail/EventAttendance/putAttendedAttendee/{id}', 'EventAttendanceController@putAttendedAttendee');
Route::post('/Event/Detail/EventAttendance/putAbsentAttendee/{id}', 'EventAttendanceController@putAbsentAttendee');
Route::post('/Event/Detail/EventAttendance/postEventAttended/{id}', 'EventAttendanceController@postEventAttended');
Route::post('/Event/Detail/EventAttendance/postEventAbsent/{id}', 'EventAttendanceController@postEventAbsent');
Route::post('/Event/Detail/EventAttendance/postEventItemAttended/{id}', 'EventAttendanceController@postEventItemAttended');
Route::post('/Event/Detail/EventAttendance/postEventItemAbsent/{id}', 'EventAttendanceController@postEventItemAbsent');
Route::post('/Event/Detail/EventAttendance/deleteAllAttendee/{id}', 'EventAttendanceController@deleteAllAttendee');
Route::post('/Event/Detail/EventAttendance/PrintAttendancePrint/{id}', 'EventAttendanceController@postAttendancePrint');
Route::post('/Event/Detail/EventAttendance/PrintAttendanceStudentDivisionPrint/{id}', 'EventAttendanceController@postStudentDivisionAttendancePrint');
Route::post('/Event/Detail/EventAttendance/PrintAttendanceByPerformerPrint/{id}', 'EventAttendanceController@postAttendanceByPerformerPrint');
Route::get('/Event/Detail/EventAttendance/getZone/{id}','EventAttendanceController@getZone');
Route::get('/Event/Detail/EventAttendance/getChapter/{id}','EventAttendanceController@getChapter');

// Event Add Member
Route::post('/Event/Detail/postNricSearch/{id}', 'EventDetailController@postNricSearch');
Route::get('/Event/getNameSearch', 'EventDetailController@getNameSearch');
// Route::get('/Event/Detail/getEventAttendanceNameSearch', 'EventAttendanceController@getEventAttendanceNameSearch');
Route::post('/Event/Detail/postAddMember/{id}', 'EventDetailController@postAddMember');
Route::post('/Event/Detail/postAllLeaders/{id}', 'EventDetailController@postAllLeaders');
Route::post('/Event/Detail/postYouthLeaders/{id}', 'EventDetailController@postYouthLeaders');
Route::post('/Event/Detail/postYouthSRLeaders/{id}', 'EventDetailController@postYouthSRLeaders');
Route::post('/Event/Detail/postAttendanceAccessRights/{id}', 'EventDetailController@postAttendanceAccessRights');
Route::post('/Event/Detail/postUniqueCode/{id}', 'EventDetailController@postUniqueCode');
Route::post('/Event/Detail/postforwardparticipanttoevent/{id}', 'EventDetailController@postforwardparticipanttoevent');

// Event Print
Route::post('/Event/Detail/PrintEventListingByItemWithContacts/{id}', 'EventDetailController@postEventListingByItemWithContactsPrint');
Route::post('/Event/Detail/PrintEventListingByStatusWithContacts/{id}', 'EventDetailController@postEventListingByStatusWithContactsPrint');
Route::post('/Event/Detail/PrintEventListingByItem/{id}', 'EventDetailController@postEventListingByItemPrint');
Route::post('/Event/Detail/PrintEventListingByGroup/{id}', 'EventDetailController@postEventListingByGroupPrint');
Route::post('/Event/Detail/PrintCostumeListingByGroup/{id}', 'EventDetailController@postCostumeListingByGroupPrint');
Route::post('/Event/Detail/PrintEventListingAttendancePerformerByGroup/{id}', 'EventDetailController@postEventListingByGroupAttendancePerformerPrint');
Route::post('/Event/Detail/PrintEventListingAttendanceByGroup/{id}', 'EventDetailController@postEventListingByGroupAttendancePrint');
Route::post('/Event/Detail/PrintApplicationHC/{id}', 'EventDetailController@getApplicationPrint');
Route::post('/Event/Detail/PrintRoleListing/{id}', 'EventDetailController@getRoleListingPrint');
Route::post('/Event/Detail/PrintRoleListingByDivision/{id}', 'EventDetailController@getRoleListingByDivisionPrint');
Route::post('/Event/Detail/PrintRoleStatictis/{id}', 'EventDetailController@getRoleStatictisPrint');
Route::post('/Event/Detail/PrintRoleContacts/{id}', 'EventDetailController@postContactByDivisionPrint');
Route::post('/Event/Detail/PrintSecurityPasses/{id}', 'EventDetailController@postSecurityPassesByDivisionPrint');
Route::post('/Event/Detail/PrintSecurityPassesIndividual/{id}', 'EventDetailController@postSecurityPassesByIndividualPrint');
Route::post('/Event/Detail/PrintTemporanyPasses/{id}', 'EventDetailController@postTemporanyPassPrint');
Route::post('/Event/Detail/PrintTemporanyPassesNoLogo/{id}', 'EventDetailController@postTemporanyPassNoLogoPrint');
Route::post('/Event/Detail/PrintCostumesSlip/{id}', 'EventDetailController@postCostumesSlipPrint');
Route::post('/Event/Detail/PrintGroups/{id}', 'EventDetailController@postGroupsPrint');
Route::post('/Event/Detail/AcceptedNoGroupCode/{id}', 'EventDetailController@postAcceptedNoGroupCodePrint');
Route::post('/Event/Detail/PrintCostumeListing/{id}', 'EventDetailController@postCostumeListingPrint');
Route::post('/Event/Detail/PrintContactsAll/{id}', 'EventDetailController@postContactByAllPrint');
Route::post('/Event/Detail/PrintContactsAllStudyExam/{id}', 'EventDetailController@postContactByAllStudyExamPrint');
Route::post('/Event/Detail/PrintGohonzonStatistic/{id}', 'EventDetailController@postGohonzonStatisticPrint');
Route::post('/Event/Detail/PrintGohonzonStatisticByDivision/{id}', 'EventDetailController@postGohonzonStatisticByDivisionPrint');
Route::post('/Event/Detail/PrintContactsAllNoSensitive/{id}', 'EventDetailController@postContactByAllPrintNoSensitive');
Route::post('/Event/Detail/postNewFriendContactByDivision/{id}', 'EventDetailController@postNewFriendContactByDivisionPrint');
Route::post('/Event/Detail/PrintEventAttendanceAll/{id}', 'EventDetailController@postEventAttendanceAllPrint');
Route::post('/Event/Detail/PrintEventAttendanceAllByChapter/{id}', 'EventDetailController@postEventAttendanceAllByChapterPrint');

// Event New Friend Subscriber
Route::post('/EventSubscription/EventSTSubscriptionMailer/{id}', 'EventSubscriptionController@postEventSTSubscriptionMailer');
Route::post('/EventSubscription/EventSTSubscriptionMailerExcel', 'EventSubscriptionController@postEventSTSubscriptionMailerExcel');

// Event Participant
Route::get('/Event/Detail/Participant/{id}', array('before' => 'auth', 'uses' => 'EventDetailParticipantController@getIndex'));
Route::post('/Event/Detail/Participant/{id}', 'EventDetailParticipantController@putParticipantDetail');
Route::get('/Event/Detail/Participant/getMemberEventParticipationInfo/{id}', 'EventDetailParticipantController@getMemberEventParticipationInfo');
Route::get('/Event/Detail/Participant/getMemberGroupInfo/{id}', 'EventDetailParticipantController@getMemberGroupInfo');
Route::get('/Event/Detail/Participant/getMemberEventMedicalInfo/{id}', 'EventDetailParticipantController@getMemberEventMedicalInfo');
Route::get('/Event/Detail/Participant/getMemberEventAllergyInfo/{id}', 'EventDetailParticipantController@getMemberEventAllergyInfo');
Route::get('/Event/Detail/Participant/getZone/{id}','EventDetailParticipantController@getZone');
Route::get('/Event/Detail/Participant/getChapter/{id}','EventDetailParticipantController@getChapter');

// Event New Participant
Route::get('/Event/Detail/ParticipantNew/{id}', array('before' => 'auth', 'uses' => 'EventDetailParticipantNewController@getIndex'));
Route::post('/Event/Detail/ParticipantNew/{id}', 'EventDetailParticipantNewController@postParticipantDetail');
Route::get('/Event/Detail/ParticipantNew/getZone/{id}','EventDetailParticipantNewController@getZone');
Route::get('/Event/Detail/ParticipantNew/getChapter/{id}','EventDetailParticipantNewController@getChapter');

// Event Search Members
Route::get('/Event/Registration/Search', array('before' => 'auth', 'uses' => 'EventRegistrationSearchController@getIndex'));
Route::post('/Event/Registration/Search', 'EventRegistrationSearchController@postSearch');
Route::get('/Event/Registration/SearchName', 'EventRegistrationSearchController@getSSAMembersListing');

Route::get('/Event/Registration/Result/{id}', array('before' => 'auth', 'uses' => 'EventRegistrationController@getIndex'));
Route::post('/Event/Registration/Result/RegPrint/{id}', 'EventRegistrationController@PostRegPrint');
Route::post('/Event/Registration/Result/{id}', 'EventRegistrationController@PostRegistration');
Route::get('/Event/Registration/Print/{id}', array('before' => 'auth', 'uses' => 'EventRegistrationController@getRegistrationPrint'));

// Event Subscription
Route::get('/EventSubscription', array('before' => 'auth', 'uses' => 'EventSubscriptionController@getIndex'));
Route::get('/EventSubscription/getListing', 'EventSubscriptionController@getListing');

// Event PreKenshu
Route::get('/EventPreKenshu', array('before' => 'auth', 'uses' => 'EventPreKenshuController@getIndex'));
Route::get('/EventPreKenshu/getListing', 'EventPreKenshuController@getListing');
Route::post('/EventPreKenshu/deleteAttendee/{id}', 'EventPreKenshuController@deleteAttendee');

// Event PreKenshu Eligible
Route::get('/EventPreKenshuEligible', array('before' => 'auth', 'uses' => 'EventPreKenshuEligibleController@getIndex'));
Route::get('/EventPreKenshuEligible/getListing', 'EventPreKenshuEligibleController@getListing');

// Event Study Exam
Route::get('/EventStudyExam', array('before' => 'auth', 'uses' => 'EventStudyExamController@getIndex'));
Route::get( '/EventStudyExam/getListing', 'EventStudyExamController@getListing');

// Event 2019 4 Objectives
Route::get('/Event20194Objects', array('before' => 'auth', 'uses' => 'Event20194ObjectsController@getIndex'));
Route::get('/Event20194Objects/getListing', 'Event20194ObjectsController@getListing');
Route::post('/Event20194Objects/postStatistic', 'Event20194ObjectsController@postStatistic');

// Event zTables
Route::get('/Event/RegistrationStatus', array('before' => 'auth', 'uses' => 'EventzRegistrationStatusController@getIndex'));
Route::get('/Event/getRegistrationStatusListing', 'EventzRegistrationStatusController@getListing');
Route::post('/Event/postRegistrationStatus', 'EventzRegistrationStatusController@postRegistrationStatus');
Route::post('/Event/putRegistrationStatus/{id}', 'EventzRegistrationStatusController@putRegistrationStatus');
Route::post('/Event/deleteRegistrationStatus/{id}', 'EventzRegistrationStatusController@deleteRegistrationStatus');

Route::get('/Event/EventType', array('before' => 'auth', 'uses' => 'EventzEventTypeController@getIndex'));
Route::get('/Event/getEventTypeListing', 'EventzEventTypeController@getListing');
Route::post('/Event/postEventType', 'EventzEventTypeController@postEventType');
Route::post('/Event/putEventType/{id}', 'EventzEventTypeController@putEventType');
Route::post('/Event/deleteEventType/{id}', 'EventzEventTypeController@deleteEventType');

Route::get('/Event/Role', array('before' => 'auth', 'uses' => 'EventzRoleController@getIndex'));
Route::get('/Event/getRoleListing', 'EventzRoleController@getRoleListing');
Route::post('/Event/postRole', 'EventzRoleController@postRole');
Route::post('/Event/putRole', 'EventzRoleController@putRole');
Route::post('/Event/deleteRole/{id}', 'EventzRoleController@deleteRole');

// Group Registration By Members (Soka Volunteer Group only)
Route::get('/svgregistration', 'GroupMemSVGRegistrationController@getIndex');
Route::post('/svgregistration/postNricSearch/{id}', 'GroupMemSVGRegistrationController@postNricSearch');
Route::post('/svgregistration/postAddMember/{id}', 'GroupMemSVGRegistrationController@postAddMember');

// Group
Route::get('/Group', array('before' => 'auth', 'uses' => 'GroupController@getIndex'));
Route::get('/Group/getGroupListing', 'GroupController@getGroupListing');
Route::post('/Group/postGroup', 'GroupController@postGroup');
Route::post('/Group/deleteGroup/{id}', 'GroupController@deleteGroup');
Route::post('/Group/Detail/putGroup/{id}', 'GroupController@putGroup');

// Group Detail
Route::get('/Group/Detail/{id}', array('before' => 'auth', 'uses' => 'GroupDetailController@getIndex'));
Route::get('/Group/Detail/getMemberListing/{id}', 'GroupDetailController@getMemberListing');
Route::get('/Group/Detail/getMemberListingOthers/{id}', 'GroupDetailController@getMemberListingOthers');
Route::post('/Group/Detail/getMemberInfo/{id}', 'GroupDetailController@getMemberInfo');
Route::post('/Group/Detail/putMemberInfo/{id}', 'GroupDetailController@putMemberInfo');
Route::get('/Group/Detail/getMemberGroupInfo/{id}', 'GroupDetailController@getMemberGroupInfo');
Route::post('/Group/Detail/getMemberDetailInfo/{id}', 'GroupDetailController@getMemberDetailInfo');
Route::post('/Group/Detail/getMemberDetailOthersInfo/{id}', 'GroupDetailController@getMemberDetailOthersInfo');
Route::get('/Group/Detail/getMemberEventMedicalInfo/{id}', 'GroupDetailController@getMemberEventMedicalInfo');
Route::get('/Group/Detail/getMemberEventAllergyInfo/{id}', 'GroupDetailController@getMemberEventAllergyInfo');
Route::get('/Group/Detail/getMemberGroupPositionHistory/{id}', 'GroupDetailController@getMemberGroupPositionHistory');
Route::get('/Group/Detail/getGroupEventListing/{id}', 'GroupDetailController@getGroupEventListing');
Route::post('/Group/Detail/postNricSearch/{id}', 'GroupDetailController@postNricSearch');
Route::post('/Group/Detail/postAddNewMember/{id}', 'GroupDetailController@postAddNewMember');
Route::get('/Group/getNameSearch', 'GroupDetailController@getNameSearch');
Route::post('/Group/Detail/postAddMember/{id}', 'GroupDetailController@postAddMember');
Route::post('/Group/Detail/putGroupMember/{id}', 'GroupDetailController@putGroupMember');
Route::post('/Group/Detail/putGroupMemberOthers/{id}', 'GroupDetailController@putGroupMemberOthers');
Route::post('/Group/Detail/deleteGroupMember/{id}', 'GroupDetailController@deleteMember');
Route::post('/Group/Detail/postforwardparticipanttoevent/{id}', 'GroupDetailController@postforwardparticipanttoevent');
Route::post('/Group/Detail/postforwardparticipanttogroup/{id}', 'GroupDetailController@postforwardparticipanttogroup');
Route::post('/Group/Detail/PrintApplicationHC/{id}', 'GroupDetailController@getApplicationPrint');
Route::post('/Group/Detail/PrintGroupMembersRegistrationFormActive/{id}', 'GroupDetailController@postGroupMembersRegistrationFormActivePrint');
Route::post('/Group/Detail/postUniqueCode/{id}', 'GroupDetailController@postUniqueCode');
Route::post('/Group/Detail/postMassImporttoEvent/{id}', 'GroupDetailController@postMassImporttoEvent');

Route::get('/Group/Detail/getMemberPositionListing/{id}', 'GroupDetailController@getMemberPositionListing');

Route::post('/Group/Detail/PrintGroupMemberslisting/{id}', 'GroupDetailController@postGroupMembersListingPrint');
Route::post('/Group/Detail/PrintGroupMembersWithContactslisting/{id}', 'GroupDetailController@postGroupMembersListingWithContactsPrint');
Route::post('/Group/Detail/PrintGroupMembersListingWithSensitiveData/{id}', 'GroupDetailController@postGroupMembersListingWithSensitiveDataPrint');

Route::get('/Group/Detail/getPositionListing/{id}', 'GroupzPositionController@getListing');
Route::post('/Group/Detail/postPosition/{id}', 'GroupzPositionController@postPosition');
Route::post('/Group/Detail/putPosition/{id}', 'GroupzPositionController@putPosition');
Route::post('/Group/Detail/deletePosition/{id}', 'GroupzPositionController@deletePosition');

Route::get('/Group/Detail/getContactGroupListing/{id}', 'GroupzContactGroupController@getListing');
Route::post('/Group/Detail/postContactGroup/{id}', 'GroupzContactGroupController@postContactGroup');
Route::post('/Group/Detail/putContactGroup/{id}', 'GroupzContactGroupController@putContactGroup');
Route::post('/Group/Detail/deleteContactGroup/{id}', 'GroupzContactGroupController@deleteContactGroup');

// Group Attendance and Pre M&D Eligible Listing
Route::get('/Group/Detail/getGroupAttendanceListing/{id}', 'GroupDetailController@getGroupAttendanceListing');
Route::get('/Group/Detail/getGroupPreMADKebshuListing/{id}', 'GroupDetailController@getGroupPreMADKebshuListing');

// Group zTables
Route::get('/Group/GroupType', array('before' => 'auth', 'uses' => 'GroupzGroupTypeController@getIndex'));
Route::get('/Group/getGroupTypeListing', 'GroupzGroupTypeController@getListing');
Route::post('/Group/postGroupType', 'GroupzGroupTypeController@postGroupType');
Route::post('/Group/putGroupType/{id}', 'GroupzGroupTypeController@putGroupType');
Route::post('/Group/deleteGroupType/{id}', 'GroupzGroupTypeController@deleteGroupType');

Route::get('/Group/MemberStatus', array('before' => 'auth', 'uses' => 'GroupzMemberStatusController@getIndex'));
Route::get('/Group/getMemberStatusListing', 'GroupzMemberStatusController@getListing');
Route::post('/Group/postMemberStatus', 'GroupzMemberStatusController@postMemberStatus');
Route::post('/Group/putMemberStatus/{id}', 'GroupzMemberStatusController@putMemberStatus');
Route::post('/Group/deleteMemberStatus/{id}', 'GroupzMemberStatusController@deleteMemberStatus');

Route::get('/Group/Status', array('before' => 'auth', 'uses' => 'GroupzStatusController@getIndex'));
Route::get('/Group/getStatusListing', 'GroupzStatusController@getListing');
Route::post('/Group/postStatus', 'GroupzStatusController@postStatus');
Route::post('/Group/putStatus/{id}', 'GroupzStatusController@putStatus');
Route::post('/Group/deleteStatus/{id}', 'GroupzStatusController@deleteStatus');

Route::get('/Group/DivisionType', array('before' => 'auth', 'uses' => 'GroupzDivisionTypeController@getIndex'));
Route::get('/Group/getDivisionTypeListing', 'GroupzDivisionTypeController@getListing');
Route::post('/Group/postDivisionType', 'GroupzDivisionTypeController@postDivisionType');
Route::post('/Group/putDivisionType/{id}', 'GroupzDivisionTypeController@putDivisionType');
Route::post('/Group/deleteDivisionType/{id}', 'GroupzDivisionTypeController@deleteDivisionType');

// Funeral Services
Route::get('/MDChapterAndAboveLeaders', array('before' => 'auth', 'uses' => 'MemberController@getFuneralServicesIndex'));
Route::get('/MDChapterAndAboveLeaders/MDChapterAndAboveListing', 'MemberController@getMDChapterAndAboveListing');
Route::post('/MDChapterAndAboveLeaders/getFuneralInfo/{id}', 'MemberController@getMemberInfo');

// Member
Route::get('/Members', array('before' => 'auth', 'uses' => 'MemberController@getIndex'));
Route::get('/Members/getMemberListing', 'MemberController@getMemberListing');
Route::post('/Members/getMemberInfo/{id}', 'MemberController@getMemberInfo');
Route::post('/Members/postNricSearch/{id}', 'MemberController@postNricSearch');
Route::post('/Members/postPrintLeadersAttendanceByRegion', 'MemberController@postPrintLeadersAttendanceByRegion');
Route::post('/Members/getMDChapterandabove', 'MemberController@getMDChapterandabove');
Route::get('/Members/getZone/{id}','MemberController@getZone');
Route::get('/Members/getChapter/{id}','MemberController@getChapter');
Route::post('/Members/deleteMember/{id}', 'MemberController@deleteMember');
Route::post('/Members/putMember/{id}', 'MemberController@putMember');

Route::get('/Members/convert', 'MemberController@getConvert');
Route::post('/Members/postConvert', 'MemberController@postConvert');
Route::post('/Members/posttransfermmsboe', 'MemberController@posttransfermmsboe');
Route::post('/Members/postConvertAuto', 'MemberController@postConvertAuto');
Route::post('/Members/post2019Members', 'MemberController@post2019Members');
Route::post('/Members/postConvertNricHash', 'MemberController@postConvertNricHash');
Route::post('/Members/postConvertFront/{id}', 'MemberController@postConvertFront');
Route::post('/Members/putCNameDOB', 'MemberController@putCNameDOB');
Route::post('/Members/DatabaseUpdate', 'MemberController@DatabaseUpdate');
Route::post('/Members/AddressUpdate', 'MemberController@putEncryptAddress');
Route::post('/Members/NricSearchCode', 'MemberController@putNricSearchCode');
Route::post('/Members/EventDetailInsert', 'MemberController@posteventdetail');
Route::post('/Members/EventFDDetailInsert', 'MemberController@posteventfddetail');
Route::post('/Members/EventPDDetailInsert', 'MemberController@posteventpddetail');
Route::post('/Members/EventKnightDetailInsert', 'MemberController@posteventknightdetail');
Route::post('/Members/EventANCInsert', 'MemberController@posteventancdetail');
Route::post('/Members/EventZoneDM', 'MemberController@postzonedm');

// Award / Gifts / Certificates
Route::get('/Award', array('before' => 'auth', 'uses' => 'AwardController@getIndex'));
Route::get('/Award/getAwardListing', 'AwardController@getAwardListing');
Route::post('/Award/postAward', 'AwardController@postAward');
Route::post('/Award/deleteAward/{id}', 'AwardController@deleteAward');
Route::post('/Award/Detail/putAward/{id}', 'AwardController@putAward');

// Award / Gifts / Certificates zTables
Route::get('/Award/Type', array('before' => 'auth', 'uses' => 'AwardzTypeController@getIndex'));
Route::get('/Award/getTypeListing', 'AwardzTypeController@getListing');
Route::post('/Award/postType', 'AwardzTypeController@postType');
Route::post('/Award/putType/{id}', 'AwardzTypeController@putType');
Route::post('/Award/deleteType/{id}', 'AwardzTypeController@deleteType');

// Award / Gifts / Certificates Detail
Route::get('/Award/Detail/{id}', array('before' => 'auth', 'uses' => 'AwardDetailController@getIndex'));
Route::get('/Award/Detail/getDetailListing/{id}', 'AwardDetailController@getDetailListing');
Route::post('/Award/Detail/postNricSearch/{id}', 'AwardDetailController@postNricSearch');
Route::post('/Award/Detail/postAddMember/{id}', 'AwardDetailController@postAddMember');
Route::post('/Award/Detail/deleteGroupMember/{id}', 'AwardDetailController@deleteMember');

// Security
Route::get('/Security', 'SecurityDashboardController@getIndex');
// Security Attendance
Route::get('/Security/Attendance', 'SecurityAttendanceController@getIndex');
Route::post('/Security/postLogIn', 'SecurityLoginController@postLogIn');
Route::post('/Security/postSignIn', 'SecurityAttendanceController@postSignIn');
Route::post('/Security/postSignOut/{id}', 'SecurityAttendanceController@postSignOut');
Route::get('/Security/getSecurityAttendanceListing', 'SecurityAttendanceController@getSecurityAttendanceListing');
Route::post('/Security/deleteSecurityAttendance/{id}', 'SecurityAttendanceController@deleteSecurityAttendance');
// Security Occurrence
Route::post('/Security/postOccurrence', 'SecurityDashboardController@postOccurrence');
Route::get('/Security/getSecurityOccurrenceListing', 'SecurityDashboardController@getSecurityOccurrenceListing');
Route::post('/Security/deleteSecurityOccurrence/{id}', 'SecurityDashboardController@deleteSecurityOccurrence');

// Student Division
Route::get('/StudentDivision', 'StudentDivisionController@getDashboard');
Route::get('/StudentDivision/members', 'StudentDivisionController@getMemberIndex');
Route::get('/StudentDivision/kenshu', 'StudentDivisionController@getKenshuIndex');
Route::post('/StudentDivision/searchSsaMembers', 'StudentDivisionController@postSearchSsaMembers');
Route::post('/StudentDivision/addSdMember', 'StudentDivisionController@postAddSdMember');
Route::post('/StudentDivision/addMemberToSdKenshu', 'StudentDivisionController@postAddMemberToSdKenshu');

// Leaders Portal
// Leadership Portal Login
Route::get('/boeportallogin', array('before' => 'installadmin', 'uses' => 'LeadersPortalLoginController@getIndex'));
Route::controller('BOEPortalLogin', 'LeadersPortalLoginController');
Route::get('/getLeadersPortalLogout', 'LeadersPortalLoginController@getLogout');
Route::get('/public/getLeadersPortalLogout', 'LeadersPortalLoginController@getLogout');

// Leaders Portal Dashboard
Route::get('/BOEPortalDashboard', array('before' => 'auth', 'uses' => 'LeadersPortalDashboardController@getIndex'));
Route::get('/BOEPortalDashboard/getEventListing', 'LeadersPortalDashboardController@getEventListing');
Route::get('/BOEPortalDashboard/getSHQStats', 'LeadersPortalDashboardController@getSHQStats');
Route::get('/BOEPortalDashboard/getRegionDMCurrentMonthStats', 'LeadersPortalDashboardController@getRegionDMCurrentMonthStats');
Route::get('/BOEPortalDashboard/getRegionDMNotSubmittedStats', 'LeadersPortalDashboardController@getRegionDMNotSubmittedStats');
Route::get('/BOEPortalDashboard/getRegionStats', 'LeadersPortalDashboardController@getRegionStats');
Route::get('/BOEPortalDashboard/getZoneStats', 'LeadersPortalDashboardController@getZoneStats');
Route::get('/BOEPortalDashboard/getZoneDMCurrentMonthStats', 'LeadersPortalDashboardController@getZoneDMCurrentMonthStats');
Route::get('/BOEPortalDashboard/getZoneDMNotSubmittedStats', 'LeadersPortalDashboardController@getZoneDMNotSubmittedStats');
Route::get('/BOEPortalDashboard/getChapterDMCurrentMonthStats', 'LeadersPortalDashboardController@getChapterDMCurrentMonthStats');
Route::get('/BOEPortalDashboard/getChapterDMNotSubmittedStats', 'LeadersPortalDashboardController@getChapterDMNotSubmittedStats');
Route::get('/BOEPortalDashboard/getChapterStats', 'LeadersPortalDashboardController@getChapterStats');
Route::get('/BOEPortalDashboard/getDistrictDMCurrentMonthStats', 'LeadersPortalDashboardController@getDistrictDMCurrentMonthStats');
Route::get('/BOEPortalDashboard/getDistrictDMNotSubmittedStats', 'LeadersPortalDashboardController@getDistrictDMNotSubmittedStats');
Route::get('/BOEPortalDashboard/getDistrictStats', 'LeadersPortalDashboardController@getDistrictStats');
Route::get('/BOEPortalDashboard/getDistrictIndividualDMNotSubmittedStats', 'LeadersPortalDashboardController@getDistrictIndividualDMNotSubmittedStats');

// Can be deleted after the campaign is over
Route::post('/BOEPortalDashboard/putBOEedit', 'LeadersPortalDashboardController@putBOEedit');
Route::post('/BOEPortalDashboard/putYouthSubmitedit', 'LeadersPortalDashboardController@putYouthSubmitedit');
Route::post('/BOEPortalDashboard/putDiscussionMeetingedit', 'LeadersPortalDashboardController@putDiscussionMeetingedit');
Route::post('/BOEPortalDashboard/putStudyExamedit', 'LeadersPortalDashboardController@putStudyExamedit');
Route::post('/BOEPortalDashboard/postMDDaimoku', 'LeadersPortalDashboardController@postMDDaimoku');
Route::post('/BOEPortalDashboard/posthomevisitmdadd', 'LeadersPortalDashboardController@posthomevisitmdadd');
Route::post('/BOEPortalDashboard/posthomevisitwdadd', 'LeadersPortalDashboardController@posthomevisitwdadd');
Route::post('/BOEPortalDashboard/posthomevisitymadd', 'LeadersPortalDashboardController@posthomevisitymadd');
Route::post('/BOEPortalDashboard/posthomevisitywadd', 'LeadersPortalDashboardController@posthomevisitywadd');

// Leaders Portal Believers
Route::get('/BOEPortalBelievers', array('before' => 'auth', 'uses' => 'LeadersPortalBelieversController@getIndex'));
Route::get('/BOEPortalBelievers/getBelieversListingSHQ', 'LeadersPortalBelieversController@getBelieversListingSHQ');
Route::get('/BOEPortalBelievers/getBelieversListingRHQ', 'LeadersPortalBelieversController@getBelieversListingRHQ');
Route::get('/BOEPortalBelievers/getBelieversListingZone', 'LeadersPortalBelieversController@getBelieversListingZone');
Route::get('/BOEPortalBelievers/getBelieversListingChapter', 'LeadersPortalBelieversController@getBelieversListingChapter');
Route::get('/BOEPortalBelievers/getBelieversListingDistrict', 'LeadersPortalBelieversController@getBelieversListingDistrict');
Route::get('/BOEPortalBelievers/getBelieversInfo/{id}', 'LeadersPortalBelieversController@getBelieversInfo');
Route::post('/BOEPortalBelievers/deleteBeliever/{id}', 'LeadersPortalBelieversController@deleteBeliever');
Route::post('/BOEPortalBelievers/postNewAttendee', 'LeadersPortalBelieversController@postNewAttendee');
Route::get('/BOEPortalBelievers/getZone/{id}','LeadersPortalBelieversController@getZone');
Route::get('/BOEPortalBelievers/getChapter/{id}','LeadersPortalBelieversController@getChapter');

// Leaders Portal New Friends
Route::get('/BOEPortalNewFriends', array('before' => 'auth', 'uses' => 'LeadersPortalNewFriendsController@getIndex'));
Route::get('/BOEPortalNewFriends/getNewFriendsListingSHQ', 'LeadersPortalNewFriendsController@getNewFriendsListingSHQ');
Route::get('/BOEPortalNewFriends/getNewFriendsListingRHQ', 'LeadersPortalNewFriendsController@getNewFriendsListingRHQ');
Route::get('/BOEPortalNewFriends/getNewFriendsListingZone', 'LeadersPortalNewFriendsController@getNewFriendsListingZone');
Route::get('/BOEPortalNewFriends/getNewFriendsListingChapter', 'LeadersPortalNewFriendsController@getNewFriendsListingChapter');
Route::get('/BOEPortalNewFriends/getNewFriendsListingDistrict', 'LeadersPortalNewFriendsController@getNewFriendsListingDistrict');
Route::post('/BOEPortalNewFriends/postNewAttendee', 'LeadersPortalNewFriendsController@postNewAttendee');
Route::post('/BOEPortalNewFriends/putNewFriend/{id}', 'LeadersPortalNewFriendsController@putNewFriend');
Route::post('/BOEPortalNewFriends/deleteNewFriend/{id}', 'LeadersPortalNewFriendsController@deleteNewFriend');
Route::get('/BOEPortalNewFriends/getNewFriendsInfo/{id}', 'LeadersPortalNewFriendsController@getNewFriendsInfo');

// Leaders Portal Leaders
Route::get('/BOEPortalLeaders', array('before' => 'auth', 'uses' => 'LeadersPortalLeadersController@getIndex'));
Route::get('/BOEPortalLeaders/getLeadersListingSHQ', 'LeadersPortalLeadersController@getLeadersListingSHQ');
Route::get('/BOEPortalLeaders/getLeadersListingRHQ', 'LeadersPortalLeadersController@getLeadersListingRHQ');
Route::get('/BOEPortalLeaders/getLeadersListingZone', 'LeadersPortalLeadersController@getLeadersListingZone');
Route::get('/BOEPortalLeaders/getLeadersListingChapter', 'LeadersPortalLeadersController@getLeadersListingChapter');
Route::get('/BOEPortalLeaders/getLeadersListingDistrict', 'LeadersPortalLeadersController@getLeadersListingDistrict');

// Leaders Portal Members
Route::get('/BOEPortalMembers', array('before' => 'auth', 'uses' => 'LeadersPortalMembersController@getIndex'));
Route::get('/BOEPortalMembers/getMembersListingSHQ', 'LeadersPortalMembersController@getMembersListingSHQ');
Route::get('/BOEPortalMembers/getMembersListingRHQ', 'LeadersPortalMembersController@getMembersListingRHQ');
Route::get('/BOEPortalMembers/getMembersListingZone', 'LeadersPortalMembersController@getMembersListingZone');
Route::get('/BOEPortalMembers/getMembersListingChapter', 'LeadersPortalMembersController@getMembersListingChapter');
Route::get('/BOEPortalMembers/getMembersListingDistrict', 'LeadersPortalMembersController@getMembersListingDistrict');
Route::get('/BOEPortalMembers/getMembersInfo/{id}', 'LeadersPortalMembersController@getMembersInfo');

// Leaders Portal Discussion Meeting Listing
Route::get('/BOEPortalDiscussionMeetingListing', array('before' => 'auth', 'uses' => 'LeadersPortalDiscussionMeetingListingController@getIndex'));
Route::get('/BOEPortalDiscussionMeetingListing/getDiscussionMeetingListingDistrict', 'LeadersPortalDiscussionMeetingListingController@getDiscussionMeetingListingDistrict');
Route::get('/BOEPortalDiscussionMeetingListing/getDiscussionMeetingListingSummary', 'LeadersPortalDiscussionMeetingListingController@getDiscussionMeetingListingSummary');
Route::post('/BOEPortalDiscussionMeetingListing/postdistrictattendees', 'LeadersPortalDiscussionMeetingListingController@postdistrictattendees');

// Leaders Portal Discussion Meeting
Route::get('/BOEPortalDiscussionMeeting/{id}', array('before' => 'auth', 'uses' => 'LeadersPortalDiscussionMeetingController@getIndex'));
Route::get('/BOEPortalDiscussionMeeting/getDiscussionMeetingAttendees/{id}', 'LeadersPortalDiscussionMeetingController@getDiscussionMeetingAttendees');
Route::get('/BOEPortalDiscussionMeeting/getdistrictstatsListing/{id}', 'LeadersPortalDiscussionMeetingController@getdistrictstatsListing');
Route::get('/BOEPortalDiscussionMeeting/getDiscussionMeetingHomevisit/{id}', 'LeadersPortalDiscussionMeetingController@getDiscussionMeetingHomevisit');
Route::get('/BOEPortalDiscussionMeeting/getAttendeeInfo/{id}', 'LeadersPortalDiscussionMeetingController@getAttendeeInfo');
Route::post('/BOEPortalDiscussionMeeting/postSRZCAttendance/{id}', 'LeadersPortalDiscussionMeetingController@postSRZCAttendance');
Route::post('/BOEPortalDiscussionMeeting/postHomevisit/{id}', 'LeadersPortalDiscussionMeetingController@postHomevisit');
Route::post('/BOEPortalDiscussionMeeting/putAttendedAttendee/{id}', 'LeadersPortalDiscussionMeetingController@putAttendedAttendee');
Route::post('/BOEPortalDiscussionMeeting/putAbsentAttendee/{id}', 'LeadersPortalDiscussionMeetingController@putAbsentAttendee');
Route::post('/BOEPortalDiscussionMeeting/postNewAttendee/{id}', 'LeadersPortalDiscussionMeetingController@postNewAttendee');
Route::post('/BOEPortalDiscussionMeeting/postEditAttendee/{id}', 'LeadersPortalDiscussionMeetingController@postEditAttendee');
Route::post('/BOEPortalDiscussionMeeting/deleteAttendee/{id}', 'LeadersPortalDiscussionMeetingController@deleteAttendee');
Route::post('/BOEPortalDiscussionMeeting/postdmstatistic/{id}', 'LeadersPortalDiscussionMeetingController@postDMStatistic');
Route::get('/BOEPortalDiscussionMeeting/getZone/{id}','LeadersPortalDiscussionMeetingController@getZone');
Route::get('/BOEPortalDiscussionMeeting/getChapter/{id}','LeadersPortalDiscussionMeetingController@getChapter');

// Leaders Portal Study Meeting Listing
Route::get('/BOEPortalStudyMeetingListing', array('before' => 'auth', 'uses' => 'LeadersPortalStudyMeetingListingController@getIndex'));
Route::get('/BOEPortalStudyMeetingListing/getDiscussionMeetingListingDistrict', 'LeadersPortalStudyMeetingListingController@getStudyMeetingListingDistrict');
Route::post('/BOEPortalStudyMeetingListing/postdistrictattendees', 'LeadersPortalStudyMeetingListingController@postdistrictattendees');

// Leaders Portal Study Meeting
Route::get('/BOEPortalStudyMeeting/{id}', array('before' => 'auth', 'uses' => 'LeadersPortalStudyMeetingController@getIndex'));
Route::get('/BOEPortalStudyMeeting/getDiscussionMeetingAttendees/{id}', 'LeadersPortalStudyMeetingController@getStudyMeetingAttendees');
Route::get('/BOEPortalStudyMeeting/getdistrictstatsListing/{id}', 'LeadersPortalStudyMeetingController@getdistrictstatsListing');
Route::post('/BOEPortalStudyMeeting/putAttendedAttendee/{id}', 'LeadersPortalStudyMeetingController@putAttendedAttendee');
Route::post('/BOEPortalStudyMeeting/putAbsentAttendee/{id}', 'LeadersPortalStudyMeetingController@putAbsentAttendee');
Route::post('/BOEPortalStudyMeeting/postNewAttendee/{id}', 'LeadersPortalStudyMeetingController@postNewAttendee');

// Leaders Portal Event Past Listing
Route::get('/BOEPortalEventPastListing', array('before' => 'auth', 'uses' => 'LeadersPortalEventPastListingController@getIndex'));
Route::get('/BOEPortalEventPastListing/getListing', 'LeadersPortalEventPastListingController@getListing');

// Leaders Portal Event Past
Route::get('/BOEPortalEventPast/{id}', array('before' => 'auth', 'uses' => 'LeadersPortalEventPastController@getIndex'));
Route::get('/BOEPortalEventPast/getEventParticipant/{id}', 'LeadersPortalEventPastController@getEventPastParticipant');

// Leaders Portal Event Registration Listing
Route::get('/BOEPortalEventListing', array('before' => 'auth', 'uses' => 'LeadersPortalEventListingController@getIndex'));
Route::get('/BOEPortalEventListing/getEventListing', 'LeadersPortalEventListingController@getEventListing');

// Leaders Portal Event Registration
Route::get('/BOEPortalEvent/{id}', array('before' => 'auth', 'uses' => 'LeadersPortalEventController@getIndex'));
Route::get('/BOEPortalEvent/getEventParticipant/{id}', 'LeadersPortalEventController@getEventParticipant');
Route::get('/BOEPortalEvent/getSHQEventTrainingStats/{id}', 'LeadersPortalEventController@getSHQEventTrainingStats');
Route::get('/BOEPortalEvent/getRHQEventTrainingStats/{id}', 'LeadersPortalEventController@getRHQEventTrainingStats');
Route::get('/BOEPortalEvent/getZoneEventTrainingStats/{id}', 'LeadersPortalEventController@getZoneEventTrainingStats');
Route::get('/BOEPortalEvent/getChapterEventTrainingStats/{id}', 'LeadersPortalEventController@getChapterEventTrainingStats');
Route::get('/BOEPortalEvent/getDistrictEventTrainingStats/{id}', 'LeadersPortalEventController@getDistrictEventTrainingStats');
Route::get('/BOEPortalEvent/getMembership/{id}', 'LeadersPortalEventController@getMembership');
Route::get('/BOEPortalEvent/getMembershipSHQ/{id}', 'LeadersPortalEventController@getMembershipSHQ');
Route::get('/BOEPortalEvent/getMADMembership/{id}', 'LeadersPortalEventController@getMADMembership');
Route::post('/BOEPortalEvent/postEventParticipant/{id}', 'LeadersPortalEventController@postEventParticipant');
Route::post('/BOEPortalEvent/postEventParticipantOthers/{id}', 'LeadersPortalEventController@postEventParticipantOthers');
Route::post('/BOEPortalEvent/deleteParticipant/{id}', 'LeadersPortalEventController@deleteParticipant');
Route::get('/BOEPortalEvent/getZone/{id}','LeadersPortalEventController@getZone');
Route::get('/BOEPortalEvent/getChapter/{id}','LeadersPortalEventController@getChapter');
Route::post('/BOEPortalEvent/postEventSpecialCheck1Yes/{id}', 'LeadersPortalEventController@postEventSpecialCheck1Yes');
Route::post('/BOEPortalEvent/postEventSpecialCheck1No/{id}', 'LeadersPortalEventController@postEventSpecialCheck1No');
Route::post('/BOEPortalEvent/postEventSpecialCheck2Yes/{id}', 'LeadersPortalEventController@postEventSpecialCheck2Yes');
Route::post('/BOEPortalEvent/postEventSpecialCheck2No/{id}', 'LeadersPortalEventController@postEventSpecialCheck2No');
Route::post('/BOEPortalEvent/postEventSpecialCheck3Yes/{id}', 'LeadersPortalEventController@postEventSpecialCheck3Yes');
Route::post('/BOEPortalEvent/postEventSpecialCheck3No/{id}', 'LeadersPortalEventController@postEventSpecialCheck3No');
Route::post('/BOEPortalEvent/getMemberInfo/{id}', 'LeadersPortalEventController@getMemberInfo');
Route::post('/BOEPortalEvent/getEventAddInfo/{id}', 'LeadersPortalEventController@getEventAddInfo');
Route::post('/BOEPortalEvent/putEventAddInfo/{id}', 'LeadersPortalEventController@putEventAddInfo');
Route::post('/BOEPortalEvent/putAbsent/{id}', 'LeadersPortalEventController@putAbsent');
Route::post('/BOEPortalEvent/putAttend/{id}', 'LeadersPortalEventController@putAttend');
Route::get('/BOEPortalEvent/getSpecialRHQStats/{id}', 'LeadersPortalEventController@getSpecialRHQStats');
Route::get('/BOEPortalEvent/getSpecialZoneStats/{id}', 'LeadersPortalEventController@getSpecialZoneStats');
Route::get('/BOEPortalEvent/getSpecialChapterStats/{id}', 'LeadersPortalEventController@getSpecialChapterStats');
Route::get('/BOEPortalEvent/getSpecialDistrictStats/{id}', 'LeadersPortalEventController@getSpecialDistrictStats');
Route::get('/BOEPortalEvent/getRoleDivisionRHQStats/{id}', 'LeadersPortalEventController@getRoleDivisionRHQStats');
Route::get('/BOEPortalEvent/getRoleDivisionZoneStats/{id}', 'LeadersPortalEventController@getRoleDivisionZoneStats');
Route::get('/BOEPortalEvent/getRoleDivisionChapterStats/{id}', 'LeadersPortalEventController@getRoleDivisionChapterStats');
Route::get('/BOEPortalEvent/getRoleDivisionDistrictStats/{id}', 'LeadersPortalEventController@getRoleDivisionDistrictStats');
Route::get('/BOEPortalEvent/getStatusDivisionRHQStats/{id}', 'LeadersPortalEventController@getStatusDivisionRHQStats');
Route::get('/BOEPortalEvent/getStatusDivisionZoneStats/{id}', 'LeadersPortalEventController@getStatusDivisionZoneStats');
Route::get('/BOEPortalEvent/getStatusDivisionChapterStats/{id}', 'LeadersPortalEventController@getStatusDivisionChapterStats');
Route::get('/BOEPortalEvent/getStatusDivisionDistrictStats/{id}', 'LeadersPortalEventController@getStatusDivisionDistrictStats');
Route::get('/BOEPortalEvent/getRSVPShowRHQStats/{id}', 'LeadersPortalEventController@getRSVPShowRHQStats');
Route::get('/BOEPortalEvent/getRSVPShowZoneStats/{id}', 'LeadersPortalEventController@getRSVPShowZoneStats');
Route::get('/BOEPortalEvent/getRSVPShowChapterStats/{id}', 'LeadersPortalEventController@getRSVPShowChapterStats');
Route::get('/BOEPortalEvent/getRSVPShowDistrictStats/{id}', 'LeadersPortalEventController@getRSVPShowDistrictStats');

// Youth Summit Event, to be deleted after the event.
Route::get('/BOEPortalEvent/getYSParticipants/{id}', 'LeadersPortalEventController@getYSParticipants');
Route::get('/BOEPortalEvent/getYSYonsha/{id}', 'LeadersPortalEventController@getYSYonsha');
Route::get('/BOEPortalEvent/getYSYouth/{id}', 'LeadersPortalEventController@getYSYouth');
Route::post('/BOEPortalEvent/postEventYouthSummitParticipantsTickets/{id}', 'LeadersPortalEventController@postEventYouthSummitParticipantsTickets');
Route::post('/BOEPortalEvent/postEventYouthSummitYonshaTickets/{id}', 'LeadersPortalEventController@postEventYouthSummitYonshaTickets');
Route::post('/BOEPortalEvent/postEventYouthSummitYouthTickets/{id}', 'LeadersPortalEventController@postEventYouthSummitYouthTickets');
Route::get('/BOEPortalEvent/getYouthSummitYouthInfo/{id}', 'LeadersPortalEventController@getYouthSummitYouthInfo');
Route::get('/BOEPortalEvent/getYouthSummitParticipantInfo/{id}', 'LeadersPortalEventController@getYouthSummitParticipantInfo');
Route::get('/BOEPortalEvent/getYouthSummitYonshaInfo/{id}', 'LeadersPortalEventController@getYouthSummitYonshaInfo');
Route::get('/BOEPortalEvent/getZoneysp/{id}','LeadersPortalEventController@getZoneysp');
Route::get('/BOEPortalEvent/getChapterysp/{id}','LeadersPortalEventController@getChapterysp');
Route::get('/BOEPortalEvent/getZoneysy/{id}','LeadersPortalEventController@getZoneysy');
Route::get('/BOEPortalEvent/getChapterysy/{id}','LeadersPortalEventController@getChapterysy' );
Route::get('/BOEPortalEvent/getZoneysa/{id}','LeadersPortalEventController@getZoneysa');
Route::get('/BOEPortalEvent/getChapterysa/{id}','LeadersPortalEventController@getChapterysa' );

// Leaders Portal Campaign Listing
Route::get('/BOEPortalCampaignListing', array('before' => 'auth', 'uses' => 'LeadersPortalCampaignListingController@getIndex'));
Route::get('/BOEPortalCampaignListing/getListing', 'LeadersPortalCampaignListingController@getListing');

// Leaders Portal Campaign
Route::get('/BOEPortalCampaign/{id}', array('before' => 'auth', 'uses' => 'LeadersPortalCampaignController@getIndex'));
Route::get('/BOEPortalCampaign/getModuleDetail/{id}', 'LeadersPortalCampaignController@getModuleDetail');
Route::post('/BOEPortalCampaign/postEditModuleDetail/{id}', 'LeadersPortalCampaignController@postEditModuleDetail');

// Leaders Portal Pre MAD Kenshu Training Listing
Route::get('/BOEPortalPastPreMADTrainingListing', array('before' => 'auth', 'uses' => 'LeadersPortalPastPreMADTrainingListingController@getIndex'));
Route::get('/BOEPortalPastPreMADTrainingListing/getListing', 'LeadersPortalPastPreMADTrainingListingController@getListing');

// Leaders Portal Pre MAD Kenshu Eligible Listing
Route::get('/BOEPortalPreMADEligibleListing', array('before' => 'auth', 'uses' => 'LeadersPortalPreMADEligibleListingController@getIndex'));
Route::get('/BOEPortalPreMADEligibleListing/getListing', 'LeadersPortalPreMADEligibleListingController@getListing');

// Leaders Portal 2019 4 Objectives
Route::get('/BOEPortal20194Objects', array('before' => 'auth', 'uses' => 'LeadersPortal20194ObjectsController@getIndex'));
Route::get('/BOEPortal20194Objects/getListing', 'LeadersPortal20194ObjectsController@getListing');

// Campaign
Route::get('/Campaign', array('before' => 'auth', 'uses' => 'CampaignController@getIndex'));
Route::get('/Campaign/getListing', 'CampaignController@getListing');
Route::post('/Campaign/postResource', 'CampaignController@postResource');
Route::post('/Campaign/deleteResource/{id}', 'CampaignController@deleteResource');
Route::post('/Campaign/Detail/putResource/{id}', 'CampaignController@putResource');

//Campaign Detail
Route::get('/Campaign/Detail/{id}', array('before' => 'auth', 'uses' => 'CampaignDetailController@getIndex'));
Route::get('/Campaign/Detail/getListing/{id}', 'CampaignDetailController@getListing');
Route::get('/Campaign/Detail/getEventListing/{id}', 'CampaignDetailController@getEventListing');
Route::post('/Campaign/Detail/postNricSearch', 'CampaignDetailController@postNricSearch');
Route::get('/Campaign/getNameSearch', 'CampaignDetailController@getNameSearch');
Route::post('/Campaign/Detail/postLevelDistrict/{id}', 'CampaignDetailController@postLevelDistrict');
Route::post('/Campaign/Detail/deleteAll/{id}', 'CampaignDetailController@deleteAll');
Route::post('/Campaign/Detail/getModuleDetail/{id}', 'CampaignDetailController@getModuleDetail');
Route::post('/Campaign/Detail/deleteModuleDetail/{id}', 'CampaignDetailController@deleteModuleDetail');
Route::post('/Campaign/Detail/postModuleDetail/{id}', 'CampaignDetailController@postModuleDetail');
Route::post('/Campaign/Detail/putModuleDetail/{id}', 'CampaignDetailController@putModuleDetail');
Route::get('/Campaign/Detail/getZone/{id}','CampaignDetailController@getZone');
Route::get('/Campaign/Detail/getChapter/{id}','CampaignDetailController@getChapter');

// Campaign zTables
Route::get('/Campaign/CampaignType', array('before' => 'auth', 'uses' => 'CampaignzCampaignTypeController@getIndex'));
Route::get('/Campaign/getCampaignTypeListing', 'CampaignzCampaignTypeController@getListing');
Route::post('/Campaign/postCampaignType', 'CampaignzCampaignTypeController@postCampaignType');
Route::post('/Campaign/putCampaignType/{id}', 'CampaignzCampaignTypeController@putCampaignType');
Route::post('/Campaign/deleteCampaignType/{id}', 'CampaignzCampaignTypeController@deleteCampaignType');

Route::get('/Campaign/DivisionType', array('before' => 'auth', 'uses' => 'CampaignzDivisionTypeController@getIndex'));
Route::get('/Campaign/getDivisionTypeListing', 'CampaignzDivisionType@getListing');
Route::post('/Campaign/postDivisionType', 'CampaignzDivisionTypeController@postDivisionType');
Route::post('/Campaign/putDivisionType/{id}', 'CampaignzDivisionTypeController@putDivisionType');
Route::post('/Campaign/deleteDivisionType/{id}', 'CampaignzDivisionTypeController@deleteDivisionType');

Route::get('/Campaign/LevelType', array('before' => 'auth', 'uses' => 'CampaignzLevelTypeController@getIndex'));
Route::get('/Campaign/getLevelTypeListing', 'CampaignzLevelTypeController@getListing');
Route::post('/Campaign/postLevelType', 'CampaignzDivisionTypeController@postLevelType');
Route::post('/Campaign/putLevelType/{id}', 'CampaignzDivisionTypeController@putLevelType');
Route::post('/Campaign/deleteLevelType/{id}', 'CampaignzLevelTypeController@deleteLevelType');

Route::get('/Campaign/Status', array('before' => 'auth', 'uses' => 'CampaignzStatusController@getIndex'));
Route::get('/Campaign/getStatusListing', 'CampaignzStatuseController@getListing');
Route::post('/Campaign/postStatus', 'CampaignzStatusController@postStatus');
Route::post('/Campaign/putStatus/{id}', 'CampaignzStatusController@putStatus');
Route::post('/Campaign/deleteStatus/{id}', 'CampaignzStatusController@deleteStatus');