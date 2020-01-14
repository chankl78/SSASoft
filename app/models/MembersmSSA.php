<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MembersmSSA extends Eloquent {

	protected $table = 'Members_m_SSA';
    use SoftDeletingTrait;

    // Relationships
    public function GroupMember()
    {
        return $this->hasMany('GroupmMember', 'memberid');
    }
    
    public function EventRegistration()
    {
        return $this->hasMany('EventmRegistration', 'memberid');
    }

    public function Attendance()
    {
        return $this->hasMany('AttendancemPerson', 'memberid');
    }

	public function getNricAttribute($value){ return Crypt::decrypt($value); }
    public function setNricAttribute($value)
    {
        $this->attributes['nric'] = Crypt::encrypt($value);
        $this->attributes['nrichash'] = md5($value);
        $this->attributes['searchcode'] = substr($value, 1, 3);
    }

    public function getTelAttribute($value) { return Crypt::decrypt($value); }
    public function setTelAttribute($value) { $this->attributes['tel'] = Crypt::encrypt($value); }

    public function getMobileAttribute($value) { return Crypt::decrypt($value); }
    public function setMobileAttribute($value) { $this->attributes['mobile'] = Crypt::encrypt($value); }

    public function getEmailAttribute($value) { return Crypt::decrypt($value); }
    public function setEmailAttribute($value) { $this->attributes['email'] = Crypt::encrypt($value); }

    public function getAddressAttribute($value) { return Crypt::decrypt($value); }
    public function setAddressAttribute($value) { $this->attributes['address'] = Crypt::encrypt($value); }

    public function getBuildingnameAttribute($value) { return Crypt::decrypt($value); }
    public function setBuildingnameAttribute($value) { $this->attributes['buildingname'] = Crypt::encrypt($value); }

    public function getUnitnoAttribute($value) { return Crypt::decrypt($value); }
    public function setUnitnoAttribute($value) { $this->attributes['unitno'] = Crypt::encrypt($value); }

    public function getPostalcodeAttribute($value) { return Crypt::decrypt($value); }
    public function setPostalcodeAttribute($value) { $this->attributes['postalcode'] = Crypt::encrypt($value); }

    public function getEmergencytelAttribute($value) { return Crypt::decrypt($value); }
    public function setEmergencytelAttribute($value) { $this->attributes['emergencytel'] = Crypt::encrypt($value); }

    public function getEmergencymobileAttribute($value) { return Crypt::decrypt($value); }
    public function setEmergencymobileAttribute($value) { $this->attributes['emergencymobile'] = Crypt::encrypt($value); }

    public function getIntroducermobileAttribute($value) { return Crypt::decrypt($value); }
    public function setIntroducermobileAttribute($value) { $this->attributes['introducermobile'] = Crypt::encrypt($value); }

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
        else if (Auth::user()->roleid == 'Gakkai Administrator')
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
    
	public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('chinesename', 'Like', '%'.$sSearch.'%')
                ->orwhere('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%')
                ->orwhere('division', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%')
                ->orwhere('positionlevel', 'Like', '%'.$sSearch.'%')
                ->orwhere('alias', 'Like', '%'.$sSearch.'%')
                ->orwhere('email', 'Like', '%'.$sSearch.'%')
                ->orwhere('mobile', 'Like', '%'.$sSearch.'%')
                ->orwhere('tel', 'Like', '%'.$sSearch.'%')
                ->orwhere('dateofbirth', 'Like', '%'.$sSearch.'%')
                ->orwhere('address', 'Like', '%'.$sSearch.'%')
                ->orwhere('postalcode', 'Like', '%'.$sSearch.'%')
                ->orwhere('created_at', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeSearchMD($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%')
                ->orwhere('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%')
                ->orwhere('division', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeSearchCode($query, $sSearch)
    {
        return $query->where('searchcode', '=', $sSearch);
    }

    public function scopeEventType($query, $value)
    {
        if ($value == 'Youth Division') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') 
            {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') 
            {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'Adult Division') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'MD') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') 
            {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereIn('division', array('MD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') 
            {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereIn('division', array('MD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereIn('division', array('MD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereIn('division', array('MD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'WD') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereIn('division', array('WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereIn('division', array('WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereIn('division', array('WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereIn('division', array('WD'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'YM') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereIn('division', array('YM'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereIn('division', array('YM'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereIn('division', array('YM'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereIn('division', array('YM'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'YW') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereIn('division', array('YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereIn('division', array('YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereIn('division', array('YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereIn('division', array('YW'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        }
    }

    public static function getidbynrichash($value)
    {
        $mid = DB::table('Members_m_SSA')->where('pdpa', 0)->where('deleted_at', NULL)->where('nrichash', md5($value))->pluck('id');
        return $mid;
    }

    public static function getcheckuniquecode($value)
    {
        if(MembersmSSA::where('uniquecode', $value)->count() == 1) { return true; }
        else { return false; }
	}

	public static function getcheckmmsuuid($value)
    {
        if(MembersmSSA::where('mmsuuid', $value)->count() == 1) { return true; }
        else { return false; }
	}

    public static function getidbymmsuuid($value)
    {
        $mid = DB::table('Members_m_SSA')->where('deleted_at', NULL)->where('mmsuuid', $value)->pluck('id');
        return $mid;
    }

    public static function getidbynrichashboelogin($value)
    {
        $mid = DB::table('Members_m_SSA')->where('deleted_at', NULL)->where('nrichash', md5($value))->pluck('id');
        return $mid;
    }

    public static function getidbyemailhashboelogin($value)
    {
        $mid = DB::table('Members_m_SSA')->where('deleted_at', NULL)->where('emailhash', md5($value))->pluck('id');
        return $mid;
    }

    public static function getdob($value)
    {
        $mid = DB::table('Members_m_SSA')->where('deleted_at', NULL)->where('id', $value)->pluck(DB::raw('year(dateofbirth)'));
        return $mid;
    }

    public static function hasemailhashboelogin($value)
    {
        if (DB::table('Members_m_SSA')->where('emailhash', md5($value))->count() >= 1)
        { return true; }
        else { return false; }
    }

    public static function getid($value)
    {
        $leng = strlen(Input::get('memberid')) - 8 - 6;
        $mid = substr(substr(Input::get('memberid'), 8), 0, $leng);
        return $mid;
    }

    public static function getid1($value)
    {
        $mid = DB::table('Members_m_SSA')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getmemberid($value)
    {
        $mid = DB::table('Members_m_SSA')->where('id', $value)->pluck('id');
        return $mid;
    }

    public static function gettotaldistrictcount($value, $value1)
    {
        $mid = DB::table('Members_m_SSA')->where('chapter', $value)->where('district', $value1)->where('deleted_at', NULL)->count();
        return $mid;
    }

    public static function getIdByNric($nric)
    {
        $searchcode = substr($nric, 1, 3);
        $subset = MembersmSSA::SearchCode($searchcode)->get(array('id','nric'));
        
        $single = $subset->filter(function($subset) use ($nric)
        {
            if ($subset->nric == $nric) {
                return true;
            }
        });

        if ($single->first()) {
            return $single->first()->id;
        } else {
            return null;
        }
    }

    public static function getpersonid($value)
    {
        $mid = DB::table('Members_m_SSA')->where('uniquecode', $value)->pluck('personid');
        return $mid;
    }

    public static function getcheckpersonidexist($value)
    {
        if (DB::table('Members_m_SSA')->where('personid', $value)->where('deleted_at', NULL)->count() >= 1)
        {
            return true;
        }
        else { return false; }
    }

    public static function getIdByPersonID($value)
    {
        $mid = DB::table('Members_m_SSA')->where('personid', $value)->pluck('id');
        return $mid;
    }

    public function scopeDateofBirthSelect($query)
    {
        return $query->whereNotNull('dateofbirth')->whereYear('dateofbirth', '>', 1919)->select(DB::raw('year(dateofbirth) as year'))->groupby(DB::raw('year(dateofbirth)'))->orderby(DB::raw('year(dateofbirth)'), 'DESC');
    }

    public function scopeMADMembership($query, $value)
    {
        if ($value == 'Youth Division') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') 
            {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') 
            {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'Adult Division') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'MD') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') 
            {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('MD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') 
            {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('MD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('MD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } 
            else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') 
            {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('MD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'WD') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'YM') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YM'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YM'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YM'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YM'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else if ($value == 'YW') {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereIn('division', array('YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        } else {
            if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
                return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
                return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
                return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                    ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
        }
    }

    public function scopeMADEligibleMembership($query)
    {
        return $query->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
    }

    public function scopeMADGroupEligibleMembership($query, $value)
    {
        return $query->whereNotIn('Members_m_SSA.position', array('BEL', 'NF', ''))->where('Group_m_Member.groupid', GroupmGroup::getid($value))->leftJoin('Group_m_Member', 'Group_m_Member.memberid', '=', 'Members_m_SSA.id')
            ->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
            ->select(DB::raw('Group_m_Member.contactgroup, Group_m_Member.position, Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position as "orgposition", Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
    }

    public function scopeMADLPEligibleMembership($query)
    {
        if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Attendance_m_Person ap on mssa.id = ap.memberid LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid WHERE mssa.deleted_at IS NULL and aa.attendancetype = "M&D PreKenshu" and ap.deleted_at IS NULL GROUP BY mssa.id)')
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        }
    }

    public function scopeSSAMADListing($query)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'shq' ) {
            return $query->join('Event_m_SSAMADKenshu', 'Members_m_SSA.id', '=', 'Event_m_SSAMADKenshu.memberid')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode, Event_m_SSAMADKenshu.trainingdate, Event_m_SSAMADKenshu.language'))->orderby(DB::raw('Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position', 'Members_m_SSA.name'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'rhq' ) {
            return $query->where('Members_m_SSA.rhq', Session::get('gakkaiuserrhq'))->join('Event_m_SSAMADKenshu', 'Members_m_SSA.id', '=', 'Event_m_SSAMADKenshu.memberid')
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode, Event_m_SSAMADKenshu.trainingdate, Event_m_SSAMADKenshu.language'))->orderby(DB::raw('Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position', 'Members_m_SSA.name'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone' ) {
            return $query->where('Members_m_SSA.zone', Session::get('gakkaiuserzone'))->whereRaw('Members_m_SSA.id IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_SSAMADKenshu ap on mssa.id = ap.memberid)')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode, Event_m_SSAMADKenshu.trainingdate, Event_m_SSAMADKenshu.language'))->orderby(DB::raw('Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position', 'Members_m_SSA.name'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'chapter' ) {
            return $query->where('Members_m_SSA.chapter', Session::get('gakkaiuserchapter'))->whereRaw('Members_m_SSA.id IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_SSAMADKenshu ap on mssa.id = ap.memberid)')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode, Event_m_SSAMADKenshu.trainingdate, Event_m_SSAMADKenshu.language'))->orderby(DB::raw('Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position', 'Members_m_SSA.name'));
        } else if (Session::get('gakkaiuserpositionlevel') == 'district' ) {
            return $query->where('Members_m_SSA.chapter', Session::get('gakkaiuserchapter'))->where('Members_m_SSA.district', Session::get('gakkaiuserdistrict'))->whereRaw('Members_m_SSA.id IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_SSAMADKenshu ap on mssa.id = ap.memberid)')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode, Event_m_SSAMADKenshu.trainingdate, Event_m_SSAMADKenshu.language'))->orderby(DB::raw('Members_m_SSA.rhq', 'Members_m_SSA.zone', 'Members_m_SSA.chapter', 'Members_m_SSA.district', 'Members_m_SSA.division', 'Members_m_SSA.position', 'Members_m_SSA.name'));
        }
    }

    public function scopeSearchPreKenshuEligible($query, $sSearch)
    {
        return $query->where(function ($query) use ($sSearch) {
            $query->where('Members_m_SSA.name', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.position', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.rhq', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.zone', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.chapter', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.district', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.division', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.positionlevel', 'Like', '%' . $sSearch . '%')
                ->orwhere('Members_m_SSA.created_at', 'Like', '%' . $sSearch . '%');
            }
        );
    }

    public function scopeFDMembership($query)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'shq' ) {
            return $query->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 13')->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) <= 17')
                ->select(DB::raw('name, chinesename, rhq, zone, chapter, district, position, division, uniquecode, (Year(now()) - Year(dateofbirth)) as "age"'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'rhq' ) {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 13')->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) <= 17')
                ->select(DB::raw('name, chinesename, rhq, zone, chapter, district, position, division, uniquecode, (Year(now()) - Year(dateofbirth)) as "age"'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone' ) {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 13')->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) <= 17')
            ->select(DB::raw('name, chinesename, rhq, zone, chapter, district, position, division, uniquecode, (Year(now()) - Year(dateofbirth)) as "age"'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'chapter' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 13')->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) <= 17')
            ->select(DB::raw('name, chinesename, rhq, zone, chapter, district, position, division, uniquecode, (Year(now()) - Year(dateofbirth)) as "age"'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'district' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 13')->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) <= 17')
            ->select(DB::raw('name, chinesename, rhq, zone, chapter, district, position, division, uniquecode, (Year(now()) - Year(dateofbirth)) as "age"'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        }
    }

    public function scopeStudyExamEntrance($query)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'rhq') {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_Registration er on mssa.id = er.memberid LEFT JOIN Event_m_Event ee on ee.id = er.eventid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL and ee.eventtype IN ("Entrance Study Exam", "Elementary Study Exam") and er.studyexamstatus = "Passed" and er.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserrhq')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone') {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_Registration er on mssa.id = er.memberid LEFT JOIN Event_m_Event ee on ee.id = er.eventid WHERE mssa.zone = ? and mssa.deleted_at IS NULL and ee.eventtype IN ("Entrance Study Exam", "Elementary Study Exam") and er.studyexamstatus = "Passed" and er.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserzone')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if ( Session::get('gakkaiuserpositionlevel') == 'chapter') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_Registration er on mssa.id = er.memberid LEFT JOIN Event_m_Event ee on ee.id = er.eventid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL and ee.eventtype IN ("Entrance Study Exam", "Elementary Study Exam") and er.studyexamstatus = "Passed" and er.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if ( Session::get('gakkaiuserpositionlevel') == 'district') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa LEFT JOIN Event_m_Registration er on mssa.id = er.memberid LEFT JOIN Event_m_Event ee on ee.id = er.eventid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL and ee.eventtype IN ("Entrance Study Exam", "Elementary Study Exam") and er.studyexamstatus = "Passed" and er.deleted_at IS NULL GROUP BY mssa.id)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
    }

    public function scopeMADEligibleListing($query)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'rhq') {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa INNER JOIN Event_m_SSAMADKenshu er on mssa.id = er.memberid WHERE mssa.rhq = ? and mssa.deleted_at IS NULL)', array(Session::get('gakkaiuserrhq')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone') {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa INNER JOIN Event_m_SSAMADKenshu er on mssa.id = er.memberid WHERE mssa.zone = ? and mssa.deleted_at IS NULL)', array(Session::get('gakkaiuserzone')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if ( Session::get('gakkaiuserpositionlevel') == 'chapter') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa INNER JOIN Event_m_SSAMADKenshu er on mssa.id = er.memberid WHERE mssa.chapter = ? and mssa.deleted_at IS NULL)', array(Session::get('gakkaiuserchapter')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
        } else if ( Session::get('gakkaiuserpositionlevel') == 'district') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('position', array('BEL', 'NF', ''))->whereNotIn('division', array('PD', 'YC'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw( 'Members_m_SSA.id NOT IN (Select mssa.id FROM Members_m_SSA mssa INNER JOIN Event_m_SSAMADKenshu er on mssa.id = er.memberid WHERE mssa.chapter = ? and mssa.district = ? and mssa.deleted_at IS NULL)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
                ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq', 'zone', 'chapter', 'district', 'division', 'position', 'name');
            }
    }

    public function scopeBelieversShq($query)
    {
        return $query->where('position', 'BEL')
            ->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeBelieversRhq($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->where('position', 'BEL')
            ->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeBelieversZone($query)
    {
        return $query->where('zone', Session::get('gakkaiuserzone'))->where('position', 'BEL')
            ->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeBelieversChapter($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('position', 'BEL')
            ->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeBelieversDistrict($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('position', 'BEL')
            ->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeNewFriendsShq($query)
    {
        return $query->where('position', 'NF')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, 
                Members_m_SSA.uniquecode, Members_m_SSA.believersigned, Members_m_SSA.chanting, 
                (SELECT count(Attendance_m_Person.memberid) FROM Attendance_m_Person 
                    LEFT JOIN Attendance_m_Attendance on Attendance_m_Attendance.id = Attendance_m_Person.attendanceid 
                    WHERE Attendance_m_Person.memberid = Members_m_SSA.id and Attendance_m_Person.attendancestatus IN ("Attended") 
                    and Attendance_m_Attendance.attendancetype IN ("Discussion Meeting", "District Study Meeting") 
                    and Attendance_m_Person.deleted_at is null) as noofmtg'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeNewFriendsRhq($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->where('position', 'NF')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, 
                Members_m_SSA.uniquecode, Members_m_SSA.believersigned, Members_m_SSA.chanting, 
                (SELECT count(Attendance_m_Person.memberid) FROM Attendance_m_Person 
                    LEFT JOIN Attendance_m_Attendance on Attendance_m_Attendance.id = Attendance_m_Person.attendanceid 
                    WHERE Attendance_m_Person.memberid = Members_m_SSA.id and Attendance_m_Person.attendancestatus IN ("Attended") 
                    and Attendance_m_Attendance.attendancetype IN ("Discussion Meeting", "District Study Meeting") 
                    and Attendance_m_Person.deleted_at is null) as noofmtg'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeNewFriendsZone($query)
    {
        return $query->where('zone', Session::get('gakkaiuserzone'))->where('position', 'NF')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, 
                Members_m_SSA.uniquecode, Members_m_SSA.believersigned, Members_m_SSA.chanting, 
                (SELECT count(Attendance_m_Person.memberid) FROM Attendance_m_Person 
                    LEFT JOIN Attendance_m_Attendance on Attendance_m_Attendance.id = Attendance_m_Person.attendanceid 
                    WHERE Attendance_m_Person.memberid = Members_m_SSA.id and Attendance_m_Person.attendancestatus IN ("Attended") 
                    and Attendance_m_Attendance.attendancetype IN ("Discussion Meeting", "District Study Meeting") 
                    and Attendance_m_Person.deleted_at is null) as noofmtg'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeNewFriendsChapter($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('position', 'NF')
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, 
                Members_m_SSA.uniquecode, Members_m_SSA.believersigned, Members_m_SSA.chanting, 
                (SELECT count(Attendance_m_Person.memberid) FROM Attendance_m_Person 
                    LEFT JOIN Attendance_m_Attendance on Attendance_m_Attendance.id = Attendance_m_Person.attendanceid 
                    WHERE Attendance_m_Person.memberid = Members_m_SSA.id and Attendance_m_Person.attendancestatus IN ("Attended") 
                    and Attendance_m_Attendance.attendancetype IN ("Discussion Meeting", "District Study Meeting") 
                    and Attendance_m_Person.deleted_at is null) as noofmtg'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeNewFriendsDistrict($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))
            ->where('position', 'NF')->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, 
                Members_m_SSA.uniquecode, Members_m_SSA.believersigned, Members_m_SSA.chanting, 
                (SELECT count(Attendance_m_Person.memberid) FROM Attendance_m_Person 
                    LEFT JOIN Attendance_m_Attendance on Attendance_m_Attendance.id = Attendance_m_Person.attendanceid 
                    WHERE Attendance_m_Person.memberid = Members_m_SSA.id and Attendance_m_Person.attendancestatus IN ("Attended") 
                    and Attendance_m_Attendance.attendancetype IN ("Discussion Meeting", "District Study Meeting") 
                    and Attendance_m_Person.deleted_at is null) as noofmtg'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeFuneralServices($query)
    {
        return $query->where('division', 'MD')->wherein('position', array('S_1', 'S11', 'S_2', 'S_D1', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'S1', 'S2', 'S3', 'S32', 'S3A', 'S5', 'S_D1A', 'S1_D', 'S2N', 'H1', 'H2', 'H3', 'H5', 'Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C1V', 'C2', 'C2V', 'C3', 'C5'))->orderby('rhq','zone','chapter','district','division','position', 'name');
    }

    public function scopeLeadersShq($query)
    {
        return $query->wherein('position', array('S_1', 'S11', 'S_2', 'S_D1', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'S1', 'S2', 'S3', 'S32', 'S3A', 'S5', 'S_D1A', 'S1_D', 'S2N', 'H1', 'H2', 'H3', 'H5', 'Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeLeadersRhq($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->wherein('position', array('H1', 'H2', 'H3', 'H5', 'Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeLeadersZone($query)
    {
        return $query->where('zone', Session::get('gakkaiuserzone'))->wherein('position', array('Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeLeadersChapter($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->wherein('position', array('C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeLeadersDistrict($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->wherein('position', array('D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeMembersShq($query)
    {
        return $query->wherein('position', array('S_1', 'S11', 'S_2', 'S_D1', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'S1', 'S2', 'S3', 'S32', 'S3A', 'S5', 'S_D1A', 'S1_D', 'S2N', 'H1', 'H2', 'H3', 'H5', 'Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C2', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA', 'MEM', 'BEL', 'NF'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeMembersRhq($query)
    {
        return $query->where('rhq', Session::get('gakkaiuserrhq'))->wherein('position', array('H1', 'H2', 'H3', 'H5', 'Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C2', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA', 'MEM', 'BEL', 'NF'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeMembersZone($query)
    {
        return $query->where('zone', Session::get('gakkaiuserzone'))->wherein('position', array('Z1', 'Z2', 'Z3', 'Z5', 'C1', 'C2', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA', 'MEM', 'BEL', 'NF'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeMembersChapter($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->wherein('position', array('C1', 'C2', 'C3', 'C5', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA', 'MEM', 'BEL', 'NF'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeMembersDistrict($query)
    {
        return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->wherein('position', array('D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'DA', 'MEM', 'BEL', 'NF'))->orderby('rhq','zone','chapter','district','division','position');
    }

    public function scopeSHQStats($query)
    {
        return $query->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("rhq","zone","chapter","district", "group") THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") THEN 1 ELSE 0 End) as "NF", 
            SUM(CASE WHEN Members_z_Position.level IN ("rhq","zone","chapter","district", "group", "mem", "bel", "nf") THEN 1 ELSE 0 End) as "Total"'))
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Members_m_SSA.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Members_m_SSA.division = "MD" THEN 1 WHEN Members_m_SSA.division = "WD" THEN 2 
                WHEN Members_m_SSA.division = "YM" THEN 3 WHEN Members_m_SSA.division = "YW" THEN 4 
                WHEN Members_m_SSA.division = "PD" THEN 5 WHEN Members_m_SSA.division = "YC" THEN 6 END'));
    }

    public function scopeRHQStats($query, $value)
    {
        return $query->where('rhq', $value)->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("rhq","zone","chapter","district", "group") THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") THEN 1 ELSE 0 End) as "NF", 
            SUM(CASE WHEN Members_z_Position.level IN ("rhq","zone","chapter","district", "group", "mem", "bel", "nf") THEN 1 ELSE 0 End) as "Total"'))
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Members_m_SSA.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Members_m_SSA.division = "MD" THEN 1 WHEN Members_m_SSA.division = "WD" THEN 2 
                WHEN Members_m_SSA.division = "YM" THEN 3 WHEN Members_m_SSA.division = "YW" THEN 4 
                WHEN Members_m_SSA.division = "PD" THEN 5 WHEN Members_m_SSA.division = "YC" THEN 6 END'));
    }

    public function scopeZoneStats($query, $value)
    {
        return $query->where('zone', $value)->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("zone","chapter","district", "group") THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") THEN 1 ELSE 0 End) as "NF", 
            SUM(CASE WHEN Members_z_Position.level IN ("zone","chapter","district", "group", "mem", "bel", "nf") THEN 1 ELSE 0 End) as "Total"'))
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Members_m_SSA.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Members_m_SSA.division = "MD" THEN 1 WHEN Members_m_SSA.division = "WD" THEN 2 
                WHEN Members_m_SSA.division = "YM" THEN 3 WHEN Members_m_SSA.division = "YW" THEN 4 
                WHEN Members_m_SSA.division = "PD" THEN 5 WHEN Members_m_SSA.division = "YC" THEN 6 END'));
    }

    public function scopeChapterStats($query, $value)
    {
        return $query->where('chapter', $value)->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("chapter","district", "group") THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") THEN 1 ELSE 0 End) as "NF", 
            SUM(CASE WHEN Members_z_Position.level IN ("chapter","district", "group", "mem", "bel", "nf") THEN 1 ELSE 0 End) as "Total"'))
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Members_m_SSA.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Members_m_SSA.division = "MD" THEN 1 WHEN Members_m_SSA.division = "WD" THEN 2 
                WHEN Members_m_SSA.division = "YM" THEN 3 WHEN Members_m_SSA.division = "YW" THEN 4 
                WHEN Members_m_SSA.division = "PD" THEN 5 WHEN Members_m_SSA.division = "YC" THEN 6 END'));
    }

    public function scopeDistrictStats($query, $value, $value2)
    {
        return $query->where('chapter', $value)->where('district', $value2)->select('division', 
            DB::raw('SUM(CASE WHEN Members_z_Position.level IN ("district", "group") THEN 1 ELSE 0 End) as "LDR", 
            SUM(CASE WHEN Members_z_Position.level IN ("mem") THEN 1 ELSE 0 End) as "MEM", 
            SUM(CASE WHEN Members_z_Position.level IN ("bel") THEN 1 ELSE 0 End) as "BEL", 
            SUM(CASE WHEN Members_z_Position.level IN ("nf") THEN 1 ELSE 0 End) as "NF", 
            SUM(CASE WHEN Members_z_Position.level IN ("district", "group", "mem", "bel", "nf") THEN 1 ELSE 0 End) as "Total"'))
            ->leftJoin('Members_z_Position', 'Members_z_Position.code', '=', 'Members_m_SSA.position')
            ->groupBy('division')->orderby(DB::raw('CASE WHEN Members_m_SSA.division = "MD" THEN 1 WHEN Members_m_SSA.division = "WD" THEN 2 
                WHEN Members_m_SSA.division = "YM" THEN 3 WHEN Members_m_SSA.division = "YW" THEN 4 
                WHEN Members_m_SSA.division = "PD" THEN 5 WHEN Members_m_SSA.division = "YC" THEN 6 END'));
    }

    public static function scopeNationWideBOEPositionSummary($query)
    {
        return $query->whereNotNull('positionlevel')->select(DB::raw('positionlevel, COUNT(positionlevel) as total'))->groupby('positionlevel');
    }

    public static function scopeNationWideDistrictLeadersSummary($query)
    {
        return $query->whereNotNull('positionlevel')->whereNotIn('positionlevel', array('mem', 'nf', 'bel'))->whereNotNull('rhq')->whereNotIn('rhq', array('-', 'H0'))->whereNotIn('zone', array('-', ''))->whereNotIn('chapter', array('-', ''))->whereNotIn('district', array('-'))->select(DB::raw('rhq, zone, chapter, SUM(CASE WHEN positionlevel = "district"  THEN 1 ELSE 0 END) as total'))->groupby('rhq')->groupby('zone')->groupby('chapter');
    }

    // To delete after Youth Summit Event
    public function scopeYouthSummitYonsha($query)
    {
        if (Session::get('gakkaiuserposition') == 'S_1' or Session::get('gakkaiuserposition') == 'S11' or Session::get('gakkaiuserposition') == 'S_2' or Session::get('gakkaiuserposition') == 'S_D1' or Session::get('gakkaiuserposition') == 'S_D1H' or Session::get('gakkaiuserposition') == 'S_D2' or Session::get('gakkaiuserposition') == 'S_E1' or Session::get('gakkaiuserposition') == 'S_E2' or Session::get('gakkaiuserposition') == 'S1' or Session::get('gakkaiuserposition') == 'S2' or Session::get('gakkaiuserposition') == 'S3' or Session::get('gakkaiuserposition') == 'S32' or Session::get('gakkaiuserposition') == 'S3A' or Session::get('gakkaiuserposition') == 'S5' or Session::get('gakkaiuserposition') == 'S_D1A' or Session::get('gakkaiuserposition') == 'S_G')
        {
            return $query->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.rhq = ?)', array(Session::get('gakkaiuserrhq')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5')
        {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.rhq = ?)', array(Session::get('gakkaiuserrhq')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5')
        {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.zone = ?)', array(Session::get('gakkaiuserzone')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.chapter = ?)', array(Session::get('gakkaiuserchapter')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC', 'YM', 'YW'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.chapter = ? and Event_m_Registration.district = ?)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name'); 
        }
    }

    public function scopeYouthSummitYouth($query)
    {
        if (Session::get('gakkaiuserposition') == 'S_1' or Session::get('gakkaiuserposition') == 'S11' or Session::get('gakkaiuserposition') == 'S_2' or Session::get('gakkaiuserposition') == 'S_D1' or Session::get('gakkaiuserposition') == 'S_D1H' or Session::get('gakkaiuserposition') == 'S_D2' or Session::get('gakkaiuserposition') == 'S_E1' or Session::get('gakkaiuserposition') == 'S_E2' or Session::get('gakkaiuserposition') == 'S1' or Session::get('gakkaiuserposition') == 'S2' or Session::get('gakkaiuserposition') == 'S3' or Session::get('gakkaiuserposition') == 'S32' or Session::get('gakkaiuserposition') == 'S3A' or Session::get('gakkaiuserposition') == 'S5' or Session::get('gakkaiuserposition') == 'S_D1A' or Session::get('gakkaiuserposition') == 'S_G')
        {
            return $query->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.status = "Accepted" and Event_m_Registration.rhq = ?)', array(Session::get('gakkaiuserrhq')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5')
        {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.status = "Accepted" and Event_m_Registration.rhq = ?)', array(Session::get('gakkaiuserrhq')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5')
        {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.status = "Accepted" and Event_m_Registration.zone = ?)', array(Session::get('gakkaiuserzone')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.status = "Accepted" and Event_m_Registration.chapter = ?)', array(Session::get('gakkaiuserchapter')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name');
        }
        else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA')
        {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('division', array('PD', 'YC', 'MD', 'WD'))->whereRaw('TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) >= 16')->whereRaw('Members_m_SSA.id NOT IN (SELECT Event_m_Registration.memberid FROM Event_m_Registration WHERE Event_m_Registration.eventid = 126 and Event_m_Registration.deleted_at IS NULL and Event_m_Registration.status = "Accepted" and Event_m_Registration.chapter = ? and Event_m_Registration.district = ?)', array(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict')))
            ->select(DB::raw('Members_m_SSA.name, Members_m_SSA.chinesename, Members_m_SSA.rhq, 
                Members_m_SSA.zone, Members_m_SSA.chapter, Members_m_SSA.district, Members_m_SSA.position, Members_m_SSA.division, Members_m_SSA.uniquecode'))->orderby('rhq','zone','chapter','district','division','position','name'); 
        }
    }
}
