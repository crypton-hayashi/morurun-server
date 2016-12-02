<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面</h1>

	<div id="body">
		<p>d_morurun.t_user</p>
		<code><a href="index.php/tuser/">編集画面</a></code>
        
        <p>d_morurun.t_posting</p>
		<code><a href="index.php/tposting/">編集画面</a></code>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>