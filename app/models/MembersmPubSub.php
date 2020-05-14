<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MembersmPubSub extends Eloquent {

	protected $table = 'Members_m_PubSub';

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
        else
        {
            return $query;
        }
    }

    public function scopePSyear($query)
    {
        return $query->where(DB::Raw('year(startdate)'), '>=', 2017)->where(DB::Raw('year(enddate)'), '<=', date('Y'))->select(DB::Raw('year(startdate) as year'))->groupBy(DB::raw('year(startdate)'))->orderBy(DB::raw('year(startdate)', 'DESC'));
    }

    public static function transfermmstopubsub()
    {
		try
		{
			DB::table('Members_m_PubSub')->truncate();

			// Get arrary from MMS
			$pdo = DB::connection("mysql2")->getPdo();
			$member = $pdo->query(DB::raw('SELECT sub.id, tit.code, sub.start_date, sub.end_date, sub.stop_date, sac.use_giro, sac.person_id, sub.no_of_copies, sub.no_of_months FROM subscription sub LEFT JOIN transaction sac on sub.transaction_id = sac.id LEFT JOIN publication pub on sub.publication_id = pub.id LEFT JOIN title tit on pub.title_id = tit.id WHERE sub.no_of_months <> 0 and sac.transaction_status_id = 1 ORDER BY sac.person_id, sub.id;'));
			// Insert into BOE
			foreach($member as $member)
			{
				$post = new MembersmPubSub;
				$post->personid = $member['person_id'];
                $post->mmssubid = $member['id'];
                $post->pubtype = $member['code'];
                $post->startdate = $member['start_date'];
                $post->enddate = $member['end_date'];
                $post->stopdate = $member['stop_date'];
                $post->usegiro = $member['use_giro'];
                $post->noofcopies = $member['no_of_copies'];
                $post->noofmonths = $member['no_of_months'];

				$post->save();
            }
            
            LogsfLogs::postLogs('Update', 39, 0, ' - MembersmPubSub Model - MMS to PUBSUB Success ', NULL, NULL, 'Success');

            DB::statement('UPDATE Members_m_PubSub ps LEFT JOIN Members_m_SSA mssa on ps.personid = mssa.personid
            SET ps.memberid = mssa.id;');

			LogsfLogs::postLogs('Update', 39, 0, ' - MembersmPubSub Model - Update MemberID Successful ', NULL, NULL, 'Success');
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - MembersmPubSub Model - MMS to PUBSUB Failed - ' . $member['id'] . ' ' . $e, NULL, NULL, 'Failed');
		}
    }  
    
    public static function updatezzmembers()
    {
		try
		{
            $tablename = "zz_" . date('Y') . "_Members";
            $currentyear = date('Y');

			DB::statement('CREATE TABLE zz_pub (
                SELECT mssa.id, mssa.personid, mssa.name, ps.pubtype, ps.noofmonths, ps.startdate, ps.enddate, 
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-01-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubcljan,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-02-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclfeb,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-03-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclmar,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-04-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclapr,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-05-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclmay,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-06-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubcljun,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-07-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubcljul,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-08-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclaug,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-09-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclsep,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-10-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubcloct,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-11-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubclnov,
                    CASE WHEN ps.pubtype = "cl" and CAST(CONCAT('. $currentyear . ', "-12-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubcldec
                FROM Members_m_PubSub ps LEFT JOIN Members_m_SSA mssa on ps.memberid = mssa.id
                WHERE (year(ps.startdate) = '. $currentyear . ' or year(ps.enddate) = '. $currentyear . ') and ps.pubtype = "cl"
                ORDER BY mssa.id, ps.pubtype, year(ps.startdate))');
            
            DB::statement('UPDATE ' . $tablename . ' m INNER JOIN 
            (SELECT id, personid, SUM(pubcljan) as pubcljan, SUM(pubclfeb) as pubclfeb, SUM(pubclmar) as pubclmar, SUM(pubclapr) as pubclapr, SUM(pubclmay) as pubclmay, SUM(pubcljun) as pubcljun, SUM(pubcljul) as pubcljul, SUM(pubclaug) as pubclaug, SUM(pubclsep) as pubclsep, SUM(pubcloct) as pubcloct, SUM(pubclnov) as pubclnov, SUM(pubcldec) as pubcldec FROM zz_pub GROUP BY id, personid) ps on m.id = ps.id
                SET m.pubcljan = ps.pubcljan, m.pubclfeb = ps.pubclfeb, m.pubclmar = ps.pubclmar, m.pubclapr = ps.pubclapr, m.pubclmay = ps.pubclmay, m.pubcljun = ps.pubcljun, m.pubcljul = ps.pubcljul, m.pubclaug = ps.pubclaug, m.pubclsep = ps.pubclsep, m.pubcloct = ps.pubcloct, m.pubclnov = ps.pubclnov, m.pubcldec = ps.pubcldec');

            DB::statement('SELECT Sleep (5);');
            DB::statement('DROP TABLE zz_Pub;');

            LogsfLogs::postLogs('Update', 39, 0, ' - MembersmPubSub Model - ' . $tablename . ' CL Updated!', NULL, NULL, 'Success');

            DB::statement('CREATE TABLE zz_pub (
                SELECT mssa.id, mssa.personid, mssa.name, ps.pubtype, ps.noofmonths, ps.startdate, ps.enddate, 
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-01-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstjan,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-02-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstfeb,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-03-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstmar,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-04-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstapr,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-05-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstmay,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-06-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstjun,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-07-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstjul,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-08-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstaug,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-09-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstsep,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-10-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstoct,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-11-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstnov,
                    CASE WHEN ps.pubtype = "st" and CAST(CONCAT('. $currentyear . ', "-12-01") AS DATE) BETWEEN ps.startdate AND ps.enddate THEN 1 ELSE 0 END as pubstdec
                FROM Members_m_PubSub ps LEFT JOIN Members_m_SSA mssa on ps.memberid = mssa.id
                WHERE (year(ps.startdate) = '. $currentyear . ' or year(ps.enddate) = '. $currentyear . ') and ps.pubtype = "st"
                ORDER BY mssa.id, ps.pubtype, year(ps.startdate))');

            DB::statement('UPDATE ' . $tablename . ' m INNER JOIN 
            (SELECT id, personid, SUM(pubstjan) as pubstjan, SUM(pubstfeb) as pubstfeb, SUM(pubstmar) as pubstmar, SUM(pubstapr) as pubstapr, SUM(pubstmay) as pubstmay, SUM(pubstjun) as pubstjun, SUM(pubstjul) as pubstjul, SUM(pubstaug) as pubstaug, SUM(pubstsep) as pubstsep, SUM(pubstoct) as pubstoct, SUM(pubstnov) as pubstnov, SUM(pubstdec) as pubstdec FROM zz_pub GROUP BY id, personid) ps on m.id = ps.id
                SET m.pubstjan = ps.pubstjan, m.pubstfeb = ps.pubstfeb, m.pubstmar = ps.pubstmar, m.pubstapr = ps.pubstapr, m.pubstmay = ps.pubstmay, m.pubstjun = ps.pubstjun, m.pubstjul = ps.pubstjul, m.pubstaug = ps.pubstaug, m.pubstsep = ps.pubstsep, m.pubstoct = ps.pubstoct, m.pubstnov = ps.pubstnov, m.pubstdec = ps.pubstdec');

            DB::statement('SELECT Sleep (5);');
            DB::statement('DROP TABLE zz_Pub;');

            LogsfLogs::postLogs('Update', 39, 0, ' - MembersmPubSub Model - ' . $tablename . ' ST Updated!', NULL, NULL, 'Success');
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - MembersmPubSub Model Update Failed - '  . $e, NULL, NULL, 'Failed');
		}
    }
}
