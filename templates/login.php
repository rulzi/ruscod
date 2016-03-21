<?php $this->layout('layouts/app') ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <?php
                        if ($errors) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo "<ul>";
                            foreach ($errors as $value) {
                                foreach ($value as $row) {
                                    echo "<li>".$row."</li>";
                                }
                            }
                            echo "</ul>";
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if (!empty($this->getSession('message'))) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo $this->getSession('message');
                            echo '</div>';
                        }
                    ?>
                    <form class="form-horizontal" role="form" method="POST" action="<?= $this->urlGenerator('dologin') ?>">
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>