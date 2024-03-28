<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Livewire\ParentCompany\Index;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Port\Index as PortIndex;
use App\Http\Livewire\Role\Index as RoleIndex;
use App\Http\Controllers\EventReportController;
use App\Http\Livewire\People\Index as PeopleIndex;
use App\Http\Livewire\Roster\Index as RosterIndex;
use App\Http\Livewire\Company\Index as CompanyIndex;
use App\Http\Livewire\Event\Site\Index as SiteIndex;
use App\Http\Livewire\Event\Type\Index as TypeIndex;
use App\Http\Livewire\EventReportList\HazardId\Details;
use App\Http\Livewire\RoleClass\Index as RoleClassIndex;
use App\Http\Livewire\Workgroup\Index as WorkgroupIndex;
use App\Http\Livewire\Department\Index as DepartmentIndex;
use App\Http\Livewire\Event\SubType\Index as SubTypeIndex;
use App\Http\Livewire\StatusCode\Index as StatusCodeIndex;
use App\Http\Livewire\Event\Category\Index as CategoryIndex;
use App\Http\Livewire\Event\Location\Index as LocationIndex;
use App\Http\Livewire\CompanyLevel\Index as CompanyLevelIndex;
use App\Http\Livewire\EventReport\Register\Index as MainIndex;
use App\Http\Livewire\SecurityUser\Index as SecurityUserIndex;
use App\Http\Livewire\Navigation\Welcome\Index as WelcomeIndex;
use App\Http\Livewire\Risk\Assessment\Index as AssessmentIndex;
use App\Http\Livewire\Risk\Likelihood\Index as LikelihoodIndex;
use App\Http\Livewire\RealFlowEvent\Index as RealFlowEventIndex;
use App\Http\Livewire\Risk\Consequence\Index as ConsequenceIndex;
use App\Http\Livewire\DepartmentGroup\Index as DepartmentGroupIndex;
use App\Http\Livewire\ResponsibleRole\Index as ResponsibleRoleIndex;
use App\Http\Livewire\EventReportList\HazardId\Index as HazardIdIndex;
use App\Http\Livewire\Dasboard\Chart\AllInjury\Index as AllInjuryIndex;
use App\Http\Livewire\AccessRiskAssessment\Index as AccessRiskAssessmentIndex;
use App\Http\Livewire\AdminControlCompanyManhours\Index as AdminControlCompanyManhours;
use App\Http\Livewire\Guest\EventReportList\Dashboard\Index as DashboardIndex;
use App\Http\Livewire\Guest\EventReportList\Hazard\Detail;
use App\Http\Livewire\Guest\EventReportList\Hazard\Index as HazardIndexGuest;
use App\Http\Livewire\Guest\Manhours\ManhoursRegister\Index as ManhoursManhoursRegisterIndex;
use App\Http\Livewire\Manhours\ManhoursRegister\Index as ManhoursRegisterIndex;
use App\Http\Livewire\RoleUser\Index as RoleUserIndex;
use App\Http\Livewire\User\Index as UserIndex;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('/', AllInjuryIndex::class)->name('dashboard');

Route::middleware(['auth','user-role:1'])->group(function()
{
    Route::get('InControl/users',UserIndex::class)->name('users');
    Route::get('InControl/people', PeopleIndex::class)->name('people');
    Route::get('InControl/categorycompany', Index::class)->name('categoryCompany');
    Route::get('InControl/company', CompanyIndex::class)->name('company');
    Route::get('InControl/department', DepartmentIndex::class)->name('department');
    Route::get('InControl/deptGroup', DepartmentGroupIndex::class)->name('deptGroup');
    Route::get('InControl/companyLevel', CompanyLevelIndex::class)->name('companyLevel');
    Route::get('InControl/rolePositionClass', RoleClassIndex::class)->name('roleClass');
    Route::get('InControl/rolePosition', RoleIndex::class)->name('rolePosition');
    Route::get('InControl/workgroup', WorkgroupIndex::class)->name('workgroup');
    Route::get('InControl/eventCategory', CategoryIndex::class)->name('eventCategory');
    Route::get('InControl/eventSite', SiteIndex::class)->name('eventSite');
    Route::get('InControl/eventType', TypeIndex::class)->name('eventType');
    Route::get('InControl/eventSubType', SubTypeIndex::class)->name('eventSubType');
    Route::get('InControl/eventLocation', LocationIndex::class)->name('eventLocation');
    Route::get('InControl/riskConsequence', ConsequenceIndex::class)->name('riskConsequence');
    Route::get('InControl/riskConsequence', ConsequenceIndex::class)->name('riskConsequence');
    Route::get('InControl/riskLikelihood', LikelihoodIndex::class)->name('riskLikelihood');
    Route::get('InControl/riskAssessment', AssessmentIndex::class)->name('riskAssessment');
    Route::get('InControl/AdminControlCompanyManhours', AdminControlCompanyManhours::class)->name('AdminControlCompanyManhours');
   
    Route::get('InControl/securityUser', SecurityUserIndex::class)->name('securityUser');
    Route::get('InControl/port', PortIndex::class)->name('port');
    Route::get('InControl/workflowstep', RealFlowEventIndex::class)->name('workflowstep');
    Route::get('InControl/accessRiskAssessment', AccessRiskAssessmentIndex::class)->name('accessRiskAssessment');
    Route::get('InControl/roster', RosterIndex::class)->name('roster');
    Route::get('InControl/responsibleRole', ResponsibleRoleIndex::class)->name('responsibleRole');
    Route::get('InControl/statusCode', StatusCodeIndex::class)->name('statusCode');
    Route::get('InControl/roleUser', RoleUserIndex::class)->name('roleUser');
});
Route::middleware(['auth','user-role:2'])->group(function()
{
    Route::get('user/eventReport/hazard_id', HazardIndexGuest::class)->name('hazardGuest');
    Route::get('user/eventReport/hazard_id/{id}', Detail::class)->name('hazardDetailsGuest');
    Route::get('user/manhours/manhoursRegister',ManhoursManhoursRegisterIndex::class)->name('ManhoursGuest');
});
Route::middleware(['auth','user-role:1'])->group(function () {
    Route::get('eventReport/hazard_id', HazardIdIndex::class)->name('hazard');
    Route::get('eventReport/hazard_id/{id}', Details::class)->name('hazardDetails');
    Route::get('manhours/manhoursRegister',ManhoursRegisterIndex::class)->name('manhoursRegister');
    Route::get('eventReport', MainIndex::class)->name('eventReport');
    // Route::get('eventReport/details/{id}', Update::class)->name('eventReportRegister');
    // Route::get('eventReport/eventParticipants/{id}', ParticipanIndex::class)->name('eventParticipants');

    Route::controller(EventReportController::class)->group(function () {
        Route::get('eventReport/details/{id}', 'show')->name('eventReportRegister');
        Route::get('eventReport/eventParticipants/{id}', 'show')->name('eventParticipants');
        Route::get('eventReport/action/{id}', 'show')->name('action');
        Route::get('eventReport/document/{id}', 'show')->name('document');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
