<?php $this->load->view('./parts/header.php'); ?>

<div id="container">
	<h1>MORURUN　UPLOAD</h1>

	<div id="body">

        <?php echo form_open_multipart('uploadData/upload'); ?>
        
            <p>■動画ファイル<br>
            <input type="file" name="movdata"></p>
    
            <p><input type="submit" value="送信する"></p>
    
        </form>
        
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<?php $this->load->view('./parts/footer.php'); ?>