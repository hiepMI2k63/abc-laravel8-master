
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn h&#224;ng</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/tryitnow/Styles/jumbotron-narrow.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/tryitnow/Styles/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/tryitnow/Styles/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body style="font-size: 0.9rem;">
{{$slot}}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/tryitnow/Styles/js/ie10-viewport-bug-workaround.js"></script>

<link href="https://pay.vnpay.vn/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://pay.vnpay.vn/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function () {
            var postData = $("#frmCreateOrder").serialize();
            var submitUrl = $("#frmCreateOrder").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function (x) {
                    if (x.code === '00') {
                        if (window.vnpay)
                        {
                            vnpay.open({ width: 768, height: 600, url: x.data });
                        }
                        else
                        {
                            window.location = x.data;
                        }
                        return false;
                    } else {
                        alert("Error:" + x.Message);
                    }
                }
            });
            return false;
        });
    </script>



</body>
</html>
