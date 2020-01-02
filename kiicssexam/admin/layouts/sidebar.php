<style type="text/css">
	.nav-link {
		text-decoration: none;
		color: white;
		/*text-shadow: 2px 1px black;*/
	}
	.nav-link:hover {
		background-color: rgb(100,100,100);
		color: rgb(10,10,20);
		/*text-shadow: 0px 0px black;*/
	}
</style>

<div style=" background-color: #4f4f4f; width: 20%; height: 100%; position: fixed; padding-top: 30px; z-index: 2;">
	<!-- <div style="margin-top: 30px; text-align: center;">
		
	</div> -->
	<div class="container">
	  <ul class="nav flex-column">
	    <li class="nav-item">
	      <h5><a class="nav-link text-center" href="login_manage.php">Profile</a></h5>
	    </li>
	    <li class="nav-item">
	      <h5><a class="nav-link text-center" href="users_manage.php">Users</a></h5>
	    </li>
	    <li class="nav-item">
	      <h5><a class="nav-link text-center" href="subjects_manage.php">Subjects</a></h5>
	    </li>
	    <li class="nav-item">
	      <h5><a class="nav-link text-center" href="students_manage.php">Students</a></h5>
	    </li>
	    <li class="nav-item">
	      <h5><a class="nav-link text-center" href="results.php">Results</a></h5>
	    </li>
    	<li class="nav-item text-center">
    		<form class="nav-link" action="action/logout.inc.php" method="POST">
    			<button style="background: transparent; border: transparent; color: white;" name="logout">
    				<h5>Logout</h5>
    			</button>
    		</form>
	    </li>
	  </ul>
	</div>
	
</div>