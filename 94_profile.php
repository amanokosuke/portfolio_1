<?php
/**
 * Template Name: 会員情報登録画面
 * Template Post Type: page
 */
function select_option($selectedValue, $value) {
    $selected = "";
    if (strcmp($value, $selectedValue) == 0) {
        $selected = "selected";
    }
    echo "<option value='" . $value . "' " . $selected . ">" . $value . "</option>";
}

$email = "";
$key = "";
$has_error = false;

$first_name = "";
$last_name = "";
$first_kana = "";
$last_kana = "";
$tel = "";
$password = "";
$company_name = "";
$job_type = "";
$employee_scale = "";
$department = "";
$position = "";

$first_name_error = "";
$last_name_error = "";
$first_kana_error = "";
$last_kana_error = "";
$tel_error = "";
$password_error = "";
$password2_error = "";
$company_name_error = "";
$job_type_error = "";
$employee_scale_error = "";
$department_error = "";
$position_error = "";
$all_consent_error = "";

$user = wp_get_current_user();
$is_edit = true;

if ($user == null || $user->ID == 0) {
    $is_edit = false;
}
else {
    foreach ($user->roles as $role) {
        if (strcmp($role, "pending") == 0) {
            $is_edit = false;
            break;
        }
    }
}

if ($is_edit) {
    $email = get_the_author_meta("user_email", $user->ID);
    $first_name = get_the_author_meta("first_name", $user->ID);
    $last_name = get_the_author_meta("last_name", $user->ID);
    $first_kana = get_the_author_meta("first_kana", $user->ID);
    $last_kana = get_the_author_meta("last_kana", $user->ID);
    $tel = get_the_author_meta("tel", $user->ID);
    $company_name = get_the_author_meta("company_name", $user->ID);
    $job_type = get_the_author_meta("job_type", $user->ID);
    $employee_scale = get_the_author_meta("employee_scale", $user->ID);
    $department = get_the_author_meta("department", $user->ID);
    $position = get_the_author_meta("position", $user->ID);
}
else {
    if (empty($_GET['email']) || empty($_GET['key'])) {
        wp_safe_redirect("/error/404");
    }
    $email = $_GET['email'];
    $key = $_GET['key'];
    $user = get_user_by('email', $email);
    if (false === $user) {
        wp_safe_redirect("/error/404");
    }
    else {
        //ログイン実行
        $creds = [];
        $creds['user_login'] = $user->data->user_login;
        $creds['user_password'] = $key;
        $creds['remember'] = false;
        $user = wp_signon($creds, true);
        if (is_wp_error($user)) {
            wp_safe_redirect("/error/403");
        }
        wp_logout();
    }
}
if (isset($_POST['profile_nonce'])) {
    //nonceチェック
    //    if (!wp_verify_nonce($_POST['profile_nonce'], 'profile')) {
    //        $error = '不正な遷移です';
    //    }
    //    else {

    //
    if (!empty($_POST['first_name'])) {
        $first_name = $_POST['first_name'];
    }
    else {
        $has_error = true;
        $first_name_error = "未入力です";
    }
    //
    if (!empty($_POST['last_name'])) {
        $last_name = $_POST['last_name'];
    }
    else {
        $has_error = true;
        $last_name_error = "未入力です";
    }
    //
    if (!empty($_POST['first_kana'])) {
        $first_kana = $_POST['first_kana'];
        if (preg_match("/^[ァ-ヶー]+$/u", $first_kana) == false) {
            $has_error = true;
            $first_kana_error = "全角カタカナで入力してください";
        }
    }
    else {
        $has_error = true;
        $first_kana_error = "未入力です";
    }
    //
    if (!empty($_POST['last_kana'])) {
        $last_kana = $_POST['last_kana'];
        if (preg_match("/^[ァ-ヶー]+$/u", $last_kana) == false) {
            $has_error = true;
            $last_kana_error = "全角カタカナで入力してください";
        }
    }
    else {
        $has_error = true;
        $last_kana_error = "未入力です";
    }
    //
    if (!empty($_POST['tel'])) {
        $tel = $_POST['tel'];
        if (preg_match('/^[0-9]+$/', $tel) == false) {
            $has_error = true;
            $tel_error = "数字で入力してください";
        }
    }
    else {
        $has_error = true;
        $tel_error = "未入力です";
    }
    //
    if ($is_edit) {
        if (!empty($_POST['password']) && strlen($_POST['password']) > 0) {
            if (strlen($_POST['password']) >= 8) {
                if (strcmp($_POST['password'], $_POST['password2']) == 0) {
                    $password = $_POST['password'];
                }
                else {
                    $has_error = true;
                    $password2_error = "パスワードが一致しません";
                }
            }
            else {
                $has_error = true;
                $password_error = "半角英数字8文字以上で入力してください";
            }
        }
    }
    else {
        if (!empty($_POST['password']) && strlen($_POST['password']) >= 8) {
            if (strcmp($_POST['password'], $_POST['password2']) == 0) {
                $password = $_POST['password'];
            }
            else {
                $has_error = true;
                $password2_error = "パスワードが一致しません";
            }
        }
        else {
            $has_error = true;
            $password_error = "半角英数字8文字以上で入力してください";
        }
    }
    //
    if (!empty($_POST['company_name'])) {
        $company_name = $_POST['company_name'];
    }
    else {
        $has_error = true;
        $company_name_error = "未入力です";
    }
    //
    if (!empty($_POST['job_type']) && strcmp($_POST['job_type'], "以下より選択") != 0) {
        $job_type = $_POST['job_type'];
    }
    else {
        $has_error = true;
        $job_type_error = "選択してください";
    }
    //
    if (!empty($_POST['employee_scale']) && strcmp($_POST['employee_scale'], "以下より選択") != 0) {
        $employee_scale = $_POST['employee_scale'];
    }
    else {
        $has_error = true;
        $employee_scale_error = "選択してください";
    }
    //
    if (!empty($_POST['department']) && strcmp($_POST['department'], "以下より選択") != 0) {
        $department = $_POST['department'];
    }
    else {
        $has_error = true;
        $department_error = "選択してください";
    }
    //
    if (!empty($_POST['position']) && strcmp($_POST['position'], "以下より選択") != 0) {
        $position = $_POST['position'];
    }
    else {
        $has_error = true;
        $position_error = "選択してください";
    }
    //
    if ($is_edit == false) {
        if (strcmp('on', $_POST['all_consent']) != 0) {
            $has_error = true;
            $all_consent_error = "同意してください";
        }
    }

    if (!$has_error) {
        //ユーザ作成
        $userdata = [
            'ID'             => $user->ID,
            'user_login'     => uniqid(),
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'display_name'   => $last_name . " " . $first_name,
            'nickname'       => $last_name . " " . $first_name,
            'last_kana'      => $last_kana,
            'first_kana'     => $first_kana,
            'tel'            => $tel,
            'company_name'   => $company_name,
            'job_type'       => $job_type,
            'employee_scale' => $employee_scale,
            'department'     => $department,
            'position'       => $position
        ];
        if ($is_edit) {
            if (strlen($password) > 0) {
                $userdata['user_pass'] = $password;
            }
        } else {
				$userdata['role'] = 'user_roles';				
            $userdata['user_pass'] = $password;
        }
        $user_id = wp_update_user($userdata);

        if (is_wp_error($user_id)) {
            $error = "登録エラー";
        }
        else {
            if ($is_edit) {
                echo "<script type='text/javascript'>setTimeout(function(){alert('会員情報を編集しました');},100);</script>";
            }
            else {
                //遷移
                wp_safe_redirect("/register/profile-complete");
            }
        }
    }
}
?>
<?php if ($is_edit == false) {
    //get_header();
} ?>
<head>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700&display=swap&subset=japanese"
		  rel="stylesheet">

	<link rel="stylesheet"
		  href="/kyozon-theme/css/reset.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/style.css">
	<link rel="stylesheet"
		  href="/kyozon-theme/css/popup_style.css">
	<style>
		.popup_base {
			display: flex;
			justify-content: center;
		}

		.popup_container {
			width: 80% !important;
		}
	</style>
</head>
<main>
	<div class="popup_base">
		<div class="popup_container">
            <?php if ($is_edit == false) { ?>
				<div class="popup_bar">
				</div>
            <?php } ?>
			<div class="popupu_header">
				<h1><?php if ($is_edit) { ?>会員情報編集<?php } else { ?>会員情報登録<?php } ?></h1>
			</div>
			<div class="popup_body">
				<div class="form_header">
					<div class="form_error">※すべて必須項目</div>
				</div>
				<div class="form_container">
					<div class="form_body">
						<form action="<?php the_permalink(); ?>?<?= $_SERVER['QUERY_STRING'] ?>"
							  method="post">
                            <?php wp_nonce_field('profile', 'profile_nonce') ?>

							<input type="type"
								   name="dummyuserid"
								   style="top: -100px; left: -100px;position: fixed;"/>
							<input type="password"
								   name="dummypass"
								   style="top: -100px; left: -100px;position: fixed;"/>
							<div class="form_row form_row_layout">
								<div class="form_label">メールアドレス</div>
								<div><?= $email ?></div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">名前(漢字)</div>
								<div class="form_input">
									<input id="last_name"
										   name="last_name"
										   type="text"
										   placeholder="田中"
										   value="<?= $last_name ?>"
										   autocomplete="off">
                                    <?php if (!empty($last_name_error)): ?>
										<div class="form_row form_error">
                                            <?= $last_name_error ?>
										</div>
                                    <?php endif; ?>
								</div>
								<div class="form_input">
									<input id="first_name"
										   name="first_name"
										   type="text"
										   placeholder="太郎"
										   value="<?= $first_name ?>"
										   autocomplete="off">

                                    <?php if (!empty($first_name_error)): ?>
										<div class="form_row form_error">
                                            <?= $first_name_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">名前(カナ)</div>
								<div class="form_input">
									<input id="last_kana"
										   name="last_kana"
										   type="text"
										   placeholder="タナカ"
										   value="<?= $last_kana ?>"
										   autocomplete="off">
                                    <?php if (!empty($last_kana_error)): ?>
										<div class="form_row form_error">
                                            <?= $last_kana_error ?>
										</div>
                                    <?php endif; ?>
								</div>
								<div class="form_input">
									<input id="first_kana"
										   name="first_kana"
										   type="text"
										   placeholder="タロウ"
										   value="<?= $first_kana ?>"
										   autocomplete="off">
                                    <?php if (!empty($first_kana_error)): ?>
										<div class="form_row form_error">
                                            <?= $first_kana_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">電話番号</div>
								<div class="form_input">
									<input id="tel"
										   name="tel"
										   type="tel"
										   placeholder="ビジネス用の電話番号"
										   maxlength="12"
										   value="<?= $tel ?>"
										   autocomplete="off">
                                    <?php if (!empty($tel_error)): ?>
										<div class="form_row form_error">
                                            <?= $tel_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">パスワード</div>
								<div class="form_input">
									<input id="password"
										   name="password"
										   type="password"
										   placeholder="半角英数字8文字以上"
										   autocomplete="off">
                                    <?php if (!empty($password_error)): ?>
										<div class="form_row form_error">
                                            <?= $password_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">パスワード(確認用)</div>
								<div class="form_input">
									<input id="password2"
										   name="password2"
										   type="password"
										   placeholder="半角英数字8文字以上"
										   autocomplete="off">
                                    <?php if (!empty($password2_error)): ?>
										<div class="form_row form_error">
                                            <?= $password2_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">会社名</div>
								<div class="form_input">
									<input id="company_name"
										   name="company_name"
										   type="text"
										   placeholder="株式会社〇〇"
										   value="<?= $company_name ?>"
										   autocomplete="off">
                                    <?php if (!empty($company_name_error)): ?>
										<div class="form_row form_error">
                                            <?= $company_name_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">業種</div>
								<div class="form_input">
									<select id="job_type"
											name="job_type"
											data-select-value="<?= $job_type ?>">
										<option>以下より選択</option>
                                        <?= select_option($job_type, "不動産/建設/設備系") ?>
                                        <?= select_option($job_type, "メーカー/製造系") ?>
                                        <?= select_option($job_type, "エネルギー/環境/リサイクル系") ?>
                                        <?= select_option($job_type, "IT/通信/インターネット系") ?>
                                        <?= select_option($job_type, "輸送/交通/物流/倉庫系") ?>
                                        <?= select_option($job_type, "小売/流通/商社系") ?>
                                        <?= select_option($job_type, "金融/保険系") ?>
                                        <?= select_option($job_type, "サービス/外食/レジャー系") ?>
                                        <?= select_option($job_type, "コンサルティング・専門サービス") ?>
                                        <?= select_option($job_type, "マスコミ/広告/デザイン/ゲーム/エンターテイメント系") ?>
                                        <?= select_option($job_type, "医療系") ?>
                                        <?= select_option($job_type, "その他") ?>
									</select>
                                    <?php if (!empty($job_type_error)): ?>
										<div class="form_row form_error">
                                            <?= $job_type_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">従業員規模</div>

								<div class="form_input">
									<select id="employee_scale"
											name="employee_scale"
											data-select-value="<?= $employee_scale ?>">
										<option>以下より選択</option>
                                        <?= select_option($employee_scale, "1人") ?>
                                        <?= select_option($employee_scale, "2～10人") ?>
                                        <?= select_option($employee_scale, "11～30人") ?>
                                        <?= select_option($employee_scale, "31～100人") ?>
                                        <?= select_option($employee_scale, "101～300人") ?>
                                        <?= select_option($employee_scale, "301～1000人") ?>
                                        <?= select_option($employee_scale, "1001～5000人以上") ?>
                                        <?= select_option($employee_scale, "5001人以上") ?>
									</select>
                                    <?php if (!empty($employee_scale_error)): ?>
										<div class="form_row form_error">
                                            <?= $employee_scale_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">部署</div>
								<div class="form_input">
									<select id="department"
											name="department"
											data-select-value="<?= $department ?>">
										<option>以下より選択</option>
                                        <?= select_option($department, "経営層") ?>
                                        <?= select_option($department, "広報・PR部門") ?>
                                        <?= select_option($department, "マーケティング部門") ?>
                                        <?= select_option($department, "営業・販売部門") ?>
                                        <?= select_option($department, "経営企画部門") ?>
                                        <?= select_option($department, "情報システム部門") ?>
                                        <?= select_option($department, "人事部門") ?>
                                        <?= select_option($department, "総務・法務部門") ?>
                                        <?= select_option($department, "経理・財務部門") ?>
									</select>
                                    <?php if (!empty($department_error)): ?>
										<div class="form_row form_error">
                                            <?= $department_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form_row form_row_layout">
								<div class="form_label">役職</div>
								<div class="form_input">
									<select id="position"
											name="position"
											data-select-value="<?= $position ?>">
										<option>以下より選択</option>
                                        <?= select_option($position, "経営者") ?>
                                        <?= select_option($position, "役員（取締役）") ?>
                                        <?= select_option($position, "事業部長・工場長クラス") ?>
                                        <?= select_option($position, "部長・課長クラス") ?>
                                        <?= select_option($position, "係長・主任クラス") ?>
                                        <?= select_option($position, "一般社員・職員") ?>
                                        <?= select_option($position, "契約・派遣・委託") ?>
									</select>
                                    <?php if (!empty($position_error)): ?>
										<div class="form_row form_error">
                                            <?= $position_error ?>
										</div>
                                    <?php endif; ?>
								</div>
							</div>
                            <?php if ($is_edit == false) { ?>
								<div class="form_row form_row_layout">
									<div class="form_input">
										<div>
											<input id="all_consent"
												   name="all_consent"
												   type="checkbox">
											<a href="https://www.comix.co.jp/privacypolicy.html"
											   target="_blank">個人情報の取り扱い</a>
											および、
											<a href="/company/terms-of-use/"
											   target="_blank">利用規約</a>に同意する
										</div>
                                        <?php if (!empty($all_consent_error)): ?>
											<div class="form_row form_error">
                                                <?= $all_consent_error ?>
											</div>
                                        <?php endif; ?>
									</div>
								</div>
                            <?php } ?>
							<div class="form_row">
								<input type="submit" label="登録">
							</div>
							<input type="type"
								   name="dummyuserid"
								   style="top: -100px; left: -100px;position: fixed;"/>
							<input type="password"
								   name="dummypass"
								   style="top: -100px; left: -100px;position: fixed;"/>
						</form>
					</div>
				</div>
			</div>
			<div class="popupu_footer">

			</div>
		</div>
	</div>
</main>
<!-- GeeeN Tag Manager Start -->
<script type="text/javascript">
(function(i,g,m,a,h){i[a]=i[a]||[];i[a].push({"geeen_tag_manger.start":new Date().getTime(),event:"js"});var k=g.getElementsByTagName(m)[0],f=g.createElement(m),b=a!="GeeeNData"?"&l="+a:"",j=encodeURIComponent(window.location.href);f.async=true;f.src="https://gntm.geeen.co.jp/Onetag/?id="+h+"&u="+j+b;k.parentNode.insertBefore(f,k)})(window,document,"script","GeeeNData",1623);
</script>
<!-- GeeeN Tag Manager End -->
<?php if ($is_edit == false) {
    //get_footer();
} ?>
