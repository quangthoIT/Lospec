<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../config/config.php');
    require('../../lib/carbon/autoload.php');
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    if (isset($_POST['thoigian'])) {
        $thoigian = $_POST['thoigian'];
    } else {
        $thoigian = '';
    }
    
    switch ($thoigian) {
        case '7ngay':
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
            break;
        case '30ngay':
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
            break;
        case '90ngay':
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
            break;
        case '365ngay':
        default:
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
            break;
    }
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN '$subdays' AND '$now' ORDER BY ngaydat ASC";
    $sql_query = mysqli_query($mysqli,$sql);

    while($val = mysqli_fetch_array($sql_query)){

        $chart_data[] = array(
            'date' =>$val['ngaydat'],
            'order' =>$val['donhang'],
            'sales' =>$val['doanhthu'],
            'quantity' =>$val['soluongban']
        );
    }
    // print_r($chart_data);
    echo $json_data = json_encode($chart_data);


?>