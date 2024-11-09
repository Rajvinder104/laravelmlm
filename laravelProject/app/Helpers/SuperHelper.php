<?php

use App\Models\Super_model;

/************************* formatDate ******************************* */
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M, Y');
    }
}


/************************* flashdata ******************************* */
if (!function_exists('flashdata')) {
    function flashdata($path, $message_name, $message, $status, $id = '')
    {
        if ($id != '') {
            return redirect()->route($path, ['id' => $id])->with($message_name, $message)->with('type', $status);
        } else {
            return redirect()->route($path)->with($message_name, $message)->with('type', $status);
        }
    }
}


/************************* get_sum ******************************* */
if (!function_exists('get_sum')) {
    function get_sum($table, $where, $select)
    {
        $user_model = new Super_model();
        return $user_model->get_sum($table, $where, $select);
    }
}


/************************* update_directs ******************************* */
if (!function_exists('update_directs')) {
    function update_directs($user_id)
    {
        $user_model = new Super_model();
        return $user_model->update_directs($user_id);
    }
}


/************************* redirect ******************************* */
if (!function_exists('redirect')) {
    function redirect($path)
    {
        return redirect()->route($path);
    }
}


/************************* get_single_record ******************************* */
if (!function_exists('get_single_record')) {
    function get_single_record($table, $where, $select)
    {
        $user_model = new Super_model();
        return $user_model->get_single_record($table, $where, $select);
    }
}


/************************* add ******************************* */
if (!function_exists('add')) {
    function add($table, $select)
    {
        $user_model = new Super_model();
        return $user_model->add($table, $select);
    }
}


/************************* deleteRecord ******************************* */
if (!function_exists('deleteRecord')) {
    function deleteRecord($table, $where)
    {
        $user_model = new Super_model();
        return $user_model->deleteRecord($table, $where);
    }
}


/************************* update_data ******************************* */
if (!function_exists('update_data')) {
    function update_data($table, $where, $data)
    {
        $user_model = new Super_model();
        return $user_model->update_data($table, $where, $data);
    }
}


/************************* get_records ******************************* */
if (!function_exists('get_records')) {
    function get_records($table, $where, $select)
    {
        $user_model = new Super_model();
        return $user_model->get_records($table, $where, $select);
    }
}


/************************* get_limit_records ******************************* */
if (!function_exists('get_limit_records')) {
    function get_limit_records($table, $where, $select, $perpage)
    {
        $user_model = new Super_model();
        return $user_model->get_limit_records($table, $where, $select, $perpage);
    }
}


/************************* userinfo ******************************* */
if (!function_exists('userinfo')) {
    function userinfo()
    {
        $user_model = new Super_model();
        return $user_model->get_single_object('users', ['user_id' => session('user_id')], '*');
    }
}


/************************* bankinfo ******************************* */
if (!function_exists('bankinfo')) {
    function bankinfo()
    {
        $user_model = new Super_model();
        return $user_model->get_single_object('bank_detail', ['user_id' => session('user_id')], '*');
    }
}


/************************* span_success ******************************* */
if (!function_exists('span_success')) {
    function span_success($message)
    {
        return '<div class="alert alert-icon alert-success" role="alert">
       <i class="fa fa-check-circle me-2" aria-hidden="true"></i>' . $message . '

    </div>';
    }
}


/************************* span_danger ******************************* */
if (!function_exists('span_danger')) {

    function span_danger($message)
    {
        return '<div class="alert alert-icon alert-danger" role="alert">
       <i class="fa fa-frown-o me-2" aria-hidden="true"></i>' . $message . '
        </div>';
        return '<div class="alert alert-danger" role="alert"> </div>';
    }
}


/************************* span_info ******************************* */
if (!function_exists('span_info')) {

    function span_info($message)
    {
        return '<div class="alert alert-icon alert-info" role="alert">
               <i class="fa fa-bell-o me-2" aria-hidden="true"></i> ' . $message . '</div>';
    }
}


/************************* span_danger_simple ******************************* */
if (!function_exists('span_danger_simple')) {
    function span_danger_simple($message)
    {
        return '<span class="text-danger"> ' . $message . ' </span>';
    }
}


/************************* span_info_simple ******************************* */
if (!function_exists('span_info_simple')) {
    function span_info_simple($message)
    {
        return '<span class="text-info"> ' . $message . ' </span>';
    }
}


/************************* badge_success ******************************* */
if (!function_exists('badge_success')) {
    function badge_success($message)
    {
        return '<span class="badge bg-success btn-xs"> ' . $message . ' </span>';
    }
}


/************************* badge_danger ******************************* */
if (!function_exists('badge_danger')) {
    function badge_danger($message)
    {
        return '<span class="badge bg-danger btn-xs"> ' . $message . ' </span>';
    }
}

/************************* badge_info ******************************* */
if (!function_exists('badge_info')) {
    function badge_info($message)
    {
        return '<span class="badge bg-info btn-xs"> ' . $message . ' </span>';
    }
}

/************************* badge_warning ******************************* */
if (!function_exists('badge_warning')) {
    function badge_warning($message)
    {
        return '<span class="badge bg-warning btn-xs"> ' . $message . ' </span>';
    }
}

/************************* reHash ******************************* */
if (!function_exists('reHash')) {
    function rehash($password, $hash)
    {
        $algorithm = PASSWORD_BCRYPT;
        $options = ['cost' => 12];
        if (password_verify($password, $hash)) {
            if (password_needs_rehash($hash, $algorithm, $options)) {
                $newHash = password_hash($password, $algorithm, $options);
                return $newHash;
            }
        }
    }
}


/************************* finalExport ******************************* */
if (!function_exists('finalExport')) {
    function finalExport($export, $application_type, $header, $records, $fileheader)
    {
        if ($export) {
            $filename = $fileheader . time() . '.' . $export;
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: " . $application_type . "; charset=UTF-8");
            $file = fopen('php://output', 'w');
            fputcsv($file, $header);
            foreach ($records as $key => $line) {
                fputcsv($file, $line);
            }
            fclose($file);
            exit();
        }
    }

    /************************* calculate_income ******************************* */
    if (!function_exists('calculate_income')) {
        function calculate_income($incomeArr, $incomes)
        {
            $income_count = array();
            $total_payout = 0;
            foreach ($incomes as $key => $income) {
                $income_count[$key] = 0;
            }
            foreach ($incomeArr as $arr) {
                if (isset($arr->type)) {
                    $income_type = $arr->type;
                    if (array_key_exists($income_type, $income_count)) {
                        $income_count[$income_type] = $arr->sum;
                        $total_payout += $arr->sum; // Add to the total payout
                    }
                }
            }
            $income_count['total_payout'] = $total_payout;
            return $income_count;
        }
    }
}
