<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bootstrap 3 Navigation</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            min-height: 1000px;
            padding-top: 50px;
        }
        .example{
            margin: 5px;
        }

    </style>
</head>
<body>
<div class="main">
    <div class="container">
        <div class="row ">
            <nav class="navbar navbar-default " role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://localhost/lokisnkrs/">
                        <img src="http://localhost/lokisnkrs//upload/Home_24px.png" style="padding-left:5px;"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-tabs nav-justified navbar-static-top" style="padding-top:8px; font-size:14px;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($category as $row):?>
                                <li><a href="<?php echo base_url('category/get_items/'.$row->id);?>"><?php echo $row->name;?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
        <div id="wrapper">

                <div class="row">
                    <?php $this->load->view('left',$this->data);?>
                    <?php $this->load->view('right',$this->data);?>


                </div>
            </div>
        </div>

</div>

</body>
</html>