<?php
include 'database.php';
include 'sub_division_operation.php';

$database = new Database();
$db = $database->connect();

$sub_division = new Sub_division_operation($db);

$result = $sub_division->read();

$data = $result->fetchAll(PDO::FETCH_ASSOC);
//print_r($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Wpoets</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

body{
    margin:0;
    background:#10324D;
    font-family:Arial, sans-serif;
}

/* SECTION */
.section-wrap{
    padding:70px 8%;
    color:#fff;
}

.section-title{
    text-align:center;
    margin-bottom:50px;
}

.section-title h1{
    font-size:52px;
    font-weight:300;
    margin-bottom:20px;
}

.section-title p{
    font-size:20px;
    color:#c7d1db;
}

/* MAIN GRID */
.custom-layout{
    display:flex;
    min-height:520px;
}

/* COLUMN 1 */
.tabs-column{
    width:28%;
    background:#efefef;
    padding:25px;
}

.tab-btn{
    width:100%;
    background:#fff;
    border:none;
    margin-bottom:20px;
    padding:28px 25px;
    text-align:left;
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    border-radius:4px;
    transition:0.3s;
}

.tab-btn.active{
    position:relative;
}

.tab-btn.active::after{
    content:'';
    position:absolute;
    right:-15px;
    top:50%;
    transform:translateY(-50%);
    border-top:15px solid transparent;
    border-bottom:15px solid transparent;
    border-left:15px solid #fff;
}

.tab-left{
    display:flex;
    align-items:center;
    gap:18px;
}

.tab-icon{
    font-size:38px;
}

.tab-title{
    font-size:22px;
    font-weight:bold;
    color:#444;
}

.plus{
    font-size:34px;
    color:#d84835;
}

/* COLUMN 2 */
.slider-column{
    width:36%;
    position:relative;
    overflow:hidden;
}

.slide{
    display:none;
    background:#73c2d7;
    height:100%;
    color:#fff;
    padding:60px 40px;
    text-align:center;
    align-items:center;
    justify-content:center;
    flex-direction:column;
}

.slide.active{
    display:flex;
}

.tag{
    background:rgba(0,0,0,0.15);
    padding:8px 18px;
    border-radius:4px;
    font-size:13px;
    margin-bottom:25px;
}

.slide h2{
    font-size:36px;
    line-height:1.5;
    margin-bottom:35px;
}

.learn-btn{
    color:#fff;
    text-decoration:none;
    font-size:24px;
    font-weight:bold;
}

/* CONTROLS */
.slider-controls{
    position:absolute;
    bottom:25px;
    left:50%;
    transform:translateX(-50%);
}

.dot{
    width:14px;
    height:14px;
    border:2px solid #fff;
    border-radius:50%;
    display:inline-block;
    margin:0 5px;
    cursor:pointer;
}

.dot.active{
    background:#fff;
}

/* COLUMN 3 */
.image-column{
    width:36%;
}

.image-column img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:none;
}

.image-column img.active{
    display:block;
}

/* MOBILE ACCORDION */
.mobile-accordion{
    display:none;
}

/* MOBILE VIEW */
@media(max-width:768px){

    .section-wrap{
        padding:40px 15px;
    }

    .section-title h1{
        font-size:34px;
    }

    .section-title p{
        font-size:18px;
        line-height:1.6;
    }

    .custom-layout{
        display:none;
    }

    .mobile-accordion{
        display:block;
    }

    .accordion-item-custom{
        margin-bottom:20px;
    }

    .accordion-header-custom{
        background:#fff;
        color:#333;
        padding:22px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        cursor:pointer;
        border-radius:4px;
    }

    .accordion-left{
        display:flex;
        align-items:center;
        gap:15px;
    }

    .accordion-title{
        font-size:22px;
        font-weight:bold;
    }

    .accordion-content{
        display:none;
        position:relative;
        overflow:hidden;
        margin-top:10px;
    }

    .accordion-content.active{
        display:block;
    }

    .mobile-slide{
        background-size:cover;
        background-position:center;
        padding:80px 25px;
        text-align:center;
        color:#fff;
        position:relative;
    }

    .mobile-slide::before{
        content:'';
        position:absolute;
        inset:0;
        background:rgba(115,194,215,0.78);
    }

    .mobile-slide-inner{
        position:relative;
        z-index:2;
    }

    .mobile-slide h2{
        font-size:34px;
        line-height:1.4;
        margin:25px 0;
    }

    .mobile-controls{
        margin-top:30px;
    }
}

</style>
</head>

<body>

<section class="section-wrap">

    <div class="section-title">
        <h1>DelphianLogic in Action</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
            Aenean commodo
        </p>
    </div>

    <!-- DESKTOP -->
    <div class="custom-layout">

        <!-- COLUMN 1 -->
        <div class="tabs-column">

        <?php 
        $count = 0;
        foreach($data as $row) {
             $active = ($count == 0) ? 'active' : '';
             ?>

            <button class="tab-btn <?php echo $active; ?>" data-slide="<?php echo $count; ?>">
                <div class="tab-left">
                    <div class="tab-icon"><img src="<?php echo $row['icon_img']; ?>" width="50"></div>
                    <div class="tab-title"><?php echo $row['division_name']; ?></div>
                </div>
                <!-- <div class="plus">−</div> -->
            </button>

        <?php $count++; } ?>

        </div>

        <!-- COLUMN 2 -->
        <div class="slider-column">

        <?php 
        $count = 0;
        foreach($data as $rows) {

         $active = ($count == 0) ? 'active' : '';

             ?>
            <div class="slide <?php echo $active; ?>">
                <div class="tag"><?php echo $rows['slider_sub_text']; ?></div>

                <h2><?php echo $rows['slider_text']; ?></h2>

                <a href="#" class="learn-btn">
                    Learn More <img src="images/arrow-right.svg" width="30">
                </a>
            </div>

            <?php $count++; } ?>

            <!-- Controls -->
            <div class="slider-controls">
                <?php 
                    $count = 0;
                    foreach($data as $row) {
                    $active = ($count == 0) ? 'active' : '';
                ?>
                <span class="dot <?php echo $active; ?>" data-slide="<?php echo $count; ?>"></span>
                <?php $count++; } ?>
               
            </div>

        </div>

        <!-- COLUMN 3 -->
        <div class="image-column">

            <?php 
                $count = 0;
                foreach($data as $rows) {
                $active = ($count == 0) ? 'active' : '';
            ?>
                <img class="<?php echo $active; ?>" src="<?php echo $rows['slider_image']; ?>">

            <?php $count++; } ?>
        </div>

    </div>

    <!-- MOBILE -->
    <div class="mobile-accordion">

        <?php 
            $count = 0;
            foreach($data as $rowMob) {
            $active = ($count == 0) ? 'active' : '';
            $collapseImg = ($count == 0) ? '<img src="images/minus-01.svg" width="30">': '<img src="images/plus-01.svg" width="30">';
        ?>
        <!-- ITEM 1 -->
        <div class="accordion-item-custom collapse-section">

            <div class="accordion-header-custom">
                <div class="accordion-left">
                    <div class="tab-icon"><img src="<?php echo $rowMob['icon_img']; ?>" width="50"></div>
                    <div class="accordion-title"><?php echo $rowMob['division_name']; ?></div>
                </div>

                <div class="plus" ><?php echo $collapseImg; ?></div>
            </div>

            <div class="accordion-content collapse <?php echo ($count == 0) ? 'in' : ''; ?>">

                <div class="mobile-slide"
                style="background-image:url('<?php echo $rowMob["slider_image"]; ?>')">

                    <div class="mobile-slide-inner">

                        <div class="tag">
                            <?php echo $rowMob['slider_sub_text']; ?>
                        </div>

                        <h2><?php echo $rowMob['slider_text']; ?></h2>

                        <a href="#" class="learn-btn">
                            Learn More <img src="images/arrow-right.svg" width="30">
                        </a>

                        <div class="mobile-controls">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php $count++; } ?>

    </div>

</section>

<script>

$(document).ready(function () {

    $('.collapse-section').click(function () {

        var currentSection = $(this)
            .closest('.accordion-item-custom')
            .find('.accordion-content');

        $('.accordion-content').not(currentSection).collapse('hide');

        currentSection.collapse('toggle');

    });

    $('.accordion-content').on('shown.bs.collapse', function () {

        $(this)
            .closest('.accordion-item-custom')
            .find('.plus')
            .html('<img src="images/minus-01.svg" width="30">');

    });

    $('.accordion-content').on('hidden.bs.collapse', function () {

        $(this)
            .closest('.accordion-item-custom')
            .find('.plus')
            .html('<img src="images/plus-01.svg" width="30">');

    });

});

const tabs = document.querySelectorAll('.tab-btn');
const slides = document.querySelectorAll('.slide');
const images = document.querySelectorAll('.image-column img');
const dots = document.querySelectorAll('.dot');

function showSlide(index){

    slides.forEach(slide => slide.classList.remove('active'));
    images.forEach(img => img.classList.remove('active'));
    tabs.forEach(tab => tab.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    slides[index].classList.add('active');
    images[index].classList.add('active');
    tabs[index].classList.add('active');
    dots[index].classList.add('active');
}

tabs.forEach(tab => {

    tab.addEventListener('click', function(){

        let index = this.getAttribute('data-slide');
        showSlide(index);

    });

});

dots.forEach(dot => {

    dot.addEventListener('click', function(){

        let index = this.getAttribute('data-slide');
        showSlide(index);

    });

});

</script>

</body>
</html>