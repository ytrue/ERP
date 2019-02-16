<?php

/**
 * @param object $value
 * @param string $ok_text
 * @param object $error_text
 * @return string
 */
function StorehouseUpdateStatus($value, $ok_text, $error_text)
{
    switch ($value) {
        case 2:
            return '<span class="label label-primary">' . $ok_text . '</span>';
        case 1:
            return '<span class="label label-danger">' . $error_text . '</span>';
    }
}

/**
 * @param object $url
 * @return array
 */
function getUrlKeyValue($url)
{
    $result = array();
    $mr = preg_match_all('/(\?|&)(.+?)=([^&?]*)/i', $url, $matchs);
    if ($mr !== false) {
        for ($i = 0; $i < $mr; $i++) {
            $result[$matchs[2][$i]] = $matchs[3][$i];
        }
    }
    return $result;
}

function judgeData($getData,Array $getArray)
{
    $newGetData = [];
    if (!empty($getData)) {
        foreach ($getData as $key => $value) {
            if (empty($value)) {
                switch ($key) {
                    case 'start_date':
                        $newGetData[$key]['where'] = '>=';
                        $newGetData[$key]['value'] = '1997-01-01';
                        break;
                    case 'end_date':
                        $newGetData[$key]['where'] = '<=';
                        $newGetData[$key]['value'] = '2100-01-01';
                        break;
                    default:
                        $newGetData[$key]['where'] = '!=';
                        $newGetData[$key]['value'] = '';
                        break;
                }
            } else {
                $newGetData[$key]['where'] = '=';
                $newGetData[$key]['value'] = $value;
            }
        }
    } else {
        $ary = [
            'start_date' => [
                'where' => '>=',
                'value' => '1997-01-01',
            ],
            'end_date' => [
                'where' => '!=',
                'value' => '2100-10-01',
            ]
        ];
        $newGetData = array_merge($ary, $getArray);
    }

    return $newGetData;
}

/**
 * 对二位数组去重
 */
function assoc_unique($arr, $key) {

    $tmp_arr = array();

    foreach ($arr as $k => $v) {

        if (in_array($v[$key], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true

            unset($arr[$k]);

        } else {

            $tmp_arr[] = $v[$key];

        }

    }

    sort($arr); //sort函数对数组进行排序

    return $arr;
}

function system_logs($message)
{
    \App\Models\Log::create([
        'user_id' => \Auth::id(),
        'message' => $message
    ]);
}
