<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AttendancemAttendance extends Eloquent {

	protected $table = 'Attendance_m_Attendance';
	use SoftDeletingTrait;

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid)) { return $query; }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid)) { return $query; }
        else { return $query; }    
    }

    public function scopeSearch($query, $sSearch, $value2)
    {
        return $query->where(function($query) use ($sSearch, $value2)
        {
            $query->where('eventid', '=', EventmEvent::getid($value2))
                ->where('description', 'Like', '%'.$sSearch.'%')
                ->orwhere('event', 'Like', '%'.$sSearch.'%')
                ->orwhere('eventitem', 'Like', '%'.$sSearch.'%')
                ->orwhere('attendancetype', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%')
                ->orwhere('attendancedate', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeSearchAll($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('description', 'Like', '%'.$sSearch.'%')
                ->orwhere('event', 'Like', '%'.$sSearch.'%')
                ->orwhere('eventitem', 'Like', '%'.$sSearch.'%')
                ->orwhere('attendancetype', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%')
                ->orwhere('attendancedate', 'Like', '%'.$sSearch.'%');
        });
    }

    public static function getFindDuplicateValue($value, $value2, $value3)
    {
        $datDate = DateTime::createFromFormat('Y-m-d', $value3);
        if (AttendancemAttendance::where('eventid', $value2)->where('description', $value)->count() >= 1) 
        { return true; } 
        else 
        {   return false; }
    }

	public function scopeEvent($query, $value)
    {
        if (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User')
        {
            return $query->where('eventid', $value);
        }
        else if (Auth::user()->roleid == 'Single Event Item User' or Auth::user()->roleid == 'Event Chief Trainer')
        {
            // $value4 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('resourcecode', 'EV07')->groupBy('userid')->pluck('eventitem');
            
            return $query->where('eventid', $value); // ->where('eventitem', $value4);
        }
        else if (Auth::user()->roleid == 'Event Trainer')
        {
            $value4 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('resourcecode', 'EV07')->where('deleted_at', NULL)->pluck('eventitem');
            return $query->where('eventid', $value)->where('eventitem', $value4);
        }
        else
        {
            return $query->where('eventid', '=', $value);
        }
    }

    public static function postAttendanceDMClosed($year, $month)
    {
        DB::table('Attendance_m_Attendance')->where('attendancetype', 'Discussion Meeting')->where('status', 'Active')->whereYear('attendancedate', '=', $year)->whereMonth('attendancedate', '=', $month)->update(array('status' => 'Closed'));
        return true;
    }

    public static function postAttendanceDMClosedSubmitted($year, $month)
    {
        DB::table('Attendance_m_Attendance')->where('attendancetype', 'Discussion Meeting')->where('status', 'Active')->where('attendancetotal', '>=', 5)->whereYear('attendancedate', '=', $year)->whereMonth('attendancedate', '=', $month)->update(array('status' => 'Closed'));
        return true;
    }

    public static function getid($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getdescription($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('description');
        return $mid;
    }

    public static function getsession($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('eventsession');
        return $mid;
    }

    public static function geteventid($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('eventid');
        return $mid;
    }

    public static function getattendancestatus($value)
    {
        if(AttendancemAttendance::where('uniquecode', $value)->pluck('status') == "Closed") { return true; }
        else { return false; }
    }

    public static function getattendancechapter($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('chapter');
        return $mid;
    }

    public static function getattendancedistrict($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('district');
        return $mid;
    }

    public function scopeDiscussionMeetingListingDistrict($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('chapter', Session::get('gakkaiuserchapter'))
            ->where('district', Session::get('gakkaiuserdistrict'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeStudyMeetingListingDistrict($query)
    {
        return $query->where('attendancetype', 'District Study Meeting')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeDiscussionMeetingListingChapter($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('chapter', Session::get('gakkaiuserchapter'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeDistrictHVStats($query, $value)
    {
        $data = DB::table('Attendance_m_Attendance')->where('id', $value)->select('uniquecode', 
            DB::raw('hvmd as "MD", hvwd as "WD", hvymd as "YMD", hvywd as "YWD", hvmd + hvwd + hvymd + hvywd as "Total"'))->get();
        return $data;
    }

    public function scopeDMyear($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->select(DB::Raw('year(attendancedate) as year'))->groupBy(DB::raw('year(attendancedate)'))->orderBy(DB::raw('year(attendancedate)', 'DESC'));
    }

    public function scopeDMFullStatsListing($query, $value, $divisiontype)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->whereRaw('year(attendancedate) = ?', array($value))->select('rhq', DB::Raw('SUM(CASE WHEN month(attendancedate) = 1 THEN attendancetotal ELSE 0 END) as "jan"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 2 THEN attendancetotal ELSE 0 END) as "feb"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 3 THEN attendancetotal ELSE 0 END) as "mar"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 4 THEN attendancetotal ELSE 0 END) as "apr"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 5 THEN attendancetotal ELSE 0 END) as "may"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 6 THEN attendancetotal ELSE 0 END) as "jun"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 7 THEN attendancetotal ELSE 0 END) as "jul"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 8 THEN attendancetotal ELSE 0 END) as "aug"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 9 THEN attendancetotal ELSE 0 END) as "sep", SUM(CASE WHEN month(attendancedate) = 10 THEN attendancetotal ELSE 0 END) as "oct"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 11 THEN attendancetotal ELSE 0 END) as "nov"'), DB::Raw('SUM(CASE WHEN month(attendancedate) = 12 THEN attendancetotal ELSE 0 END) as "dec"'))->groupby('rhq');
    }

    public function scopeDMStatsListing($query, $value, $divisiontype)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'), DB::Raw('description as attdescription'));
    }

    public function scopeLPDMStatsListing($query, $value)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'shq' ) {
            return $query->where('attendancetype', 'Discussion Meeting')->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'rhq' ) {
            return $query->where('attendancetype', 'Discussion Meeting')->where('rhq', Session::get('gakkaiuserrhq'))->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone' ) {
            return $query->where('attendancetype', 'Discussion Meeting')->where('zone', Session::get('gakkaiuserzone'))->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'chapter' ) {
            return $query->where('attendancetype', 'Discussion Meeting')->where('chapter', Session::get('gakkaiuserchapter'))->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'district' ) {
            return $query->where('attendancetype', 'Discussion Meeting')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereRaw('year(attendancedate) = ?', array($value))->select(DB::Raw('year(attendancedate) as year'), DB::Raw('month(attendancedate) as month'), 'rhq', 'zone', 'chapter', 'district', 'attendancetotal', 'ldr', 'mem', 'bel', 'nf', 'pd', 'yc', 'srmd', 'srwd', 'srymd', 'srywd', 'ldrmd', 'ldrwd', 'ldrymd', 'ldrywd', 'memmd', 'memwd', 'memymd', 'memywd', 'mempdymd', 'mempdywd', 'memycymd', 'memycywd', 'belmd', 'belwd', 'belymd', 'belywd', 'belpdymd', 'belpdywd', 'belycymd', 'belycywd', 'nfmd', 'nfwd', 'nfymd', 'nfywd', 'nfpdymd', 'nfpdywd', 'nfycymd', 'nfycywd', DB::Raw('concat(chapter, " ", district) as description'));
        }
    }

    public function scopeDMMaxYear($query)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('attendancetype', 'Discussion Meeting')->select(DB::Raw('MAX(year(attendancedate)) as year'))->pluck('year');
        return $mid;
    }

    public function scopeDMNotSubmittedStats($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public function scopeRegionDMCurrentMonthStats($query)
    {
        return $query->whereYear('attendancedate', '=', date('Y'))->whereMonth('attendancedate', '=', date('m'))->where('status', 'Active')->where('attendancetype', 'Discussion Meeting')
            ->select('rhq', DB::raw('count(id) as "totalnoofdistrict", SUM(CASE WHEN attendancetotal > 5 THEN 1 ELSE 0 End) as "submitted", SUM(CASE WHEN attendancetotal <= 5 THEN 1 ELSE 0 End) as "notsubmitted", SUM(attendancetotal) as "currenttotalattendance", SUM(ldr) as "ldr", SUM(mem) as "mem", SUM(bel) as "bel", SUM(nf) as "nf"'))->groupby('rhq');
    }

    public function scopeRegionDMNotSubmittedStats($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public function scopeZoneDMCurrentMonthStats($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereYear('attendancedate', '=', date('Y'))->whereMonth('attendancedate', '=', date('m'))->where('status', 'Active')
            ->select('rhq', 'zone', DB::raw('count(id) as "totalnoofdistrict", SUM(CASE WHEN attendancetotal > 5 THEN 1 ELSE 0 End) as "submitted", SUM(CASE WHEN attendancetotal <= 5 THEN 1 ELSE 0 End) as "notsubmitted", SUM(attendancetotal) as "currenttotalattendance", SUM(ldr) as "ldr", SUM(mem) as "mem", SUM(bel) as "bel", SUM(nf) as "nf"'))->groupby('zone');
    }

    public function scopeZoneDMNotSubmittedStats($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('rhq', Session::get('gakkaiuserrhq'))->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public function scopeChapterDMCurrentMonthStats($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->where('zone', Session::get('gakkaiuserzone'))->whereYear('attendancedate', '=', date('Y'))->whereMonth('attendancedate', '=', date('m'))->where('status', 'Active')
            ->select('rhq', 'zone', 'chapter', DB::raw('count(id) as "totalnoofdistrict", SUM(CASE WHEN attendancetotal > 5 THEN 1 ELSE 0 End) as "submitted", SUM(CASE WHEN attendancetotal <= 5 THEN 1 ELSE 0 End) as "notsubmitted", SUM(attendancetotal) as "currenttotalattendance", SUM(ldr) as "ldr", SUM(mem) as "mem", SUM(bel) as "bel", SUM(nf) as "nf"'))->groupby('chapter');
    }

    public function scopeChapterDMNotSubmittedStats($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('rhq', Session::get('gakkaiuserrhq'))->where('zone', Session::get('gakkaiuserzone'))->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public function scopeDistrictDMCurrentMonthStats($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->where('zone', Session::get('gakkaiuserzone'))->where('chapter', Session::get('gakkaiuserchapter'))->whereYear('attendancedate', '=', date('Y'))->whereMonth('attendancedate', '=', date('m'))->where('status', 'Active')
            ->select('rhq', 'zone', 'chapter', 'district', DB::raw('count(id) as "totalnoofdistrict", SUM(CASE WHEN attendancetotal > 5 THEN 1 ELSE 0 End) as "submitted", SUM(CASE WHEN attendancetotal <= 5 THEN 1 ELSE 0 End) as "notsubmitted", SUM(attendancetotal) as "currenttotalattendance", SUM(ldr) as "ldr", SUM(mem) as "mem", SUM(bel) as "bel", SUM(nf) as "nf"'))->groupby('chapter')->groupby('district');
    }

    public function scopeDistrictDMNotSubmittedStats($query)
    {
        return $query->where('attendancetype', 'Discussion Meeting')->where('rhq', Session::get('gakkaiuserrhq'))->where('zone', Session::get('gakkaiuserzone'))->where('chapter', Session::get('gakkaiuserchapter'))->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public function scopeDistrictIndividualDMNotSubmittedStats($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->where('zone', Session::get('gakkaiuserzone'))->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('status', 'Active')->where('attendancetotal', '<=', 5);
    }

    public static function getbyevent($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('byevent');
        LogsfLogs::postLogs('Debug', 34, 0, ' - getbyevent - ' . $mid . ' - ' . $value, NULL, NULL, 'Failed');
        return $mid;
    }

    public static function getbyeventsession($value)
    {
        $mid = DB::table('Attendance_m_Attendance')->where('uniquecode', $value)->pluck('byeventsession');
        return $mid;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($post)
        {
            return $post->isValid(); 
        });

        static::updating(function($record)
        {
            try
            {
                $dirty = $record->getDirty();
                foreach ($dirty as $field => $newdata)
                {
                    $olddata = $record->getOriginal($field);
                    if ($olddata != $newdata)
                    {
                        if (Session::get('gakkaiuserboe') == true)
                        {
                            LogsfLogs::postLogs('Update', 28, $record->id, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - Attendance - ' . $field . ' - From: ' .  $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                            
                        }
                        else 
                        {
                            LogsfLogs::postLogs('Update', 28, $record->id, ' - Attendance - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        }
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 28, $record->id, ' - Attendance - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'description' => 'required|min:3'
            )
        )->passes();
    }
}
