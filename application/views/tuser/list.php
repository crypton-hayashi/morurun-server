<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　WEB管理者画面　-t_user-</h1>
	<h1><a href="/morurun">MAINページに戻る</a></h1>

	<div id="body">
		<p><a href="add">追加</a></p>
		<table border=1>
		 <tr><th>管理ID</th><th>UID</th><th>日付</th><th>ニックネーム</th><th>メールアドレス</th><th>アクション</th><th>状態</th></tr>

		<?php
		foreach ($query->result() as $row)
		{
		?>
		<tr>
			<td><?php echo $row->user_id; ?></td>
			<td><?php echo $row->uid; ?></td>
			<td><?php echo $row->datetime; ?></td>
			<td><?php echo $row->nickname; ?></td>
            <td><?php echo $row->mail; ?></td>
			<td><a href="edit/<?php echo $row->user_id; ?>/">編集</a> / <a href="confirm_del/<?php echo $row->user_id; ?>/">削除</a></td>
            <td>
                <?php if($row->disable_flag){ ?>
                    <a href="enable/<?php echo $row->user_id; ?>/">有効にする</a>
                <?php }else{ ?>
                    <a href="disable/<?php echo $row->user_id; ?>/">無効にする</a>
                <?php } ?>
            </td>
		</tr>
		<?php
		}
		?>

		</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>