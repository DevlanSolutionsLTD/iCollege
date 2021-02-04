<script src="../vendor/timetable/jquery/jquery-3.2.1.min.js"></script>

<script src="../vendor/timetable/bootstrap/js/popper.js"></script>
<script src="../vendor/timetable/bootstrap/js/bootstrap.min.js"></script>

<script src="../vendor/timetable/select2/select2.min.js"></script>

<script src="../public/js/main.js"></script>

<script async src="www.googletagmanager.com/gtag/jsa055?id=UA-23581568-13"></script>
<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
    <!-- Print tt -->
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>