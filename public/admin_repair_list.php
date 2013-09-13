<?php
include_once("../sys/core/init.inc.php");

/* 初始化页面信息 */
$page_title = "报修记录 | 酒店后勤管理系统";
$page_h1 = "酒店后勤管理——房务管理、设备管理、仓库管理";

/* 检查模式是新建还是修改 */
if( isset($_GET['id']) ) {
	// 修改模式
	$submit = "修改报修记录";
	$action = "repair_list_edit";
	
	$obj = new RepairList($_GET['id']);
	if( NULL === $array = $obj->loadDataById() )
	{
		// 没有查到id记录
		header("Location: ./repair_list.php");
		exit;
	}
}
else {
	// 新建模式
	$submit = "添加报修记录";
	$action = "repair_list_new";
}

/* 载入页头 */
include_once("assets/common/header.inc.php");

/* 载入CSS和JS部分 */
?>
<link href="assets/css/admin_repair_list.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/js/admin_repair_list.js"></script>
<?php

/* 载入模板 */
include_once("assets/common/formwork.inc.php");

echo <<<EDIT_BOX
<div class="edit-box">
	<form action="assets/cgi/admin.php" method="post">
    	<fieldset>
        	<legend>$submit</legend>
            <label for="room_id">维修房间号</label>
            <input type="text" name="room_id" id="room_id" value="{$array['room_id']}" />
            <label for="equipment_id">维修设备号</label>
            <input type="text" name="equipment_id" id="equipment_id" value="{$array['equipment_id']}" />
            <label for="deadline">维修期限</label>
            <select name="deadline" id="deadline">
                <option value="43200" selected>半天</option>
                <option value="86400">1天</option>
				<option value="172800">2天</option>
                <option value="259200">3天</option>
				<option value="345600">4天</option>
            </select>
            <label for="detail">备注说明</label>
            <textarea name="detail" id="detail">{$array['detail']}</textarea>
            <input type="hidden" name="id" value="{$_GET['id']}" />
            <input type="hidden" name="token" value="{$_SESSION['token']}" /> 
			<input type="hidden" name="action" value="$action" />
			<input type="submit" name="submit" value="$submit" /> or <a href="./repair_list.php">cancel</a>
		</fieldset>
	</form>  
</div>
EDIT_BOX;

/* 载入页尾 */
include_once("assets/common/footer.inc.php");
?>