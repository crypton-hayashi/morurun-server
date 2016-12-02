<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_posting-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<?php echo form_open('tposting/complate'); ?>

		<input type="hidden" name="edit" value="<?php echo $edit;?>">
		<input type="hidden" name="posting_id" value="<?php echo $posting_id;?>">
        <input type="hidden" name="uid" value="<?php echo $uid;?>">

		<input type="hidden" name="datetime" value="<?php echo $datetime;?>">

		<input type="hidden" name="type_id" value="<?php echo $type_id;?>">
		<input type="hidden" name="site_id" value="<?php echo $site_id;?>">
        <input type="hidden" name="comment" value="<?php echo $comment;?>">
        <input type="hidden" name="gps_lat" value="<?php echo $gps_lat;?>">
        <input type="hidden" name="gps_lng" value="<?php echo $gps_lng;?>">
        <input type="hidden" name="disable_flag" value="<?php echo $disable_flag;?>">

		<div id="body">
			<table border=1>
			 <tr><th></th><th>入力項目</th></tr>
             <tr><td>UID</td><td><?php echo $uid;?></td></tr>
			 <tr><td>日付</td><td><?php echo $datetime;?></td></tr>

			 <tr><td>type_id</td><td><?php echo $type_id;?></td></tr>
			 <tr><td>site_id</td><td><?php echo $site_id;?></td></tr>
            <tr><td>comment</td><td><?php echo $comment;?></td></tr>
            <tr><td>gps_lat</td><td><?php echo $gps_lat;?></td></tr>
            <tr><td>gps_lng</td><td><?php echo $gps_lng;?></td></tr>
            <tr><td>disable_flag</td><td><?php echo $disable_flag;?></td></tr>
			</table>

			<p><input type="submit" value="登録"></p>
		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>