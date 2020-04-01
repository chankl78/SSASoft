<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CampaignmDetail extends Eloquent {

	protected $table = 'Campaign_m_Detail';
    use SoftDeletingTrait;

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
            LogsfLogs::postLogs('Logout', 4, 0, ' Session Expired - Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - Signed Out -> Back to Login', NULL, NULL, 'Success');
            Auth::logout();
            Session::flush();
            return Redirect::action('LeadersPortalLoginController@getIndex');
        }
    }

    public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('created_at', 'Like', '%'.$sSearch.'%')
                ->orwhere('campaigndetaildate', 'Like', '%'.$sSearch.'%')
                ->orwhere('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%')
                ->orwhere('division', 'Like', '%'.$sSearch.'%')
                ->orwhere('position', 'Like', '%'.$sSearch.'%')
                ->orwhere('value', 'Like', '%'.$sSearch.'%')
                ->orwhere('remarks', 'Like', '%'.$sSearch.'%');
        });
    }

    public static function getid($value)
    {
        $mid = DB::table('Campaign_m_Detail')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public function scopeCampaign($query, $value)
    {
        return $query->where('campaignid', '=', CampaignmCampaign::getid($value));
    }

    public static function deleteAll($value)
    {
        CampaignmDetail::where('campaignid', $value)->delete();
        return true;
    }

    public static function getCampaignValueTotal($value, $value2)
    {
        if ($value2 == 'shq')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->selectRaw('sum(value) as value')->pluck('value');
            return $mid;
        }
        elseif ($value2 == 'rhq')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('rhq', Session::get('gakkaiuserrhq'))->selectRaw('sum(value) as value')->pluck('value');
            return $mid;
        }
        elseif ($value2 == 'zone')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('zone', Session::get('gakkaiuserzone'))->selectRaw('sum(value) as value')->pluck('value');
            return $mid;
        }
        elseif ($value2 == 'chapter')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('chapter', Session::get('gakkaiuserchapter'))->selectRaw('sum(value) as value')->pluck('value');
            return $mid;
        }
        elseif ($value2 == 'district')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->selectRaw('sum(value) as value')->pluck('value');
            return $mid;
        }
    }

    public static function getCampaignValueNotSubmmited($value, $value2)
    {
        if ($value2 == 'shq')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('value', 0)->count();
            return $mid;
        }
        elseif ($value2 == 'rhq')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('rhq', Session::get('gakkaiuserrhq'))->where('value', 0)->count();
            return $mid;
        }
        elseif ($value2 == 'zone')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('zone', Session::get('gakkaiuserzone'))->where('value', 0)->count();
            return $mid;
        }
        elseif ($value2 == 'chapter')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('chapter', Session::get('gakkaiuserchapter'))->where('value', 0)->count();
            return $mid;
        }
        elseif ($value2 == 'district')
        {
            $mid = DB::table('Campaign_m_Detail')->where('campaignid', $value)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('value', 0)->count();
            return $mid;
        }
    }

    // To be deleted after campaign
    public static function getBOEDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('value');
        return $mid;
    }

    public static function getBOEChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->where('chapter', Session::get('gakkaiuserchapter'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getBOEZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->where('zone', Session::get('gakkaiuserzone'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getBOERegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->where('rhq', Session::get('gakkaiuserrhq'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getBOESHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getBOEid()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 6)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('id');
        return $mid;
    }

    public static function getYouthSubmitDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('value');
        return $mid;
    }

    public static function getYouthSubmitChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->where('chapter', Session::get('gakkaiuserchapter'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getYouthSubmitZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->where('zone', Session::get('gakkaiuserzone'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getYouthSubmitRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->where('rhq', Session::get('gakkaiuserrhq'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getYouthSubmitSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getYouthSubmitid()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 7)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('id');
        return $mid;
    }

    public static function getDiscussionMeetingDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('value');
        return $mid;
    }

    public static function getDiscussionMeetingChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->where('chapter', Session::get('gakkaiuserchapter'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getDiscussionMeetingZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->where('zone', Session::get('gakkaiuserzone'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getDiscussionMeetingRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->where('rhq', Session::get('gakkaiuserrhq'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getDiscussionMeetingSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getDiscussionMeetingid()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 8)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('id');
        return $mid;
    }

    public static function getStudyExamDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('value');
        return $mid;
    }

    public static function getStudyExamChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->where('chapter', Session::get('gakkaiuserchapter'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getStudyExamZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->where('zone', Session::get('gakkaiuserzone'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getStudyExamRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->where('rhq', Session::get('gakkaiuserrhq'))->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getStudyExamSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getStudyExamid()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 9)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->pluck('id');
        return $mid;
    }

    public static function getMDDaimokuDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 11)->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getMDDaimokuChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 11)->where('chapter', Session::get('gakkaiuserchapter'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getMDDaimokuZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 11)->where('zone', Session::get('gakkaiuserzone'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getMDDaimokuRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 11)->where('rhq', Session::get('gakkaiuserrhq'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getMDDaimokuSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', 11)->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYWDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YW')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYWChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YW')->where('chapter', Session::get('gakkaiuserchapter'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYWZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YW')->where('zone', Session::get('gakkaiuserzone'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYWRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YW')->where('rhq', Session::get('gakkaiuserrhq'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYWSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YW')->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYMDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YM')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYMChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YM')->where('chapter', Session::get('gakkaiuserchapter'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYMZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YM')->where('zone', Session::get('gakkaiuserzone'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYMRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YM')->where('rhq', Session::get('gakkaiuserrhq'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitYMSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'YM')->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitWDDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'WD')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitWDChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where( 'campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'WD')->where('chapter', Session::get('gakkaiuserchapter'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitWDZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where( 'campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'WD')->where('zone', Session::get('gakkaiuserzone'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitWDRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where( 'campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'WD')->where('rhq', Session::get('gakkaiuserrhq'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitWDSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where( 'campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'WD')->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitMDDistrictValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'MD')->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitMDChapterValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'MD')->where('chapter', Session::get('gakkaiuserchapter'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitMDZoneValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'MD')->where('zone', Session::get('gakkaiuserzone'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitMDRegionValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'MD')->where('rhq', Session::get('gakkaiuserrhq'))->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    public static function getHomeVisitMDSHQValue()
    {
        $mid = DB::table('Campaign_m_Detail')->where('campaignid', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->where('division', 'MD')->where('deleted_at', NULL)->selectRaw('sum(value) as value')->pluck('value');
        return $mid;
    }

    // To be deleted after campaign from the top 

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
                        LogsfLogs::postLogs('Update', 69, $record->id, ' - Campaign Detail - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 69, $record->id, ' - Campaign Detail - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'campaignid' => 'required|min:1'
            )
        )->passes();
    }
}