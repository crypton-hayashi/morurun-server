<?php $this->load->view('./parts/header.php'); ?>

<?php
if($edit){
// 編集モード
	$user_id = $query[0]["user_id"];
    $uid = $query[0]["uid"];
	$datetime = $query[0]["datetime"];
	$nickname = $query[0]["nickname"];
	$mail = $query[0]["mail"];

}else{

// 新規モード
	$user_id = null;
    $uid = "";
	$datetime = date('Y-m-d H:i:s');
	$nickname = "";
	$mail = "";

}
?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<?php echo form_open('tuser/confirm'); ?>

		<input type="hidden" name="edit" value="<?php echo $edit;?>">
		<input type="hidden" name="user_id" value="<?php echo $user_id;?>">

		<div id="body">
			<table border=1>
			 <tr><th></th><th>入力項目</th></tr>
             <tr><td>UID</td><td><input type="text" name="uid" value="<?php echo $uid; ?>"></td></tr>
			 <tr><td>日付</td><td><input type="datetime" name="datetime" value="<?php echo $datetime; ?>"></td></tr>
             <tr><td>ニックネーム</td><td><input type="text" name="nickname" value="<?php echo $nickname; ?>"></td></tr>
			 <tr><td>メールアドレス</td><td><input type="text" name="mail" value="<?php echo $mail; ?>"></td></tr>
			</table>

			<p><input type="submit" value="確認"></p>
		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>