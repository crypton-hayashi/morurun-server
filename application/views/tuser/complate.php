<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_uesr-</h1>
	<h1><a href="/jwc_admin">MAINページに戻る</a></h1>


		<div id="body">

			<p>登録完了致しました。数秒後にt_userページに移動します。</p>
			<h1><a href="/morurun/index.php/tuser/">t_userページに戻る</a></h1>

			<SCRIPT language="JavaScript">
			<!--
			// 一定時間経過後に指定ページにジャンプする
			mnt = 2; // 何秒後に移動するか？
			url = "/morurun/index.php/tuser/"; // 移動するアドレス
			function jumpPage() {
			  location.href = url;
			}
			setTimeout("jumpPage()",mnt*1000)
			//-->
			</SCRIPT>

		</div>


	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>