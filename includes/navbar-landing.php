<nav class="navbar-landing" id='#navbar-landing'>
            <div class="navbar-left">
                <div class="navbar-links">
                    <ul>
                        <li><a class='links' href="#">Find a job</a></li>
                        <li><a class='links' href="#">Post a job</a></li>
                    </ul>
                </div>    
            </div>
            <div class="navbar-right">
                <div class="navbar-links">
                    <ul>
                        <li><a href="/cv/create.php" class="links">Create a CV</a></li>
                        <li><a href="/login/login.php"  class="links" >Login</a>
                        </li>
                        <li><a href="#" id='register' onclick='toggleDropdown()' class="links">Register</a>
                        <div class="dropdown">
                                <div class="dropdown-content">
                                    <div class=dropdown-nav>
                                        <p id='drop-nav' onclick='toggleRegistration()' class='active'>Jobseeker</p>
                                        <p id='drop-nav' onclick='toggleRegistration()'>Employer</p>
                                    </div>
                                    <div class="dropdown-body">
                                        <div class='jobseeker drop-active show '>
                                            <img src="../img/logo/user-regular.svg" alt="" width='60px'>
                                            <div class="btn-drop">
                                            <a  href='/register/jobseeker.php'>Register</a>
                                            </div>
                                            <hr>
                                            <h3 class="heading-secondary">Jobseeker</h3>
                                            <p>Create a free account to apply for jobs</p>
                                        </div>
                                        <div class='employer drop-active'>
                                            <img src="../img/logo/building-regular.svg" alt="" width='60px'>
                                            <div class="btn-drop">
                                            <a  href='/register/employer.php'>Register</a>
                                            </div>
                                            <hr>
                                            <h3 class="heading-secondary">Employer</h3>
                                            <p>Create a free acount to post vacancy.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>