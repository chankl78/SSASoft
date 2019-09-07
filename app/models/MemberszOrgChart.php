<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MemberszOrgChart extends Eloquent {

	protected $table = 'Members_z_OrgChart';
    use SoftDeletingTrait;

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

    public function getZoneChapterAttribute()
    {
        return $this->attributes['zone'] . ' - ' . $this->attributes['chapter'];
    }

}
