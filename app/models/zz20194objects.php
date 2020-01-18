<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class zz20194objects extends Eloquent {

	protected $table = 'zz_2019_4objects';

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
        else if (Session::get('gakkaiuserpositionlevel') == 'shq')
        {
            return $query->where('shqregistration', '1');
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'rhq')
        {
            return $query->where('regionregistration', '1');
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'zone')
        {
            return $query->where('zoneregistration', '1');
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'chapter')
        {
            return $query->where('chapterregistration', '1');
        }
        else if (Session::get('gakkaiuserpositionlevel') == 'district')
        {
            return $query->where('districtregistration', '1');
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
            $query->where('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%')
                ->orwhere('dm', 'Like', '%'.$sSearch.'%')
                ->orwhere('studyexam', 'Like', '%'.$sSearch.'%')
                ->orwhere('boe', 'Like', '%'.$sSearch.'%')
                ->orwhere('ys', 'Like', '%'.$sSearch.'%')
                ->orwhere('4goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('3goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('2goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('1goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('0goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('1goal', 'Like', '%'.$sSearch.'%')
                ->orwhere('dmtarget', 'Like', '%'.$sSearch.'%')
                ->orwhere('dmactual', 'Like', '%'.$sSearch.'%')
                ->orwhere('setarget', 'Like', '%'.$sSearch.'%')
                ->orwhere('seactual', 'Like', '%'.$sSearch.'%')
                ->orwhere('boetarget', 'Like', '%'.$sSearch.'%')
                ->orwhere('boeactual', 'Like', '%'.$sSearch.'%')
                ->orwhere('ystarget', 'Like', '%'.$sSearch.'%')
                ->orwhere('ysactual', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeFourObjectives2019($query)
    {
        if (Session::get('gakkaiuserposition') == 'H1' or Session::get('gakkaiuserposition') == 'H2' or Session::get('gakkaiuserposition') == 'H3' or Session::get('gakkaiuserposition') == 'H5') {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))
                ->orderby('rhq', 'zone', 'chapter', 'district');
        } else if (Session::get('gakkaiuserposition') == 'Z1' or Session::get('gakkaiuserposition') == 'Z2' or Session::get('gakkaiuserposition') == 'Z3' or Session::get('gakkaiuserposition') == 'Z5') {
            return $query->where('zone', Session::get('gakkaiuserzone'))
                ->orderby('rhq', 'zone', 'chapter', 'district');
        } else if (Session::get('gakkaiuserposition') == 'C1' or Session::get('gakkaiuserposition') == 'C1V' or Session::get('gakkaiuserposition') == 'C2' or Session::get('gakkaiuserposition') == 'C2V' or Session::get('gakkaiuserposition') == 'C3' or Session::get('gakkaiuserposition') == 'C5') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))
                ->orderby('rhq', 'zone', 'chapter', 'district');
        } else if (Session::get('gakkaiuserposition') == 'D1' or Session::get('gakkaiuserposition') == 'D1V' or Session::get('gakkaiuserposition') == 'D2' or Session::get('gakkaiuserposition') == 'D2V' or Session::get('gakkaiuserposition') == 'D3' or Session::get('gakkaiuserposition') == 'D5' or Session::get('gakkaiuserposition') == 'DA') {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))
                ->orderby('rhq', 'zone', 'chapter', 'district');
        }
    }
}
