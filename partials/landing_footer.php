<footer class="footer">
    <!-- Start Footer Top -->
    <div class="container">
        <div class="row row1">
            <div class="col-sm-9 clearfix">
                <div class="col-sm-6 ">
                    <h3>About US</h3>
                    <ul>
                        <li>
                            <a href="about.php">
                                <?php
                                /* Truncate About */
                                $about = $sys->sys_about;
                                echo substr($about, 0, 300); 
                                echo "...."
                                ?> 
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-sm-6">
                    <h3>Courses</h3>
                    <ul>
                        <?php
                        $ret = 'SELECT * FROM `iCollege_courses`  ORDER BY RAND()  LIMIT 5 ';
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($courses = $res->fetch_object()) { ?>
                            <li><a href="#"><?php echo $courses->name;?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="footer-logo hidden-xs"><a href=""><img src="../public/uploads/sys_logo/<?php echo $sys->sys_logo; ?>" height="200" width="200" class="img-responsive" alt=""></a></div>
                <p>© 2020 - <?php echo date('Y'); ?><span> <?php echo $sys->sys_name;?> </span>. All rights reserved. </p>
                <ul class="terms clearfix">
                    A <a href="https://devlan.martdev.info" target="_blank">DevLan Inc</a> Production
                </ul>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->

</footer>