<?php $this->load->view('./parts/header.php'); ?>

<?php
if($edit){
// 編集モード
	$posting_id = $query[0]["posting_id"];
    $uid = $query[0]["uid"];
	$datetime = $query[0]["datetime"];
	$type_id = $query[0]["type_id"];
	$site_id = $query[0]["site_id"];
    $comment = $query[0]["comment"];
    $gps_lat = $query[0]["gps_lat"];
    $gps_lng = $query[0]["gps_lng"];
    $disable_flag = $query[0]["disable_flag"];

}else{

// 新規モード
	$posting_id = null;
    $uid = "";
	$datetime = date('Y-m-d H:i:s');
	$type_id = "";
	$site_id = "";
    $comment = "";
    $gps_lat = "";
    $gps_lng = "";
    $disable_flag = "";

}
?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<?php echo form_open('tposting/confirm'); ?>

		<input type="hidden" name="edit" value="<?php echo $edit;?>">
		<input type="hidden" name="posting_id" value="<?php echo $posting_id;?>">

		<div id="body">
			<table border=1>
			 <tr><th></th><th>入力項目</th></tr>
             <tr><td>UID</td><td><input type="text" name="uid" value="<?php echo $uid; ?>"></td></tr>
			 <tr><td>日付</td><td><input type="datetime" name="datetime" value="<?php echo $datetime; ?>"></td></tr>
             <tr><td>type_id</td><td><input type="text" name="type_id" value="<?php echo $type_id; ?>"></td></tr>
			 <tr><td>site_id</td><td><input type="text" name="site_id" value="<?php echo $site_id; ?>"></td></tr>
             <tr><td>comment</td><td><input type="text" name="comment" value="<?php echo $comment; ?>"></td></tr>
             <tr><td>gps_lat</td><td><input type="text" name="gps_lat" value="<?php echo $gps_lat; ?>"></td></tr>
             <tr><td>gps_lng</td><td><input type="text" name="gps_lng" value="<?php echo $gps_lng; ?>"></td></tr>
             <tr><td>disable_flag</td><td><input type="text" name="disable_flag" value="<?php echo $disable_flag; ?>"></td></tr>
			</table>

			<p><input type="submit" value="確認"></p>
		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>