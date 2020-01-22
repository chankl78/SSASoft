<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class zz2018members extends Eloquent {

	protected $table = 'zz_2018_Members';

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

    public function scopeMembers($query)
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

    public function scopeRHQStats($query, $value, $divisiontype)
    {
        if ( $divisiontype == 'All' or $divisiontype == "4 Division")
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'MD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'MD')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'WD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'WD')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'YMD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YM')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'YWD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YW')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'Primary Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '07 to 12')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'Future Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '13 to 16')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'Student Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('studentdivision', '!=', '')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'Adult Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('MD', 'WD'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
        elseif ( $divisiontype == 'Youth Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('YM', 'YW'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
    }

    public function scopeRHQAgeGroupStats($query, $value, $divisiontype)
    {
        if ( $divisiontype == 'All' or $divisiontype == "4 Division")
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'MD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'MD')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'WD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'WD')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'YMD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YM')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'YWD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YW')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'Primary Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '07 to 12')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'Future Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '13 to 16')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'Student Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('studentdivision', '!=', '')->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'Adult Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('MD', 'WD'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
        elseif ( $divisiontype == 'Youth Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('YM', 'YW'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
    }

    public function scopeNameList($query, $value, $divisiontype)
    {
        if ( $divisiontype == 'All' or $divisiontype == "4 Division")
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'MD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'MD')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'WD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'WD')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'YMD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YM')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'YWD')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('division', 'YW')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'Primary Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '07 to 12')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'Future Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('agegroup', '13 to 16')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'Student Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->where('studentdivision', '!=', '')->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'Adult Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('MD', 'WD'))->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
        elseif ( $divisiontype == 'Youth Division')
        {
            return $query->whereIn('rhq', array('H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9'))->whereIn('division', array('YM', 'YW'))->whereNotIn('district', array("-"))->select('name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('name');
        }
    }

    public function scopeLPRHQAgeGroupStats($query, $value)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'shq' ) {
            return $query->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        } else if (Session::get('gakkaiuserpositionlevel') == 'rhq' ) {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone' ) {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        } else if (Session::get('gakkaiuserpositionlevel') == 'chapter' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        } else if (Session::get('gakkaiuserpositionlevel') == 'district' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', 'agegroup', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district')->groupby('agegroup');
        }
    }

    public function scopeLPRHQStats($query, $value)
    {
        if (Session::get('gakkaiuserpositionlevel') == 'shq' ) {
            return $query->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        } else if (Session::get('gakkaiuserpositionlevel') == 'rhq' ) {
            return $query->where('rhq', Session::get('gakkaiuserrhq'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        } else if (Session::get('gakkaiuserpositionlevel') == 'zone' ) {
            return $query->where('zone', Session::get('gakkaiuserzone'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        } else if (Session::get('gakkaiuserpositionlevel') == 'chapter' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        } else if (Session::get('gakkaiuserpositionlevel') == 'district' ) {
            return $query->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->whereNotIn('district', array("-"))->select('rhq', 'zone', 'chapter', 'district', DB::Raw('SUM(dmjan) as "jan"'), DB::Raw('SUM(dmfeb) as "feb"'), DB::Raw('SUM(dmmar) as "mar"'), DB::Raw('SUM(dmapr) as "apr"'), DB::Raw('SUM(dmmay) as "may"'), DB::Raw('SUM(dmjun) as "jun"'), DB::Raw('SUM(dmjul) as "jul"'), DB::Raw('SUM(dmaug) as "aug"'), DB::Raw('SUM(dmsep) as "sep", SUM(dmoct) as "oct"'), DB::Raw('SUM(dmnov) as "nov"'), DB::Raw('SUM(dmdec) as "dec"'), DB::Raw('concat(chapter, " ", district) as description'))->groupby('rhq')->groupby('zone')->groupby('chapter')->groupby('district');
        }
    }
}
