<?php $this->load->view('partials/header.php'); ?>

<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="post-heading">
					<h1>Tambah Artikel Baru</h1>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Tambah Artikel</h1>

			<?php if (validation_errors()): ?>
				<div class="alert alert-warning">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

			<?= form_open_multipart(); ?>
			<div class="form-group">
				<label for="">Judul</label>
				<?= form_input('title', set_value('title'), 'class="form-control"') ?>
				<!-- <input class="form-control" type="text" name="title" id=""> -->
			</div>

			<div class="form-group">
				<label for="">URL</label>
				<?= form_input('url', set_value('url'), 'class="form-control"') ?>
				<!-- <input class="form-control" type="text" name="url" id=""> -->
			</div>

			<div class="form-group">
				<label for="">Konten</label>
				<?= form_textarea('content', set_value('content'), 'class="form-control"') ?>
				<!-- <textarea class="form-control" cols="30" rows="10" name="content" id="" cols="30" rows="10"></textarea> -->
			</div>

			<div class="form-group">
				<label for="">Cover</label>
				<?= form_upload('cover', null, 'class="form-control"') ?>
			</div>

			<button class="btn btn-primary" type="submit">Simpan Artikel</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<?php $this->load->view('partials/footer.php'); ?>
