<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raymond Yan's Course Planner</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<script>
    var $course;
    var newName;
    var oldName;
    $( document ).ready(function() {
        $("input[type='checkbox']").change(function(){
            var parent = $(this).parent();
            parent.toggleClass("checked");
            $data = {courseName: this.id, completed:this.checked}
            $.post("/manager.php",$data);
        });

        $('.changeable').on('focus', function() {
            before = $(this).html();
            }).on('blur paste', function() { 
                if (before != $(this).html()) 
                { 
                    oldName=before;
                    newName=$(this).html();
                    $(this).trigger('change');
                }
        });
        $('.changeable').on('change',function(){
            $data = {courseName:oldName, newCourseName:newName}
                    console.log($data);
                    $.post("/manager.php",$data);
        });
    });
</script>
<body>
    <div id="container">
        <div id="header">
            <header>
                <p>Raymond Yan's Course Planner</p>
            </header>
        </div>
        <div id="banner">
            <img src="../images/banner.jpg" alt="banner">
        </div>

        <div id="body">
            <div id="content">
                <div id="changeBanner">
                    <form action="./manager.php" method="post" enctype="multipart/form-data">
                        Select an image to change the banner:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
                <h1>My Courses</h1>
                <form action="./manager.php" method="post">
                    <input type="text" name="course_name" id="course_name" placeholder="Type course name here">
                    <input type="submit" value="ADD">
                </form>

                <br>
                <div id="courses">
                    
                        <form method="post" action="./manager.php">
                        <div id="course_list">
                        <?php
                              include("./manager.php");
                              $list = get_list();
                              
                              if (count($list)>0) {
                                for($x=0;$x<count($list);$x++){
                                    $y = $list[$x]['courseName'];
                                    $checked = $list[$x]['completed'];
                                    if($checked){
                                        echo "<div class='course_box checked'><input type='checkbox' name='$y' value='$y' id='$y' checked > " .
                                        "<div class='changeable' contenteditable='true'>$y</div>" . 
                                        "<input type='submit' name='$y' value='Delete'></div><br>";
                                    }
                                    else{
                                        echo "<div class='course_box'><input type='checkbox' name='$y' value='$y' id='$y'>". 
                                        "<div class='changeable' contenteditable='true'>$y</div>" .
                                        "<input type='submit' name='$y' value='Delete'></div><br>";
                                    }
                                }
                              }
                        ?>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>