<?php $this->load->view('partials/header'); ?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= base_url(); ?>assets/img/home-bg.jpg')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="site-heading">
					<h1>Login</h1>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Main Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-6 mx-auto">

			<?php if ($this->session->flashdata('message')): ?>
				<?= $this->session->flashdata('message'); ?>
			<?php endif; ?>

			<!-- Login Form -->
			<?= form_open() ?>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">Login</button>
			<?= form_close() ?>

		</div>
	</div>
</div>

<?php $this->load->view('partials/footer'); ?>
