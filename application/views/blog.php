<!-- navigation -->
<?php $this->load->view('partials/header.php'); ?>


<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= base_url(); ?>assets/img/home-bg.jpg')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="site-heading">
					<h1>Welcome to my Web</h1>
					<span class="subheading">A Blog By Rey</span>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Main Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">

			<?= $this->session->flashdata('message'); ?>

			<form action="">
				<input type="text" name="find" id="">
				<button type="submit">Cari</button>
			</form>

			<?php foreach ($blogs as $key => $blog): ?>
				<div class="post-preview">
					<a href="<?= site_url('blog/detail/' . $blog['url']) ?>">
						<h2 class="post-title">
							<?= $blog['title'] ?>
						</h2>
					</a>
					<p class="post-meta">Posted on <?= $blog['date']; ?>
						<?php if (isset($_SESSION['username'])): ?>
							<a style="color:green;" href="<?= site_url('blog/edit/' . $blog['id']); ?>">Edit</a>
							<a style="color: red;" href="<?= site_url('blog/delete/' . $blog['id']); ?>"
								 onclick="return confirm('Are you sure?')">Delete</a>
						<?php endif; ?>
					</p>
					<p><?= $blog['content']; ?></p>
				</div>
				<hr>
			<?php endforeach; ?>

			<?= $this->pagination->create_links(); ?>

			<!-- Pager -->
		</div>
	</div>
</div>

<hr>

<!-- Footer -->
<?php $this->load->view('partials/footer.php'); ?>
	

