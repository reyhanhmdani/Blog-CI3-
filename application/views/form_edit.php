<?php $this->load->view('partials/header.php'); ?>

<?php if ($blog['cover'] == null) {
	$cover = base_url() . 'assets/img/post-bg.jpg' . $blog['cover'];
} else {
	$cover = base_url() . 'uploads/' . $blog['cover'];
}

?>
<?php $this->load->view('partials/header.php'); ?>

<header class="masthead" style="background-image: url('<?= $cover ?>')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="post-heading">
					<h1>Edit Artikel</h1>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<?php if (validation_errors()): ?>
				<div class="alert alert-warning">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

			<?= form_open_multipart(); ?>
			<div class="form-group">
				<label for="">Judul</label>
				<?= form_input('title', set_value('title', $blog['title']), 'class="form-control"') ?>
			</div>

			<div class="form-group">
				<label for="">URL</label>
				<?= form_input('url', set_value('url', $blog['url']), 'class="form-control"') ?>
			</div>

			<div class="form-group">
				<label for="">Konten</label>
				<?= form_textarea('content', set_value('content', $blog['content']), 'class="form-control"') ?>
			</div>

			<div class="form-group">
				<label for="">Cover</label>
				<?= form_upload('cover', $blog['cover'], 'class="form-control"') ?>
			</div>

			<button class="btn btn-primary" type="submit">Simpan Artikel</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<?php $this->load->view('partials/footer.php'); ?>
