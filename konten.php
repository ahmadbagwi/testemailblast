<?php
//query sql memeriksa semua tabel main dan micro site
//file ini tidak dipakai lagi, diganti dengan body.php menggunakan kueri wordpress yang lebih singkat dan tepat
$sqlkonten = "SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_5_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_6_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_7_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_8_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_9_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_10_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_11_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_12_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_13_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_14_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_15_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_16_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_17_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_18_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_19_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_20_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_22_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_24_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_26_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_27_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_28_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_29_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_30_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_31_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_32_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_33_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_34_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_35_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_36_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_37_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_38_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_39_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_58_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_59_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_60_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_61_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_63_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_64_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish' UNION 
		SELECT post_date, post_title, guid FROM abdulhadi_kebudayaan.kbd_posts WHERE post_date_gmt LIKE '$hari%' AND post_status='publish'";

$result = $conn->query($sqlkonten);

if ($result->num_rows > 0) {
   	while($row = $result->fetch_assoc()) {
   	$data = $row['post_date']." | " . "<a href='".$row['guid']."'target='_blank'".">".$row["post_title"]."</a>"."<br>";
   	$simpandata[]=$data;
    	}
	} else {
    echo "0 results";
	}
?>