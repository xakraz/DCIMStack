<?php
include 'libraries/db.php';
include 'libraries/events.php';
include 'libraries/general.php';
$page_referrer = $_POST['page_referrer'];
$device_brand = $_POST['device_brand'];
$device_type = $_POST['device_type'];
$device_location = $_POST['device_location'];
$device_label = $_POST['device_label'];
$device_serial = $_POST['device_serial'];
$device_capacity = $_POST['device_capacity'];
$device_mac = $_POST['device_mac'];
$device_ram_total = $_POST['device_ram_total'];
$device_cpu_count = $_POST['device_cpu_count'];
$device_power_usage = $_POST['device_power_usage'];
$device_power_feed1 = $_POST['device_power_feed1'];
$device_power_feed2 = $_POST['device_power_feed2'];
$device_cpu = $_POST['device_cpu'];
$device_rack_position = $_POST['device_rack_position'];
$device_size = $_POST['device_size'];
$device_notes = $_POST['device_notes'];
$device_dop = $_POST['device_dop'];
$device_warranty = $_POST['device_warranty'];
if(empty($device_size)) $device_size=0;
$sql = "INSERT INTO `dcimstack`.`devices`
(`device_id`, `rackid`, `device_type`, `device_label`, `device_brand`, `device_serial`, `device_mac`, `device_ram_total`, `device_capacity`, `device_cpu_count`, `device_power_usage`, `device_power_feed1`, `device_power_feed2`, `device_cpu`, `device_rack_position`, `device_size`, `device_warranty`,`device_dop`,`device_notes`)
VALUES
(NULL,
	'$device_location',
	'$device_type',
	'$device_label',
	'$device_brand',
	'$device_serial',
	'$device_mac',
	'$device_ram_total',
	'$device_capacity',
	'$device_cpu_count',
	'$device_power_usage',
	'$device_power_feed1',
	'$device_power_feed2',
	'$device_cpu',
	'$device_rack_position',
	'$device_size',
	'$device_dop',
	'$device_warranty',
	'$device_notes');";

	if ($conn->query($sql) === TRUE) {
		$rack_name = get_rack_name($device_location);
		//echo "New record created successfully";
		$event_type = "New $device_type added";
		$event_message = "A new $device_type was added to $rack_name";
		$event_status = "Complete";
		add_event($event_type, $event_message, $event_status);
		$conn->close();
		header("Location: $page_referrer");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	?>