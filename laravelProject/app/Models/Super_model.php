<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Super_model extends Model
{
    /************************* get_records ******************************* */
    public function get_records($table, $where, $select)
    {
        $query = DB::table($table)
            ->select(DB::raw($select))
            ->where($where)
            ->get()->toArray();
        return $query ? (array)$query : [];
    }

    /************************* get_limit_records ******************************* */

    public function get_limit_records($table, $where, $select, $perpage)
    {
        $query = DB::table($table)
            ->select($select)
            ->where($where)
            ->paginate($perpage);
        return $query;
    }


    /************************* get_single_record ******************************* */
    public function get_single_record($table, $where, $select, $checkDate = false)
    {
        $query = DB::table($table)
            ->select(DB::raw($select))
            ->where($where);
        if ($checkDate == true) {
            $query->whereDate('created_at', '=', date('Y-m-d'));
        }
        $result = $query->first();
        return $result ? (array) $result : null;
    }


    /************************* add ******************************* */
    public function add($table, $data)
    {
        $query = DB::table($table)
            ->insert($data);
        return $query;
    }


    /************************* update_data ******************************* */
    public function update_data($table, array $where, array $data)
    {
        $query = DB::table($table)
            ->where($where)
            ->update($data);
        return $query;
    }


    /************************* deleteRecord ******************************* */
    public function deleteRecord($table, $where)
    {
        $query = DB::table($table)
            ->delete($where);
        return $query;
    }


    /************************* get_single_object ******************************* */
    public function get_single_object($table, $where, $select)
    {
        $query = DB::table($table)
            ->select(DB::raw($select))
            ->where($where)
            ->get()
            ->first();
        return $query ? (array) $query : null;
    }


    /************************* get_sum ******************************* */
    public function get_sum($table, $where, $select)
    {
        $query = DB::table($table)
            ->select(DB::raw("IFNULL($select, 0) as total"));
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (strpos($key, 'DATE(') !== false) {
                    $query->whereRaw("$key = ?", [$value]);
                } else {
                    $query->where($key, $value);
                }
            }
        } else {
            $query->whereRaw($where);
        }
        $result = $query->first();
        return $result ? $result->total : 0;
    }


    /************************* update_count ******************************* */
    public function update_count($position, $user_id)
    {
        $query = DB::table('binary_users')
            ->where('user_id', '=', $user_id)
            ->update([$position => DB::raw($position . ' + 1')]);
        return $query;
    }


    /************************* update_directs ******************************* */
    public function update_directs($user_id)
    {
        $query = DB::table('users')
            ->where('user_id', '=', $user_id)
            ->update(['directs' => DB::raw('directs + 1')]);
        return $query;
    }


    /************************* totalTeam ******************************* */
    public function totalTeam($userId, $status)
    {
        $result = DB::table('users')
            ->leftJoin('sponsor_count', 'users.user_id', '=', 'sponsor_count.downline')
            ->where('sponsor_count.user_id', $userId)
            ->where('users.paid_status', $status)
            ->groupBy('users.paid_status')
            ->selectRaw('COUNT(sponsor_count.downline) as team, users.paid_status')
            ->first();
        return $result ? $result : (object) ['team' => 0];
    }


    /************************* getBusiness ******************************* */
    public function getBusiness($business)
    {
        $result = DB::table('sponsor_count')
            ->leftJoin('users', 'sponsor_count.downline', '=', 'users.user_id')
            ->select(DB::raw('IFNULL(SUM(package_amount), 0) as teamBusiness'), 'sponsor_count.user_id')
            ->groupBy('sponsor_count.user_id')
            ->havingRaw('teamBusiness >= ?', [$business])
            ->where('sponsor_count.user_id', '!=', 'none')
            ->get();

        return $result;
    }

    /************************* calculateTeamLevel ******************************* */
    public function calculateTeamLevel($userId, $status, $level)
    {
        $result = DB::table('users')
            ->leftJoin('sponsor_count', 'users.user_id', '=', 'sponsor_count.downline')
            ->where('sponsor_count.user_id', $userId)
            ->where('users.paid_status', $status)
            ->where('sponsor_count.level', $level)
            ->groupBy('users.paid_status')
            ->selectRaw('COUNT(sponsor_count.downline) as team, users.paid_status')
            ->first();
        return $result ? $result : (object) ['team' => 0];
    }

    /************************* grouped_by_level ******************************* */
    public function grouped_by_level($table, $where, $perpage)
    {
        $query = DB::table($table)
            ->select('level', DB::raw('count(id) as total'))
            ->where($where)
            ->groupBy('level')
            ->paginate($perpage);

        return $query;
    }

    /************************* grouped_by_date ******************************* */
    public function grouped_by_date($table, $where, $perpage)
    {

        $query = DB::table($table)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as total'))
            ->where($where)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->paginate($perpage);

        return $query;
    }

    /************************* get_incomes ******************************* */
    public function get_incomes($table, $checkDate)
    {
        $query = DB::table($table)
            ->select('type', DB::raw('ifnull(sum(amount), 0) as sum'))
            ->groupBy('type')
            ->whereDate('created_at', '=', $checkDate);

        $result = $query->get();
        return $result->toArray();
    }
}
