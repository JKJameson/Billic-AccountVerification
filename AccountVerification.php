<?php
class AccountVerification {
	public $settings = array(
            'description' => 'Shows a special page to users to verify their account.',
	);
	function global_after_header() {
		global $billic, $db;
		if (!empty($billic->user) && $billic->user['verified']<1) {
			echo '<div class="alert alert-warning" role="alert">To pay with certian payment methods you are required to verify your account. [ <a href="/User/AccountVerification/">Click here to verify your account</a> ]</div>';
		}
	}
	function user_area() {
		global $billic, $db;
		$billic->force_login();
		
		$billic->set_title('Account Verification');
		echo '<h1><i class="icon-certificate"></i> Account Verification</h1>';

		$billic->show_errors();

		echo '<form method="POST" action="/User/Tickets/New/" enctype="multipart/form-data">';
		echo '<input type="hidden" name="title" value="Account Verification Request">';
		echo '<input type="hidden" name="message" value="Account Verification Request">';
		echo '<input type="hidden" name="min_attachments" value="2">';
		
		echo '<table class="table table-striped">';
		echo '<tr><td>Scan of Photo ID<br><sup>Passport, driving license, government ID, etc.</sup></td><td><input class="form-control" type="file" name="files[]"></td></tr>';
		echo '<tr><td>Scan of Utility Bill<br><sup>Electricity bill, bank statement, etc. (no older than <strong>3 Months</strong>)</sup></td><td><input class="form-control" type="file" name="files[]"></td></tr>';
		echo '</table>';
		
		echo '<div align="center"><input type="submit" class="btn btn-success" value="Upload Documents &raquo;"></div>';
		
		echo '</form>';
	}
}
