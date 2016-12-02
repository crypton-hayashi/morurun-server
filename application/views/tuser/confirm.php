<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<?php echo form_open('tuser/complate'); ?>

		<input type="hidden" name="edit" value="<?php echo $edit;?>">
		<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
        <input type="hidden" name="uid" value="<?php echo $uid;?>">

		<input type="hidden" name="datetime" value="<?php echo $datetime;?>">

		<input type="hidden" name="nickname" value="<?php echo $nickname;?>">
		<input type="hidden" name="mail" value="<?php echo $mail;?>">

		<div id="body">
			<table border=1>
			 <tr><th></th><th>入力項目</th></tr>
             <tr><td>UID</td><td><?php echo $uid;?></td></tr>
			 <tr><td>日付</td><td><?php echo $datetime;?></td></tr>

			 <tr><td>ニックネーム</td><td><?php echo $nickname;?></td></tr>
			 <tr><td>メールアドレス</td><td><?php echo $mail;?></td></tr>
			</table>

			<p><input type="submit" value="登録"></p>
		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>