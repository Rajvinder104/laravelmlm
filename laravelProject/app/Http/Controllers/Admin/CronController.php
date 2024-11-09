<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super_model;

class CronController extends Controller
{

    /***************************************************** __construct ******************************************************/
    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }
    public function roiCron()
    {
        if (date('D') == 'Sun' || date('D') == 'Sat') {
            die('its weekend');
        }
        $date = date('Y-m-d');
        $cron = get_single_record('tbl_cron', ['created_at' => $date, 'cron_name' => 'roiCron'], '*');
        if (empty($cron)) {
            // add('tbl_cron', ['cron_name' => 'roiCron', 'created_at' => $date]);
            // $users = get_single_record('users', array(), '*');
            // $CheckPacksgesponsor = json_decode($users['incomes'], true);
            // dd($CheckPacksgesponsor);
            // if ($CheckPacksgesponsor['roi_income'] == 0) {
            $roi_users = get_records('tbl_roi', array(['days', '>', 0], 'status' => 0), '*');
            foreach ($roi_users as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s', strtotime($user->creditDate . '+ 0 days'));
                $diff = strtotime($date1) - strtotime($date2);

                if ($diff >= 0) {
                    $userinfo =   get_single_record('users', ['user_id' => $user->user_id], '*');
                    $roi_amount = $user->roi_amount;
                    $new_day = $user->days - 1;
                    $days = ($user->total_days + 1) - $user->days;
                    $incomeArr = [
                        'user_id' => $user->user_id,
                        'amount' => $roi_amount,
                        'type' => 'roi_income',
                        'remark' => 'Daily ' . $user->type . ' Income ' . $days . ' Days ',
                    ];
                    add('tbl_income_wallet', $incomeArr);
                    update_data('tbl_roi', ['id' => $user->id], ['days' => $new_day, 'amount' => ($user->amount - $user->roi_amount), 'creditDate' => date('Y-m-d')]);
                }
            }
            // }
        } else {
            echo 'Today cron already run';
        }
    }
    public function rewardCron()
    {
        $rewards = ConfigArray('reward');
        foreach ($rewards as $key => $reward) {
            $users = $this->supermodel->getBusiness($reward['business']);

            foreach ($users as $key1 => $user) {
                $check = get_single_record('tbl_rewards', ['award_id' => $key, 'user_id' => $user->user_id], '*');
                // dd($check);
                // die;
                if (empty($check)) {
                    $rewardData = [
                        'user_id' => $user->user_id,
                        'amount' => $reward['Reward'],
                        'rank' => $reward['Rank'],
                        'award_id' => $key,
                    ];
                    add('tbl_rewards', $rewardData);

                    $IncomeData = [
                        'user_id' => $user->user_id,
                        'amount' => $reward['Reward'],
                        'type' => 'reward_income',
                        'description' => 'You have Achieved your ' . $key . ' Reward Income ',
                    ];
                    add('tbl_reward_wallet', $IncomeData);
                    update_data('users', ['user_id' =>  $user->user_id], ['rewardLevel' => $key]);
                }
            }
        }
    }
}
