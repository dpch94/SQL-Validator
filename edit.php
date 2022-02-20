<?php include 'logic.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=DM+Serif+Display&family=Inria+Serif:wght@700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300&family=Lora&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=PT+Serif:wght@700&family=Roboto+Serif&display=swap" rel="stylesheet">
    

    <link rel ="stylesheet" href="CSS/style.css">
</head>

<body>
<div class="concenter">
    <header>
        <div class="logo">
            <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
        </div>
    
    </header>

    <div class="page-wrapper">
        <div class="container mt-5">
            <?php foreach($query as $q){?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" hidden name="id" style="border:1px solid blue; margin:60px;"value="<?php echo $q['id'];?>">
                    <input type="text" name="subject" placeholder="Blog Subject" class="form-control bg-dark text-white my-3" style="margin:60px 20px; width:60%; height: 60px; font-size: 1.5em;" value="<?php echo $q['subject']?>">
                    <h4>Description</h4>
                    <textarea name="description" class="form-control bg-dark text-white my-3" style="margin:20px 20px; width:60%; height: 450px; font-size: 1.3em;"><?php echo $q['description']?></textarea>
                    <!-- <textarea name="description" class="form"><?php echo $q['description']?></textarea> -->
                    <!-- <div id="image_content">
                        <label>Attachment</label>
                        <input type="file" name="uploadfile" value="" />
                        <div>
                            <button type="submit"
                                    name="upload" style="display: none;">
                            Upload
                            </button>
                        </div>
                    </div> -->
                    <button name="update" class="btn btn-dark" style=" position:absolute ; left:600px; bottom:220px; text-align:center; width: 140px; height: 40px;">Update</button>
                    
                    <button formaction="index.php" class="btn btn-dark" style=" position:absolute ; left:600px; bottom:160px; text-align:center; width: 140px; height: 40px;">Cancel</button>
                    <div style=" position:absolute ; left:18px;">
                        <h4>Before adding your lines, Please add your name in description after the existing lines written by creator, while editing the post.</h4>
                        <h3>For example,</h3>
                        <h3> Student2:</h3>
                        <h3>I would like to add that...<h3>
                        <br>
                        <br>
                    </div>

                </form>
            <?php }?> 
        </div>          
    </div>

</div>

</body>
</html>

<script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--<script src="js/scripts.js"></script>-->
