<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jwplayer/jwplayer.js"></script>
        <script type="text/javascript">jwplayer.key = "JWPLAYERKEY";</script>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-theme.css" rel="stylesheet"/>


        <!-- Site specific CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdcast.css" rel="stylesheet"/>

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if (Yii::app()->user->isGuest): ?>
                        <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>"><?php echo Yii::app()->name; ?></a>
                    <?php else: ?>
                        <?php echo CHtml::link(Yii::app()->name, array('//report/index'), array('class' => 'navbar-brand')); ?>

                    <?php endif; ?>
                </div>
                <div class="navbar-collapse collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (User::isAdmin()) {
                            echo "<li>" . CHtml::link('Create Report', array('//report/create')) . "</li>";
                            echo "<li>" . CHtml::link('Users', array('//user')) . "</li>";
                        }

                        if (Yii::app()->user->isGuest) {
                            echo "<li>" . CHtml::link('Login', array('//site/login')) . "</li>";
                        } else {
                            echo "<li>" . CHtml::link('Profile', array('//user/view', 'id' => User::currentUser()->id)) . "</li>";
                            echo "<li>" . CHtml::link('Logout (' . User::currentUser()->username . ')', array('//site/logout')) . "</li>";
                        }
                        ?>
                    </ul>
                </div><!--/.navbar-collapse -->
            </div>
        </div>



        <div class="container">
            <?php echo $content; ?>
        </div> <!-- /container -->

        <hr>
        <div class="container">
            <div class="col-xs-10 center-block">
                <p>&copy; Screencast Management System 2014</p>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>

</body>
</html>
