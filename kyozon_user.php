<?php
function my_user_meta($fields) {
    //項目の追加
    $fields['last_kana'] = 'カナ(姓)';
    $fields['first_kana'] = 'カナ(名)';
    $fields['tel'] = '電話番号';
    $fields['company_name'] = '会社名';
    $fields['job_type'] = '業種';
    $fields['employee_scale'] = '従業員規模';
    $fields['department'] = '部署';
    $fields['position'] = '役職';
    unset($fields['aim']);//AIMを削除
    unset($fields['yim']);//Yahoo IMを削除
    unset($fields['jabber']);//Jabber・Google Talkを削除

    return $fields;
}

add_filter('user_contactmethods', 'my_user_meta', 10, 1);