	<script type="text/javascript" src="scripts/login.js"></script>
	
	<div class="posttitle">
	Guest Services
	</div>
	<div class="postcontent">
	<div><img id="accountloadingBar" alt="" src="images/loader.gif" /></label></div>
	<div id="successMessage">
	</div>
	<div id="errorMessage">
	</div>
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Login</a>
                </li>
                <li>
                    <a href="#register">Register</a>
                </li>
                <li>
                    <a href="#reset">Reset Password</a>
                </li>
            </ul>
            <div id="login" class="form-action show">
                <form id="loginForm" data-ajax="false" onSubmit="return keepOpen()">
                    <ul>
                        <li>
                            <input type="text" id="username" placeholder="Username" maxlength="15"/>
                        </li>
                        <li>
                            <input type="password" id="password" placeholder="Password"maxlength="20"/>
                        </li>
                        <li>
				Remember Me?<input type="checkbox" id="rememberMe">
				<br>
                        </li>
                        <li>
                            <input type="submit" value="Login" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#login.form-action-->
            <div id="register" class="form-action hide">
                <form id="registerForm" data-ajax="false" onSubmit="return keepOpen()">
                    <ul>
			<li><font color='red'>It is not advised to use your MapleStory Login ID / password for security purposes. We are not here to steal your information, but merely just to provide a convenient service.</font></li>
			<br><br>
                        <li><input type="text" id="regusername" placeholder="Username" maxlength="15"/></li>
                        <li><input type="password" id="regpassword" placeholder="Password" maxlength="15"/></li>
                        <li><input type="password" id="regpassword2" placeholder="Comfirm Password" maxlength="15"/></li>
                        <li><input type="text" id="regemail" placeholder="Email" /></li>
			<li><select id="regworld" name="regworld" style="height: 30px;width:220px;">
				<option value="">--- World Selection ---</option>
				<option value="Scania" selected>Scania</option>
				<option value="Windia">Windia</option>
				<option value="Bera">Bera</option>
				<option value="Broa">Broa</option>
				<option value="Khaini">Khaini</option>
				<option value="YMCK">YMCK</option>
				<option value="GAZED">GAZED</option>
				<option value="BelloNova">BelloNova</option>
				<option value="Renegades">Renegades</option>
			</select>
			</li>
                        <li><input type="text" id="regcaptcha" placeholder="Captcha" /><img src='../include/captcha.php'></li>
			<li>Check the box if you agree to the ToS: <input type="checkbox" id="regagree" value="agree"></li>
                        <li>
                            <input type="submit" value="Start Registration" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
            <div id="reset" class="form-action hide">
                <form id="resetForm" onSubmit="return keepOpen()">
                    <ul>
						<li>Username: <input type="text" id="resetFormID" placeholder="LoginID / Username" maxlength="15"/></li>
                        <li>Registered Email: <input type="text" id="resetFormEmail" placeholder="Email"/></li>
                        <li>New Password: <input type="password" id="resetFormPassword1" placeholder="*********" maxlength="15"/></li>
                        <li>Confirm New Password: <input type="password" id="resetFormPassword2" placeholder="********" maxlength="15"/></li>
                        <li><input type="submit" value="Reset Password" class="button" /></li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
        </div>
	</div>