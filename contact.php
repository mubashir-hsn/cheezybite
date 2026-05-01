<?php
session_start();
include_once 'connect.php';

$errors = [];
$success = '';

$name = $_POST['name'] ?? ($_SESSION['user_name'] ?? '');
$email = $_POST['email'] ?? ($_SESSION['email'] ?? '');
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = trim($name);
	$email = trim($email);
	$subject = trim($subject);
	$message = trim($message);

	if ($name === '') $errors[] = 'Name is required.';
	if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
	if ($subject === '') $errors[] = 'Subject is required.';
	if ($message === '') $errors[] = 'Message is required.';

	if (empty($errors)) {
		$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
		$stmt = mysqli_prepare($con, "INSERT INTO support (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'issss', $user_id, $name, $email, $subject, $message);
			if (mysqli_stmt_execute($stmt)) {
				$success = 'Your message was sent. We will get back to you soon.';
				// clear inputs
				$subject = $message = '';
			} else {
				$errors[] = 'Database error: could not save message.';
			}
			mysqli_stmt_close($stmt);
		} else {
			$errors[] = 'Database error: could not prepare statement.';
		}
	}
}

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/contact.css">
  <link rel="stylesheet" href="./css/style.css">
	<title>Contact</title>

</head>

<body>

	<!-- ......Navbar Section Start ..................................    -->
	<header>
		<?php include('navbar.php'); ?>
	</header>

	<!-- ...... Navbar Section End ..............................................................  -->


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row no-gutters">
							<div class="col-md-7 d-flex align-items-stretch">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4" style="font-family: Agbalumo; color: #b50101;">Get in touch</h3>
																		<?php if (!empty($errors)): ?>
																			<div class="alert alert-danger">
																				<ul class="mb-0">
																					<?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
																				</ul>
																			</div>
																		<?php endif; ?>
																		<?php if ($success): ?>
																			<div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
																		<?php endif; ?>
																		<form method="POST" id="contactForm" name="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= htmlspecialchars($name) ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?= htmlspecialchars($subject) ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"><?= htmlspecialchars($message) ?></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn cartHover">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-5 d-flex align-items-stretch">
								<div class="info-wrap w-100 p-lg-5 p-4" style="background-color: #b50101;">
									<h3 class="mb-4 mt-md-4">Contact us</h3>
									<div class="dbox w-100 d-flex align-items-start">
										<div class="icon d-flex align-items-center justify-content-center">
											<span class=""><img src="./logo/location.svg" alt=""></span>
										</div>
										<div class="text pl-3">
											<p><span>Address:</span> 123 Anywhere Street, Suite 721 PK</p>
										</div>
									</div>
									<div class="dbox w-100 d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center">
											<span class=""><img src="./logo/phone.svg" alt=""></span>
										</div>
										<div class="text pl-3">
											<p><span>Phone:</span> <a href="tel://1234567920">+92 1235 2355 98</a></p>
										</div>
									</div>
									<div class="dbox w-100 d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center">
											<span class=""><img src="./logo/email.svg" alt=""></span>
										</div>
										<div class="text pl-3">
											<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@cheezybite.com</a></p>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<!-- .............. Footer Section Start ............................... -->

	<section>
		<?php include('footer.php'); ?>
	</section>

	<!-- .............. Footer Section End ............................... -->


	<script src="/js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>