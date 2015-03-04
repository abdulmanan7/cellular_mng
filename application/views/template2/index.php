    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    Press enter key or click the Submit button
                </div>
                <form method="post" action="about.html" class="bootstrap-admin-login-form">
                    <h1>Login</h1>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="remember_me">
                            Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
    // Setting focus
    $('input[name="email"]').focus();

    // Setting width of the alert box
    var alert = $('.alert');
    var formWidth = $('.bootstrap-admin-login-form').innerWidth();
    var alertPadding = parseInt($('.alert').css('padding'));

    if (isNaN(alertPadding)) {
        alertPadding = parseInt($(alert).css('padding-left'));
    }

    $('.alert').width(formWidth - 2 * alertPadding);
});
    </script>
</body>
</html>
