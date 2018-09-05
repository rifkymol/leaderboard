
<html lang="en">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">No</th>
								<th class="column2">Nama</th>
								<th class="column3">Time</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                $i = 0;
                                $i++;

                                foreach ($datas as $key => $v):
                                    $username = $v['username'];
                            ?>
								<tr>
									<td class="column1"><?php echo $key+1 ?></td>
									<td class="column2"><?php echo $username ?></td>
									<td class="column3"><p id="<?php echo $username ?>"></p></td>
                                </tr>
                            <?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="assets/js/main.js"></script>
    
    <script>

$(function(){
    <?php 
        foreach ($datas as $v){
            if ($v['url_wakatime']!=''){
                echo "getWakatime('$v[username]','$v[url_wakatime]');\n";
            }
        }  
    ?>
});

function secondsToHms(d) {
	d = Number(d);
	var h = Math.floor(d / 3600);
	var m = Math.floor(d % 3600 / 60);
	var s = Math.floor(d % 3600 % 60);

	var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
	var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
	var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
	return hDisplay + mDisplay + sDisplay; 
}

function getWakatime(username,url) {
	$.ajax({
		type: 'GET',
		url: url,
		dataType: 'jsonp',
		success: function(response) {
		var detik = 0;
		var rata2detik;
		var totaldata = response.data.length;
			for( key in response.data ){
			detik = detik+response.data[key].grand_total.total_seconds;
			}
			rata2detik = detik/totaldata;
			var jam = secondsToHms(rata2detik);
			$('#'+username).html(jam);

            var rank = $('#'+username).html(detik);
            
            console.log(rank.sort(function(a, b){return a-b}));
        },
    });
}
</script>

</body>
</html>