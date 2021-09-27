<?php

?>

<footer>		
    <div class="footer-blurb">
        <div class="container">
            <p>Copyright &copy; BharatContacts.com 2007-2021. <a href="http://www.softwaresathi.com" target="_blank">www.softwaresathi.com</a> | Softwaresathi Solutions LLP. Contact us @ 7028396339.</p>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
	
<!-- Placeholder Images -->
<script src="js/holder.min.js"></script>
<script src="js/select2.min.js"></script>

<!-- Datetime Picker -->
<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>

<!-- Placeholder Images -->
<script src="js/holder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js" charset="UTF-8"></script>

<script>
    function userLogOut() {
            
        $.ajax({
            type: 'POST',
            url: 'process/loginAction.php',
            data: {"action":"logOut"},
            async: false,
            dataType: "json",
            success: function(data) {
                if (data.status == 200) {
                    window.location.href = "./";
                } else {
                    $('#alertData').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">' + data.msg + '</a></div>');
                }
            }
        });
    }
</script>