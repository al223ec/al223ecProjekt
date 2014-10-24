<h3> Blogginställningar </h3>
<form class="form-horizontal" action="<?php echo \core\Routes::getRoute('admin', 'saveSettings');  ?>" method="post" enctype="multipart/form-data" role="form">
<legend>Blogg</legend>
	<div class="form-group">
	    <label for="db_password" class="col-sm-2 control-label">Databas lösenord:</label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" id="db_password" name="<?php echo $dbPassword; ?>"  
        placeholder="Databas lösenord" value="<?php echo $bloggSettings->dbPassword; ?>" >
	    </div>
	</div>
	<div class="form-group">
    <label for="db_user_name" class="col-sm-2 control-label">Databas användare:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="db_user_name" name="<?php echo $dbUserName; ?>" 
       placeholder="Databas användare" value="<?php echo $bloggSettings->$dbUserName; ?>">
    </div>
  </div>

	<div class="form-group">
    <label for="db_name" class="col-sm-2 control-label">Databas namn:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="db_name" name="<?php echo $dbName; ?>" 
       placeholder="Databas namn" value="<?php echo $bloggSettings->$dbName; ?>">
    </div>
  </div>

	<div class="form-group">
    <label for="db_ip_address" class="col-sm-2 control-label">Databas adress:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="db_ip_address" name="<?php echo $dbIpAddress; ?>"  
      placeholder="Databas Ip-adress" value="<?php echo $bloggSettings->$dbIpAddress; ?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">Bloggposter per sida:</label>
		<div class="col-sm-2">
		<select class="form-control" name="<?php echo $bloggNumberOfBloggPostsPerPage; ?>">
      <?php 
      for ($i=0; $i < 5; $i++) { 
      $value = ($i +1) * 5;?> 
      <option value="<?php echo $value; ?>" <?php if($value == $bloggSettings->$bloggNumberOfBloggPostsPerPage) echo "selected"; ?>>
        <?php echo $value; ?> </option> 
      <?php } ?>
		</select>
		</div>
	</div>
<legend>Twitter</legend>
  <div class="form-group">
    <label for="oauth_access_token" class="col-sm-2 control-label">Oauth access token:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="oauth_access_token" name="<?php echo $oauthAccessToken; ?>" 
      placeholder="Oauth access token" value="<?php echo $twitterSettings->$oauthAccessToken; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="oauth_access_token_secret" class="col-sm-2 control-label">Oauth access secret:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="oauth_access_token_secret" name="<?php echo $oauthAccessTokenSecret; ?>" 
      placeholder="Oauth access token secret" value="<?php echo $twitterSettings->$oauthAccessTokenSecret; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="consumer_key" class="col-sm-2 control-label">Consumer key:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="consumer_key" name="<?php echo $consumerKey; ?>" 
       placeholder="Consumer key" value="<?php echo $twitterSettings->$consumerKey; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="consumer_secret" class="col-sm-2 control-label">Consumer secret:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="consumer_secret" name="<?php echo $consumerSecret; ?>"  
      placeholder="Consumer secret" value="<?php echo $twitterSettings->$consumerSecret; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Tweets som läses in:</label>
    <div class="col-sm-2">
    <select class="form-control" name="<?php echo $twitterNumberOfPosts; ?>">
      <?php for ($i=0; $i < 10; $i++) { 
        $value = ($i +1) * 10;?> 
        <option value="<?php echo $value; ?>" <?php if($value == intval($twitterSettings->$twitterNumberOfPosts)) echo "selected"; ?>>
          <?php echo $value; ?> </option> 
        <?php } ?>
    </select>

    </div>
  </div>

<legend>Instagram</legend>
  <div class="form-group">
    <label for="instagram_user_id" class="col-sm-2 control-label">Instagram user id:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="instagram_user_id" name="<?php echo $instagramUserId; ?>"  
      placeholder="Instagram user id"  value="<?php echo $instagramSettings->$instagramUserId; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="instagram_access_token" class="col-sm-2 control-label">Instagram access token:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="instagram_access_token" name="<?php echo $accessToken; ?>"  
      placeholder="Instagram access token" value="<?php echo $instagramSettings->$accessToken; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Instagram bilder:</label>
    <div class="col-sm-2">
    <select class="form-control" name="<?php echo $numberOfImages; ?>">
      <?php for ($i=0; $i < 10; $i++) { 
        $value = ($i +1) * 10;?> 
        <option value="<?php echo $value; ?>" <?php if($value == intval($instagramSettings->$numberOfImages)) echo "selected"; ?>>
          <?php echo $value; ?> </option> 
        <?php } ?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <p>Detta kan medföra att applikationen slutar fungera</p>
      <button type="submit" class="btn btn-default">Spara inställningar</button> <a class="btn btn-warning" href="<?php echo \core\Routes::getRoute('home','main'); ?>"> Avbryt</a>
    </div>
  </div>
</form>
<a class="btn btn-warning" href="<?php echo \core\Routes::getRoute('admin','resetSettings'); ?>"> Återställ</a>