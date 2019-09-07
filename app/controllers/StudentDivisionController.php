<?php

class StudentDivisionController extends BaseController
{
    protected $layout = 'studentdivision.layout';
	public $restful = true;
    private $groupid;
    private $groupname;
    private $eventid;
    private $eventname;
    private $attendanceid;

    public function __construct()
    {
        $this->groupname = 'Student Division';
        $this->groupid = GroupmGroup::getidbyname($this->groupname);
        $this->eventname = 'Student Division Kenshu 2017';
        $this->eventid = EventmEvent::getdescid($this->eventname);
        $this->attendanceid = AttendancemAttendance::where('eventid',$this->eventid)->first()->id;
    }

	public function getMembers()
	{
		$division = Input::get('division');
        $institution = Input::get('institution');
        
        $query = GroupmMember::where('groupid',$this->groupid);
        if ($division) {
            $query->where('division',$division);
        }
        if ($institution) {
            $query->where('contactgroup',$institution);
        }

        $members = $query->select('memberid','division','contactgroup','position')
            ->with(array('Member'=>function($q){
            $q->select('id','name','dateofbirth');
        }))->with(array('EventRegistration'=>function($q){
            $q->where('eventid',$this->eventid)->select('memberid');
        }))->with(array('Attendance'=>function($q){
            $q->where('attendanceid',$this->attendanceid)->select('memberid','remarks');
        }))->get();

        $membersAsArray = [];
        foreach ($members as $m) {
            
            // Calculate registration and paid
            if (count($m->event_registration) == 0) {
                $registered = 'No';
            } else {
                $registered = 'Yes';
            }

            // Calculate attendance
            if (count($m->attendance) == 0) {
                $attended = 'No';
                $paid = 'NOT PAID';
            } else {
                $attended = 'Yes';
                $paid = $m->attendance[0]->remarks;
            }

            // Calculate age
            $yearofbirth = date('Y',strtotime($m->member->dateofbirth));
            $age = date('Y') - $yearofbirth;
            
            $memberAsArray = [
                $m->member->name,
                $age,
                $m->division,
                $m->contactgroup,
                $m->position,
                $registered,
                $attended,
                $paid
            ];

            array_push($membersAsArray, $memberAsArray);
        }

        return Response::json(array('data'=>$membersAsArray), 200);
	}

    public function postAddSdMember()
    {
        $institution = Input::get('institution');
        $position = Input::get('sdPosition');
        $memberid = Input::get('memberid');
        
        $m = MembersmSSA::find($memberid)->toArray();

        $p = new GroupmMember;
        $p->memberid = $memberid;
        $p->groupid = $this->groupid;
        $p->groupname = $this->groupname;
        $p->contactgroup = GroupzContactGroup::find($institution)->value;
        $p->position = GroupzPosition::find($position)->value;
        $p->uniquecode = uniqid(TRUE);

        $p->name = $m['name'];
        $p->personid = $m['personid'];
        $p->rhq = $m['rhq'];
        $p->zone = $m['zone'];
        $p->chapter = $m['chapter'];
        $p->district = $m['district'];
        $p->positionorg = $m['position'];
        $p->division = $m['division'];
        $p->enrolleddate = date('Y-m-d');
        
        $p->discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($m['chapter'], $m['district']);
        if (is_null($p->discussionmeetingday)) {
            $p->discussionmeetingday = 'NA';
        }
        try {
            $p->save();
            $r = Response::json([],200);
        } catch (Exception $e) {
            $r = Response::json(['error' => $e->getMessage()],500);
        }

        return $r;
    }

    public function postAddMemberToSdKenshu()
    {
        $kenshuovernight = Input::get('kenshuovernight');
        $memberid = Input::get('memberid');
        
        $m = MembersmSSA::find($memberid)->toArray();
        $g = GroupmMember::Group($this->groupid)->where('memberid', $memberid)->first()->toArray();

        $p = new EventmRegistration;
        $p->eventname = $this->eventname;
        $p->eventid = $this->eventid;
        $p->memberid = $memberid;
        $p->uniquecode = uniqid(TRUE);
        $p->personid = $m['personid'];
        $p->ssagroup = $this->groupname;
        $p->ssagroupid = $this->groupid;
        $p->ssagroupcontact = $g['contactgroup'];
        
        $p->name = $m['name'];
        $p->chinesename = $m['chinesename'];
        $p->gender = $m['gender'];
        $p->rhq = $m['rhq'];
        $p->zone = $m['zone'];
        $p->chapter = $m['chapter'];
        $p->district = $m['district'];
        $p->position = $m['position'];
        $p->division = $m['division'];
        $p->nric = $m['nric'];
        $p->dateofbirth = $m['dateofbirth'];
        $p->email = $m['email'];
        $p->tel = $m['tel'];
        $p->mobile = $m['mobile'];
        $p->introducermobile = 'NULL';
        $p->kenshuovernight = $kenshuovernight;
        
        $p->discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($m['chapter'], $m['district']);
        $p->role = 'Participant';
        
        try {
            $p->save();
            $r = Response::json([],200);
        } catch (Exception $e) {
            $r = Response::json(['error' => $e->getMessage()],500);
        }

        return $r;
    }

    public function postCheckNric()
    {
        $nric = Input::get('nric');
        $m = MembersmSSA::getidbynrichash($nric);
        if ($m == null) {
            return Response::json(['memberid' => null], 500);
        }
        
        $m = MembersmSSA::find($m);
        // Check existing attendance
        $attendance = $m->Attendance()->where('attendanceid',$this->attendanceid)->first();
        // Check SD membership
        $sdmembership = $m->GroupMember()->Group($this->groupid)->first();
        // Check Kenshu Registration
        $kenshuregistration = $m->EventRegistration()->where('eventid',$this->eventid)->first();
        // Check paid details
        if ($attendance) {
            $kenshupaid = $attendance->remarks;
        } else {
            $kenshupaid = 'NOT PAID';
        }

        if ($attendance != null) {
            $response = Response::json('Already taken attendance for kenshu!', 200);
        } else {
            $response = Response::json([
                'memberid' => $m->id,
                'name' => $m->name,
                'sdmembership' => ($sdmembership == null) ? 0 : 1,
                'kenshuregistration' => ($kenshuregistration == null) ? 0 : $kenshuregistration->id,
                'kenshupaid' => ($kenshupaid == 'PAID') ? 1 : 0,
            ], 500);
        }

        return $response;
    }

    public function postAddAttendance()
    {
        $memberid = Input::get('memberid');
        $paid = Input::get('kenshupaid');
        $eventregid = Input::get('eventregid');

        $m = MembersmSSA::find($memberid);
        $attendance = new AttendancemPerson;
        $attendance->uniquecode = uniqid(true);
        $attendance->attendanceid = $this->attendanceid;
        $attendance->eventid = $this->eventid;
        $attendance->memberid = $memberid;
        $attendance->name = $m->name;
        $attendance->division = $m->division;
        $attendance->eventregid = $eventregid;
        $attendance->attendancestatus = 'Attended';

        if ($paid) {
            $attendance->remarks = 'PAID';
        } else {
            $attendance->remarks = 'NOT PAID';
        }

        try {
            $attendance->save();
            $r = Response::json([],200);
        } catch (Exception $e) {
            $r = Response::json(['error' => $e->getMessage()],500);
        }

        return $r;
    }

    public function getAttendanceList()
    {
        $attendanceCollection = AttendancemPerson::where('attendanceid', $this->attendanceid)
            ->orderBy('created_at', 'desc')
            ->get();

        // Format for JSON
        $attendanceAsArray = [];
        foreach ($attendanceCollection as $a) {
            
            $singleAttendance = [
                $a->name,
                $a->division,
                $a->remarks
            ];

            array_push($attendanceAsArray, $singleAttendance);
        }

        return Response::json(array('data'=>$attendanceAsArray), 200);
    }

    public function postSearchSsaMembers()
    {
		$query = Input::get('query');
		$columns = array(
			'id',
			'name',
			'rhq',
			'zone',
			'chapter',
			'district',
			'position',
			'division',
			'nric',
			'tel',
			'mobile'
			);
		
		$results = MembersmSSA::Search($query)->select($columns)->take(6)->get()->toArray();
		
		# Redact personal information
		foreach ($results as $i => $v) {
			$results[$i]['nric'] = substr_replace($v['nric'],'XXXX',1,4);
			$results[$i]['tel'] = substr_replace($v['tel'],'XXXXX',0,5);
			$results[$i]['mobile'] = substr_replace($v['mobile'],'XXXXX',0,5);
            $member = MembersmSSA::find($v['id']);

            // Get the group membership
            $results[$i]['sd'] = $member->GroupMember()
                ->where('groupid',$this->groupid)
                ->select(array('contactgroup','position'))
                ->get()
                ->toJson();
            
            $paid = $member->Attendance()->where('attendanceid', $this->attendanceid)->pluck('remarks');
            $overnight = $member->EventRegistration()->where('eventid',$this->eventid)->pluck('kenshuovernight');
            $results[$i]['kenshu'] = json_encode(['kenshuovernight' => $overnight, 'kenshupaid' => $paid]);
		}
		
		return Response::json($results, 200);
    }

    public function getStatistics()
    {
        $division = Input::get('division');

        // Total GroupmMembers
        $totalMembers = GroupmMember::Group($this->groupid)
            ->select('contactgroup','division', DB::raw('count(*) as total'))
            ->groupBy('contactgroup')
            ->groupBy('division')
            ->get()->toArray();
            
        $totalRegistered = GroupmMember::Group($this->groupid)
            ->whereHas('EventRegistration', function($q){
                $q->where('eventid',$this->eventid);
            })
            ->select('contactgroup','division', DB::raw('count(*) as total'))
            ->groupBy('contactgroup')
            ->groupBy('division')
            ->get()->toArray();

        $totalAttendees = GroupmMember::Group($this->groupid)
            ->where('division',$division)
            ->whereHas('Attendance', function($q){
                $q->where('attendanceid',$this->attendanceid);
            })
            ->select('contactgroup', DB::raw('count(*) as total'))
            ->groupBy('contactgroup')
            ->get()->toArray();
        
        $returnArray = [];
        foreach ($totalAttendees as $line) {
            array_push($returnArray,[$line['contactgroup'],$line['total']]);
        }

        return Response::json(['data' => $returnArray], 200);
    }

    public function getDashboard()
    {
        $this->layout->content = View::make('studentdivision.dashboard');
    }

    public function getMemberIndex()
    {
        // Get SD Institutions and Positions
		$sd_inst_options = GroupzContactGroup::GroupName('Student Division')->lists('value','id');
		$sd_pos_options = GroupzPosition::GroupName('Student Division')->lists('value','id');

        $this->layout->content = View::make('studentdivision.members')
            ->with("sd_inst_options", $sd_inst_options)
		    ->with("sd_pos_options", $sd_pos_options);
    }

    public function getKenshuIndex()
    {
		$this->layout->content = View::make('studentdivision.kenshu');
    }

    public function getStatisticsIndex()
    {
		$this->layout->content = View::make('studentdivision.statistics');
    }
}