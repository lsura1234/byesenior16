<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>เช็คสถานะ</title>
  </head>
  <body>
    <?
$hostname = "localhost";
$username = "root";
$password = "123456789";
$dbname = "byesenior-2";
$conn = mysqli_connect( $hostname, $username, $password,$dbname );
if ( ! $conn ) die ( "การเชื่อต่อ Database ผิดพลาด" );
  $student_id=$_POST["student_id"];
  $sql ='select * from student a join booked b on a.book_id=b.book_id where student_id="'.$student_id.'"';
 $result= mysqli_query($conn,$sql);

$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($data>0) {
        $name=$data["student_name"];
        $lastname=$data["student_lastname"];
        $table=$data["table_id"];
        $status=$data["status_promptpay"];
        ?>
        <table>
          <tr>
            <td>ชื่อ</td>
            <td><? echo $name?></td>
          </tr>
          <tr>
            <td>สกุล</td>
            <td><? echo $lastname?></td>
          </tr>
          <tr>
            <td>คุณนั่งโต๊ะ</td>
            <td><? echo $table?></td>
          </tr>
          <tr>
            <td>สถานะการชำระเงิน</td>
            <td>
                  <?
                    if(strtolower($status)=="waitpay") echo "รอการชำระเงิน";
                    else echo "ชำระเงินแล้ว";
                  ?>
            </td>
          </tr>
        </table>

        <?
}
else{?>
  <script type="text/javascript">
window.location.replace("sign.php");
</script>
<?
}
mysqli_close($conn);

?>

  </body>
</html>
