<?php

class MemberszOrgChart extends Eloquent {

	protected $table = 'Members_z_OrgChart';

	public function scopeRhq($query)
    {
        return $query->groupBy('rhq')->orderBy('rhq');
    }

    public function scopeZone($query)
    {
        return $query->groupBy('zone')->orderBy('zone');
    }

    public function scopeChapter($query)
    {
        return $query->groupBy('chapter')->orderBy('chapter');
    }

    public static function getDiscussionMtgDay($value, $value2)
    {
        $mid = DB::table('Members_z_OrgChart')->where('chapabbv', $value)->where('district', $value2)->pluck('day');
        return $mid;
    }

    public static function getPostalSector($chapter, $district)
    {
        $mid = DB::table('Members_z_OrgChart')->where('chapabbv', $chapter)->where('district', $district)->pluck('postalsector');
        return $mid;
    }

    public static function getPostalDistrict($chapter, $district)
    {
        $mid = DB::table('Members_z_OrgChart')->where('chapabbv', $chapter)->where('district', $district)->pluck('postaldistrict');
        return $mid;
    }

    public function getZoneChapterAttribute()
    {
        return $this->attributes['zone'] . ' - ' . $this->attributes['chapter'];
    }

    public static function scopeNationwideOrgChartTotal($query)
    {
        return $query->whereNotIn("id", array(1,2))->select(DB::raw('COUNT(DISTINCT rhqabbv) as rhq, COUNT(DISTINCT zoneabbv) as zone, COUNT(DISTINCT chapabbv) as chapter, COUNT(district) as district'));
    }

    public static function scopeNationwideOrgChartByRHQTotal($query)
    {
        return $query->whereNotIn("id", array(1,2))->select(DB::raw('rhqabbv, COUNT(DISTINCT zoneabbv) as zone, COUNT(DISTINCT chapabbv) as chapter, COUNT(district) as district'))->groupby('rhqabbv');
    }
}
