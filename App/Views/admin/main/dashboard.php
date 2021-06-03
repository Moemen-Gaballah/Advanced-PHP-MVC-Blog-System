<!DOCTYPE html>

<html>
	<head>
		<title>Hello!</title>
	</head>

	<body>
		<form action="<?php echo url('/admin/submit'); ?>" method="post" 
			enctype="multipart/form-data">
			<label for="email">Email</label>
			<input type="text" name="email">
			<br>
			
			<label for="password">Passwprd</label>
			<input type="password" name="password">
			<br>	

			<label for="confirm_password">Confirm Password</label>
			<input type="confirm_password" name="confirm_password">
			<br>

			<label for="fullname">Full Name</label>
			<input type="fullname" name="fullname">
			<br>

			<label for="image">Upload image</label>
			<input type="file" name="image">
			<br>

			<button>
				Send
			</button>
		</form>
	

	<!-- jQuery -->
	<script src="<?php echo assets('/admin/plugins/jquery/jquery.min.js') ?>"></script>
	<script>
		$('form').on('submit', function (e) {
			e.preventDefault();

			var form = $(this);
			var sentData = new FormData(form[0]);

			$.ajax({
				url: form.attr('action'),
				type: 'post',
				data: sentData,
				dataType: 'json',
				success: function (r) {
					$('body').append(r.name);
				},
				cache: false,
				processData: false,
				contentType: false,
			})
		});
	</script>
	</body>
</html>
