<?php
    // 开启启session
    session_start();

  // 判断提交方式
  if(empty($_SESSION['num']) || empty($_POST['num'])){ //判断提交数据
    // 生成随机数
    $num = rand(0,100);

    // 把随机数加到session中
    $_SESSION['num'] = $num;
  }else{//用户提交表单里面的数字

    // 十次机会
    $count = empty($_SESSION['count']) ? 0 : $_SESSION['count'];

    // 获取用户在表单里面输入的数据
    $jieguo = $_POST['num']; 


    // 判断10次机会
    if ($count < 10) {
      // 对比用户提交的数字和用户在 session 中存放的被猜的数字
      // $_GET['num'] => 用户试一试的数字
      // $_SESSION['num'] => 被猜的数字

      //用户输入的结果减去系统产生的随机数
      $result = (int)$_POST['num'] - $_SESSION['num'];

      // 判断用户输入的结果减去系统产生的随机数是否等于0； 等于0：猜对了， 大于0：猜大了，小于0：猜小了， 
      if ($result == 0) {

        $message = '猜对了';
      // 猜对了 重置数据
        unset($_SESSION['num']);
        unset($_SESSION['count']);

      } elseif ($result > 0) {

        $message = '太大了';

      } else {

        $message = '太小了';

      }

      $_SESSION['count'] = $count + 1;
    } else {

      // 游戏结束
      $message = '真是大笨蛋!';

      // 10次机会用完 重置数据
      unset($_SESSION['num']);
      unset($_SESSION['count']);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>猜数字</title>
  <style>
    body {
      padding: 100px 0;
      background-color: #2b3b49;
      color: #fff;
      text-align: center;
      font-size: 2.5em;
    }
    input {
      padding: 5px 20px;
      height: 50px;
      background-color: #3b4b59;
      border: 1px solid #c0c0c0;
      box-sizing: border-box;
      color: #fff;
      font-size: 20px;
    }
    button {
      padding: 5px 20px;
      height: 50px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <h1>猜数字游戏</h1>
  <p>Hi，我已经准备了一个0~100的数字，你需要在仅有的10机会之内猜对它。</p>
  <!-- 输出判断 -->
  <?php if (isset($message)): ?>
  <p><?php echo $message; ?></p>
  <?php endif ?>
  <form action="Bulls and Cows.php" method="post">
    <input type="number" min="0" max="100" name="num" placeholder="随便猜">
    <button type="submit">试一试</button>
  </form>
  <!-- 输出用户上次输的结果 -->
  <?php if (isset($jieguo)): ?>
  <p><?php echo '上次输入:' . $jieguo; ?></p>
  <?php endif ?>
</body>
</html>
