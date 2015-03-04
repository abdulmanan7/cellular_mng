<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
             <?php $this->load->view('template/navigation');?>
<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
      <?php $this->load->view('template/vertical-nav');?>
        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>Error pages</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="list-group">
                        <a href="403.html" class="list-group-item list-group-item-warning">403 error page</a>
                        <a href="404.html" class="list-group-item list-group-item-success">404 error page</a>
                        <a href="500.html" class="list-group-item list-group-item-danger">500 error page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Bootstrap 3.x Admin Theme</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
</body>
</html>
