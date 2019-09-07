<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AttendancemPerson extends Eloquent {

	protected $table = 'Attendance_m_Person';
	use SoftDeletingTrait;

    // Relationships
    public function Member()
    {
        return $this->belongsTo('MembersmSSA', 'memberid');
    }

    public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid))
        {
            return $query;
        }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid))
        {
            return $query;
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'district')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'));
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'chapter')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'));
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'zone')
        {
            return $query->where('zone', Session::get('gakkaiuserzone'));
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'rhq')
        {
            return $query->where('rhq', Session::get('gakkaiuserrhq'));
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'shq')
        {
            return $query;
        }
        else
        {
            return $query;
        }    
    }

	public function scopeSearch($query, $sSearch, $sValue)
    {
        return $query->where(function($query) use ($sSearch, $sValue)
        {
            $query->where('attendanceid', '=', $sValue)
                ->where('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%')
                ->orwhere('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%')
                ->orwhere('division', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%')
                ->orwhere('attendancestatus', 'Like', '%'.$sSearch.'%')
                ->orwhere('created_at', 'Like', '%'.$sSearch.'%')
                ->orwhere('remarks', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeSearchPreKenshu($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('Attendance_m_Person.name', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.position', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.district', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.division', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.position', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.attendancestatus', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.created_at', 'Like', '%'.$sSearch.'%')
                ->orwhere('Attendance_m_Person.remarks', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeDetail($query, $value)
    {
        if (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User')
        {
            $value2 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('deleted_at', NULL)->groupBy('userid')->pluck('groupid');
            $value3 = DB::table('Event_m_Group')->where('groupid', $value2)->where('deleted_at', NULL)->pluck('name');
            return $query->where('attendanceid', $value);
        }
        else if (Auth::user()->roleid == 'Single Event Item User' or Auth::user()->roleid == 'Event Chief Trainer')
        {
            $value4 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('resourcecode', 'AT04')->where('deleted_at', NULL)->pluck('eventitem');
            return $query->where('attendanceid', $value);
        }
        else if (Auth::user()->roleid == 'Event Trainer')
        {
            $value4 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('resourcecode', 'EV07')->groupBy('userid')->pluck('eventitem');
            $value5 = DB::table('Access_m_Users')->where('id', Auth::user()->id)->pluck('memberid');
            $value6 = DB::table('Members_m_SSA')->where('id', $value5)->pluck('zone');

            return $query->where('attendanceid', $value)->where('zone', $value6);
        }
        else
        {
            return $query->where('attendanceid', '=', $value);
        }
    }

    public function scopeRHQStats($query, $value)
    {
        return $query->where('attendanceid', $value)->select('rhq', DB::raw( 'SUM(CASE WHEN division = "MD" THEN 1 End) as MD, 
            SUM(CASE WHEN division = "WD" THEN 1 End) as WD, SUM(CASE WHEN division = "YM" THEN 1 End) as YM, 
            SUM(CASE WHEN division = "YW" THEN 1 End) as YW, SUM(CASE WHEN division = "PD" THEN 1 End) as PD, 
            SUM(CASE WHEN division IS NULL THEN 1 WHEN division IN ("UN", "", "-") THEN 1 End) as UnKnown, Count(name) as Total, SUM(noofnewfriend) as NewFriend'))
            ->groupBy('rhq');
    }

    public function scopePositionStats($query, $value)
    {
        return $query->where('attendanceid', $value)->select('position', DB::raw( 'SUM(CASE WHEN division = "MD" THEN 1 End) as MD, 
            SUM(CASE WHEN division = "WD" THEN 1 End) as WD, SUM(CASE WHEN division = "YM" THEN 1 End) as YM, 
            SUM(CASE WHEN division = "YW" THEN 1 End) as YW, SUM(CASE WHEN division = "PD" THEN 1 End) as PD, 
            SUM(CASE WHEN division IS NULL THEN 1 WHEN division IN ("UN", "", "-") THEN 1 End) as UnKnown, Count(name) as Total, SUM(noofnewfriend) as NewFriend'))
            ->groupBy('position');
    }

    public function scopeDistrictADMAttendanceStats($query, $value)
    {
        $data = DB::table('Attendance_m_Attendance')->where('attendanceid', $value)->where('attendancestatus', 'Attended')->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("shq", "rhq", "zone", "chapter", "district", "group") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "NF", 
            (CASE WHEN Attendance_m_Person.division = "MD" THEN Attendance_m_Attendance.srmd
                WHEN Attendance_m_Person.division = "WD" THEN Attendance_m_Attendance.srwd
                WHEN Attendance_m_Person.division = "YM" THEN Attendance_m_Attendance.srymd
                WHEN Attendance_m_Person.division = "YW" THEN Attendance_m_Attendance.srywd ELSE 0 END) as "SRZC",
            SUM(CASE WHEN Members_z_Position.level IN ("shq", "rhq", "zone", "chapter", "district", "group", "mem", "bel", "nf") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) +
            (CASE WHEN Attendance_m_Person.division = "MD" THEN Attendance_m_Attendance.srmd
                WHEN Attendance_m_Person.division = "WD" THEN Attendance_m_Attendance.srwd
                WHEN Attendance_m_Person.division = "YM" THEN Attendance_m_Attendance.srymd
                WHEN Attendance_m_Person.division = "YW" THEN Attendance_m_Attendance.srywd ELSE 0 END) as "Total"'))
            ->leftJoin('Attendance_m_Person', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Attendance_m_Person.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Attendance_m_Person.division = "MD" THEN 1 WHEN Attendance_m_Person.division = "WD" THEN 2 
                WHEN Attendance_m_Person.division = "YM" THEN 3 WHEN Attendance_m_Person.division = "YW" THEN 4 
                WHEN Attendance_m_Person.division = "PD" THEN 5 WHEN Attendance_m_Person.division = "YC" THEN 6 END'))->get();
        return $data;
    }

    public function scopeMembersAttendanceInEvent($query, $value)
    {
        return $query->where('memberid', $value)->where('attendancestatus', 'Attended')->select('attendancedate', 'description', 'remarks')
            ->leftJoin('Attendance_m_Attendance', 'Attendance_m_Person.attendanceid', '=', 'Attendance_m_Attendance.id')->groupBy('attendancedate', 'description');
    }

    public function scopePreKenshu($query)
    {
         return $query->where('attendancetype', "M&D PreKenshu")->select('Attendance_m_Attendance.event', 'Attendance_m_Attendance.description', 'Attendance_m_Attendance.attendancedate', 'Attendance_m_Person.*')
            ->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid');
    }

    public function scopeBOEPreKenshu($query) // With the latest current Organisation Info
    {
         return $query->where('attendancetype', "M&D PreKenshu")->select('Attendance_m_Attendance.event', 'Attendance_m_Attendance.description', 'Attendance_m_Attendance.attendancedate', 'Members_m_SSA.name', 'Members_m_SSA.chinesename', 'Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position')
            ->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->leftJoin('Members_m_SSA', 'Attendance_m_Person.memberid', '=', 'Members_m_SSA.id');
    }

    public static function getid($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getattendanceid($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('uniquecode', $value)->pluck('attendanceid');
        return $mid;
    }

    public static function getattendanceuniquecode($value)
    {
        $attendanceid = DB::table('Attendance_m_Person')->where('uniquecode', $value)->pluck('attendanceid');
        $mid = DB::table('Attendance_m_Attendance')->where('id', $attendanceid)->pluck('uniquecode');
        return $mid;
    }

    public static function getmemberid($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('uniquecode', $value)->pluck('memberid');
        return $mid;
    }

    public static function gettotalattendancecount($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getidattendance($value, $value1)
    {
        $mid = DB::table('Attendance_m_Person')->where('uniquecode', $value)->where('name', $value1)->pluck('id');
        return $mid;
    }

    public static function geteventregid($value, $value2)
    {
        if (DB::table('Event_m_Registration')->where('memberid', $value)->where('eventid', $value2)->where('deleted_at', NULL)->count() == 1)
        {
        	$mid = DB::table('Event_m_Registration')->where('memberid', $value)->where('eventid', $value2)->where('deleted_at', NULL)->pluck('id');
        }
        else $mid = 0;
        return $mid;
    }

    public static function getEventAttendanceDuplicate($value, $value2, $value3)
    {
        if ($value3 == 0)
        {
            if (DB::table('Attendance_m_Person')->where('attendanceid', $value2)->where('memberid', $value)->where('deleted_at', NULL)->count() == 1)
            {
                return true;
            }
            else { return false; }
        }
        else
        {
            if (DB::table('Attendance_m_Person')->where('attendanceid', $value2)->where('eventregid', $value3)->where('deleted_at', NULL)->count() == 1)
            {
                return true;
            }
            else { return false; }
        }
    }

    public static function getEventAttendanceregidDuplicate($value, $value2)
    {
        if (DB::table('Attendance_m_Person')->where('attendanceid', $value2)->where('eventregid', $value)->where('deleted_at', NULL)->count() == 1)
        {
            return true;
        }
        else { return false; }
    }

    public static function getAttendancePersonDuplicate($value, $value2)
    {
        if (DB::table('Attendance_m_Person')->where('attendanceid', $value2)->where('memberid', $value)->where('deleted_at', NULL)->count() == 1)
        {
            return true;
        }
        else { return false; }
    }

    public static function getAttendancePersonMD($value)
    {
        $person = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'MD')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srmd');
        $mid =  $person;
        return $mid;
    }

    public static function getAttendancePersonWD($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'WD')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srwd');
        return $mid;
    }

    public static function getAttendancePersonYMD($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'YM')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srymd');
        return $mid;
    }

    public static function getAttendancePersonYWD($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'YW')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srywd');
        return $mid;
    }

    public static function getAttendancePersonPD($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'PD')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getAttendancePersonYC($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('division', 'YC')->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getAttendancePersonTotal($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srmd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srwd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srymd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srywd');
        return $mid;
    }

    public static function getAttendancePersonLDR($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->whereIN('position', array('D1', 'D2', 'D1V', 'D2V', 'DA', 'D3', 'D5'))->where('attendancestatus', 'Attended')->where('deleted_at', NULL)->count() + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srmd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srwd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srymd') + DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('srywd');
        return $mid;
    }

    public static function getAttendancePersonMEM($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('attendancestatus', 'Attended')->where('position', 'MEM')->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getAttendancePersonBEL($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('attendancestatus', 'Attended')->where('position', 'BEL')->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getAttendancePersonNF($value)
    {
        $mid = DB::table('Attendance_m_Person')->where('attendanceid', $value)->where('attendancestatus', 'Attended')->where('position', 'NF')->where('deleted_at', NULL)->count();
        return $mid;
    }

    public function scopeSHQEventTrainingStats($query, $value)
    {
        return $query->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->where('Attendance_m_Person.eventid', $value)->where('Attendance_m_Person.attendancestatus', 'Attended')
            ->select(DB::raw('Attendance_m_Person.memberid, Attendance_m_Person.name, Attendance_m_Person.rhq, Attendance_m_Person.zone, Attendance_m_Person.chapter, Attendance_m_Person.district, Attendance_m_Person.division, Attendance_m_Person.position, 
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-05-19") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg1",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-02") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg2",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-09") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg3",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-16") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg4",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-30") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg5",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-07") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg6",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-14") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg7",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-21") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg8",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-27") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg9",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-08-04") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg10",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate NOT IN ("2018-04-25") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "grandtotal"'))
            ->groupBy('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name')
            ->orderby('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name');
    }

    public function scopeRHQEventTrainingStats($query, $value)
    {
        return $query->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->where('Attendance_m_Person.eventid', $value)->where('Attendance_m_Person.rhq', Session::get('gakkaiuserrhq'))->where('Attendance_m_Person.attendancestatus', 'Attended')
            ->select(DB::raw('Attendance_m_Person.memberid, Attendance_m_Person.name, Attendance_m_Person.rhq, Attendance_m_Person.zone, Attendance_m_Person.chapter, Attendance_m_Person.district, Attendance_m_Person.division, Attendance_m_Person.position, 
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-05-19") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg1",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-02") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg2",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-09") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg3",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-16") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg4",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-30") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg5",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-07") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg6",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-14") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg7",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-21") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg8",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-27") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg9",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-08-04") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg10",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate NOT IN ("2018-04-25") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "grandtotal"'))
            ->groupBy('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name')
            ->orderby('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name');
    }

    public function scopeZoneEventTrainingStats($query, $value)
    {
        return $query->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->where('Attendance_m_Person.eventid', $value)->where('Attendance_m_Person.zone', Session::get('gakkaiuserzone'))->where('Attendance_m_Person.attendancestatus', 'Attended')
            ->select(DB::raw('Attendance_m_Person.memberid, Attendance_m_Person.name, Attendance_m_Person.rhq, Attendance_m_Person.zone, Attendance_m_Person.chapter, Attendance_m_Person.district, Attendance_m_Person.division, Attendance_m_Person.position, 
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-05-19") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg1",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-02") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg2",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-09") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg3",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-16") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg4",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-30") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg5",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-07") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg6",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-14") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg7",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-21") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg8",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-27") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg9",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-08-04") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg10",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate NOT IN ("2018-04-25") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "grandtotal"'))
            ->groupBy('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name')
            ->orderby('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name');
    }

    public function scopeChapterEventTrainingStats($query, $value)
    {
        return $query->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->where('Attendance_m_Person.eventid', $value)->where('Attendance_m_Person.chapter', Session::get('gakkaiuserchapter'))->where('Attendance_m_Person.attendancestatus', 'Attended')
            ->select(DB::raw('Attendance_m_Person.memberid, Attendance_m_Person.name, Attendance_m_Person.rhq, Attendance_m_Person.zone, Attendance_m_Person.chapter, Attendance_m_Person.district, Attendance_m_Person.division, Attendance_m_Person.position, 
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-05-19") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg1",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-02") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg2",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-09") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg3",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-16") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg4",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-30") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg5",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-07") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg6",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-14") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg7",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-21") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg8",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-27") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg9",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-08-04") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg10",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate NOT IN ("2018-04-25") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "grandtotal"'))
            ->groupBy('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name')
            ->orderby('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name');
    }

    public function scopeDistrictEventTrainingStats($query, $value)
    {
        return $query->leftJoin('Attendance_m_Attendance', 'Attendance_m_Attendance.id', '=', 'Attendance_m_Person.attendanceid')
            ->where('Attendance_m_Person.eventid', $value)->where('Attendance_m_Person.chapter', Session::get('gakkaiuserchapter'))->where('Attendance_m_Person.district', Session::get('gakkaiuserdistrict'))->where('Attendance_m_Person.attendancestatus', 'Attended')
            ->select(DB::raw('Attendance_m_Person.memberid, Attendance_m_Person.name, Attendance_m_Person.rhq, Attendance_m_Person.zone, Attendance_m_Person.chapter, Attendance_m_Person.district, Attendance_m_Person.division, Attendance_m_Person.position, 
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-05-19") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg1",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-02") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg2",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-09") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg3",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-16") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg4",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-06-30") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg5",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-07") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg6",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-14") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg7",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-21") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg8",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-07-27") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg9",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate IN ("2018-08-04") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "trg10",
            SUM(CASE WHEN Attendance_m_Attendance.attendancedate NOT IN ("2018-04-25") and Attendance_m_Person.attendancestatus IN ("attended") and Attendance_m_Person.deleted_at IS NULL THEN 1 ELSE 0 End) as "grandtotal"'))
            ->groupBy('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name')
            ->orderby('Attendance_m_Person.rhq', 'Attendance_m_Person.zone', 'Attendance_m_Person.chapter', 'Attendance_m_Person.district', 'Attendance_m_Person.division', 'Attendance_m_Person.position', 'Attendance_m_Person.name');
    }

    public static function deleteAllAttendee($value)
    {
        DB::table('Attendance_m_Person')->where('attendanceid', '=', $value)->delete();
        return true;
    }

    public static function boot()
    {
        parent::boot();

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
                        try 
                        {
                            if (Session::get('gakkaiuserboe') == true)
                            {
                                LogsfLogs::postLogs('Update', 34, $record->id, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - Attendance - Attendee Detail - ' . $field . ' - From: ' .  $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                            }
                            else 
                            {
                                LogsfLogs::postLogs('Update', 34, $record->id, ' - Attendance - Attendee Detail - ' . $field . ' - From: ' .  $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                            }
                        }
                        catch(\Exception $e)
                        {
                            LogsfLogs::postLogs('Update', 34, $record->id, ' - Attendance - Attendee Detail - ' . $field . ' - From: ' .  $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        }
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 34, $record->id, ' - Attendance - Attendee Detail  - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }
}