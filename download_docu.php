<?php
	include 'db_conn.php';
	session_start();

	class download{
		public $db;
		public function __construct(){
			$this->db=new mysqli(db_server, db_username, db_password, db_database);

			if (nysqli_connect_errno()) {
				echo "
					<script type='text/javascript'>
						alert('Cannot establish connection to database.');
					</script>
				";
				exit;
			}
		}
	}

?>