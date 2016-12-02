<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<?php echo form_open_multipart('postData'); ?>

		<div id="body">
			<table border=1>
			 <tr><th></th><th>入力項目</th></tr>
             <tr><td>UID</td><td><input type="text" name="uid"></td></tr>
             <tr><td>type_id</td><td><input type="text" name="type_id"></td></tr>
             <tr><td>comment</td><td><input type="text" name="comment"></td></tr>
             <tr><td>gps_lat</td><td><input type="text" name="gps_lat"></td></tr>
             <tr><td>gps_lng</td><td><input type="text" name="gps_lng"></td></tr>
             <tr><td>■動画ファイル</td><td><input type="file" name="cdata"></td></tr>
			</table>

			<p><input type="submit" value="確認"></p>
		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>