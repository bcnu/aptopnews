<?php
// no direct access
defined('_JEXEC') or die;
?>
<?php
JHtml::_('behavior.keepalive');

if (defined('YTLOGIN_MOBILE')){ //Begin login for mobile 
	if ($type == 'logout') :?>
    <div id="m_login" class="mod_wrap_inner" >
    	<a href="#" id="btn_login_closepop" class="close-popup">close</a>
        <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
            <a href="javascript:;" name="Submit" class="logout-switch" onclick="$('login-form').submit();"><?php echo JText::_('JLOGOUT'); ?></a> 
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="user.logout" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
<?php else : ?>
	<div id="m_login" class="mod_wrap_inner" >
        <a href="#" id="btn_login_closepop" class="close-popup">close</a>
        <h3>Sign In</h3>
        <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
            <?php if ($params->get('pretext')): ?>
                <div class="pretext">
                <p><?php echo $params->get('pretext'); ?></p>
                </div>
            <?php endif; ?>
            <div class="inner">
                <label for="modlgn-username" class="yt-login-user">
                    <span><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>: </span>
                    <input id="modlgn-username" type="text" name="username" class="inputbox"  size="25" />
                </label>
                <label for="modlgn-passwd" class="yt-login-password">
                    <span><?php echo JText::_('JGLOBAL_PASSWORD') ?>: </span>
                    <input id="modlgn-passwd" type="password" name="password" class="inputbox" size="25"  />
                </label>
                <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                <p id="form-login-remember">
                    <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
                    <label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
                </p>
                <?php endif; ?>
                <input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.login" />
                <input type="hidden" name="return" value="<?php echo $return; ?>" />
                <?php echo JHtml::_('form.token'); ?>
            </div>
            <ul class="yt-login-links clearfix">
                <li>
                    <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
                </li>
                <li>
                    <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
                </li> 
				<?php
				$usersConfig = JComponentHelper::getParams('com_users');
				if ($usersConfig->get('allowUserRegistration')) : ?>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
						<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
				</li>
				<?php endif; ?>				
            </ul>
            <?php if ($params->get('posttext')): ?>
                <div class="posttext">
                <p><?php echo $params->get('posttext'); ?></p>
              	</div>
            <?php endif; ?>
        </form>
    </div>
    <div id="m_regis" class="mod_wrap_inner" >
    	<a href="#" id="btn_regis_closepop" class="close-popup">close</a>
        <h3>Register</h3>
        <?php
        $option = JRequest::getCmd('option');
		$task = JRequest::getCmd('task');
		if($option!='com_user' && $task != 'register') { ?>
		<script type="text/javascript" src="<?php echo JURI::base();?>media/system/js/validate.js"></script>
        <div id="yt-user-reg"><div class="inner">
        	
            <script type="text/javascript">
            <!--
                window.addEvent('domready', function(){
                    document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
                });
            // -->
            </script>         
            <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
                <label class="required yt-field-regis" for="jform_name" id="namemsg" title="Name&lt;br&gt;Enter your full name">
                    <span>
                        <?php echo JText::_( 'Name' ); ?>
                    </span>				
                    <input type="text" size="25" class="inputbox required" value="" id="jform_name" name="jform[name]"/><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_username" id="usernamemsg">
                    <span>
                        <?php echo JText::_( 'Username' ); ?>:
                    </span>
                    <input type="text" size="25" class="inputbox validate-username required" value="" id="jform_username" name="jform[username]"/><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_password1" id="pwmsg">
                    <span>
                        <?php echo JText::_( 'Password' ); ?>:
                    </span>
                    <input type="password" size="25" class="inputbox validate-password required" value="" id="jform_password1" name="jform[password1]"/><span class="star">*</span>                     
                </label>
                <label title="" class="required yt-field-regis" for="jform_password2" id="pw2msg">
                    <span>
                        <?php echo JText::_( 'Verify Pass' ); ?>:
                    </span>
                    <input type="password" size="25" class="inputbox validate-password required" value="" id="jform_password2" name="jform[password2]"/><span class="star">*</span>
                </label>    
                <label title="" class="required yt-field-regis" for="jform_email1" id="emailmsg">
                    <span>
                        <?php echo JText::_( 'Email' ); ?>:
                    </span>
                    <input type="text" size="25" class="inputbox validate-email required" value="" id="jform_email1" name="jform[email1]" /><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_email2" id="email2msg">
                    <span>
                        <?php echo JText::_( 'Verify mail'); ?>:
                    </span>
                    <input type="text" size="25" class="inputbox validate-email required" value="" id="jform_email2" name="jform[email2]" /><span class="star">*</span>
                               
                </label>
                <span class="note">
                    <?php echo "All fields are required(*)."; ?>
            	</span>
            	<input type="submit" class="validate button" value="Register"  />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="registration.register" />
                <?php echo JHtml::_('form.token');?>
            </form>
    	</div></div>
        <?php } ?>
    </div>
<?php 
endif; // End $option!='com_user' && $task != 'register'
} // End login for mobile
else{ // Begin login for desktop 
?>
<?php if ($type == 'logout') : ?>
    <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="yt_login_form">
    <ul class="yt-login-regis">
    <?php if ($params->get('greeting')) : ?>
        <li class="hiuser text-font"><span>
        <?php if($params->get('name') == 0) : {
            echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('name'));
        } else : {
            echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('username'));
        } endif; ?>
        </span></li>
    <?php endif; ?>
        <li class="hiuser text-font">
            <a href="javascript:;" name="Submit" class="logout-switch" onclick="$('yt_login_form').submit();"><?php echo JText::_('JLOGOUT'); ?></a> 
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="user.logout" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
        <?php echo JHtml::_('form.token'); ?>
        </li>
    </ul>
    </form>
<?php else : ?>
<ul class="yt-login-regis">
	<li class="yt-login">
		<a 
                class="login-switch text-font" 
                href="<?php echo JRoute::_('index.php?option=com_users&view=login');?>" 
                onclick="showBox('yt_login_box','modlgn-username',this, window.event || event);return false;" 
                title="<?php JText::_('Login');?>">
        	<span class="title-link"><?php echo JText::_('JLOGIN'); ?></span>
        </a>
        <div id="yt_login_box" class="show-box" style="display:none;">

            <form id="login_form" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post">
                <?php if ($params->get('pretext')): ?>
                <div class="pretext">
                    <p><?php echo $params->get('pretext'); ?></p>
                </div>
                <?php endif; ?>
                <div class="inner"> 
                    <label for="modlgn-username" class="yt-login-user">
                        <span><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>: </span>
                        <input id="modlgn-username" type="text" name="username" class="inputbox"  size="25" />
                    </label>
                    <label for="modlgn-passwd" class="yt-login-password">
                        <span><?php echo JText::_('JGLOBAL_PASSWORD') ?>: </span>
                        <input id="modlgn-passwd" type="password" name="password" class="inputbox" size="25"  />
                    </label>
					<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
                    <input type="hidden" name="option" value="com_users" />
                    <input type="hidden" name="task" value="user.login" />
                    <input type="hidden" name="return" value="<?php echo $return; ?>" />
                    
                    <?php echo JHtml::_('form.token'); ?>
                </div>
                <ul class="yt-login-links clearfix">
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
                        <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
                        <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
                    </li>
					<?php
					$usersConfig = JComponentHelper::getParams('com_users');
					if ($usersConfig->get('allowUserRegistration')) : ?>
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
							<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
					</li>
					<?php endif; ?>
                </ul>
                <?php if ($params->get('posttext')): ?>
                <div class="posttext">
                    <p><?php echo $params->get('posttext'); ?></p>
                </div>
                <?php endif; ?>
            </form>
        </div>
	</li>
<?php
	$option = JRequest::getCmd('option');
	$task = JRequest::getCmd('task');
	if($option!='com_user' && $task != 'register') { ?>
	<li class="yt-register">
        <a 
                class="register-switch text-font" 
                href="<?php echo JRoute::_("index.php?option=com_users&task=registration");?>"
                onclick="showBox('yt_register_box','jform_name',this, window.event || event);return false;" >
            <span class="title-link"><span><?php echo JText::_('JREGISTER');?></span></span>
        </a>
		<script type="text/javascript" src="<?php echo JURI::base();?>media/system/js/validate.js"></script>
        <div id="yt_register_box" class="show-box" style="display:none"><div class="inner">
            <script type="text/javascript">
            <!--
                window.addEvent('domready', function(){
                    document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
                });
            // -->
            </script>         
            <form id="member_registration" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post">
                <label class="required yt-field-regis" for="jform_name" id="namemsg" title="Name&lt;br&gt;Enter your full name">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_NAME_LABEL' ); ?>
                    </span>				
                    <input type="text" size="25" class="inputbox required" value="" id="jform_name" name="jform[name]"/><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_username" id="usernamemsg">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_USERNAME_LABEL' ); ?>
                    </span>
                    <input type="text" size="25" class="inputbox validate-username required" value="" id="jform_username" name="jform[username]"/><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_password1" id="pwmsg">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_PASSWORD1_LABEL' ); ?>
                    </span>
                    <input type="password" size="25" class="inputbox validate-password required" value="" id="jform_password1" name="jform[password1]"/><span class="star">*</span>                     
                </label>
                <label title="" class="required yt-field-regis" for="jform_password2" id="pw2msg">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_PASSWORD2_LABEL' ); ?>
                    </span>
                    <input type="password" size="25" class="inputbox validate-password required" value="" id="jform_password2" name="jform[password2]"/><span class="star">*</span>
                </label>    
                <label title="" class="required yt-field-regis" for="jform_email1" id="emailmsg">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_EMAIL1_LABEL' ); ?>
                    </span>
                    <input type="text" size="25" class="inputbox validate-email required" value="" id="jform_email1" name="jform[email1]" /><span class="star">*</span>
                </label>
                <label title="" class="required yt-field-regis" for="jform_email2" id="email2msg">
                    <span>
                        <?php echo JText::_( 'COM_USERS_REGISTER_EMAIL2_LABEL'); ?>
                    </span>
                    <input type="text" size="25" class="inputbox validate-email required" value="" id="jform_email2" name="jform[email2]" /><span class="star">*</span>
                               
                </label>
                <span class="note">
                    <?php echo JText::_("ALL_FIELDS_ARE_REQUIRED"); ?>
            	</span>
            	<input type="submit" class="validate button" value="Register"  />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="registration.register" />
                <?php echo JHtml::_('form.token');?>
            </form>
    	</div></div>
    </li>
</ul>
<?php 
	} // End $option!='com_user' && $task != 'register'
endif; // End type=login(not logout)
}// End login for desktop 
?>