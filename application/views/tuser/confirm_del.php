<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

		<div id="body">

			<p>管理ID「<?php echo $user_id; ?>」番のデータを削除します。本当によろしいですか？</p>

			<p><a href="/morurun/index.php/tuser/del/<?php echo $user_id; ?>">はい削除します</a></p>
			<p><a href="/morurun/index.php/tuser/">いいえ</a></p>

		</div>

	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>