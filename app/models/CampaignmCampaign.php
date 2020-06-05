<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CampaignmCampaign extends Eloquent {

	protected $table = 'Campaign_m_Campaign';
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
                ->orwhere('leveltype', 'Like', '%'.$sSearch.'%')
                ->orwhere('divisiontype', 'Like', '%'.$sSearch.'%')
                ->orwhere('campaigntype', 'Like', '%'.$sSearch.'%')
                ->orwhere('description', 'Like', '%'.$sSearch.'%')
                ->orwhere('eventname', 'Like', '%'.$sSearch.'%')
                ->orwhere('description', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%');
        });
    }

    public static function getid($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getdescription($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('description');
        return $mid;
    }

    public static function getcampaigntype($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('campaigntype');
        return $mid;
    }

    public static function getcampaignlevel($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('leveltype');
        return $mid;
    }

    public static function geteventid($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('eventid');
        return $mid;
    }

    public static function getreadonly($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('uniquecode', $value)->pluck('readonly');
        return $mid;
    }

    public static function getleadersportalcampaignaccess($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('id', CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home')))->pluck($value);
        return $mid;
    }

    public static function getleadersportalcampaignpositionlevelaccess($value)
    {
        $mid = DB::table('Campaign_m_Campaign')->where('id', 12)->pluck($value);
        return $mid;
    }

    public static function getFindDuplicateValue($value)
    {
        if (CampaignmCampaign::where('description', '=', $value)->count() >= 1) { return true; } else { return false; }
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
                        LogsfLogs::postLogs('Update', 68, $record->id, ' - Campaign - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 68, $record->id, ' - Campaign - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
