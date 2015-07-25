<?php include 'header.php'; ?>
<!-- modalLoginEnd -->
    <section class="slider" style="margin:auto">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>
		
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img class="img img-responsive" src="images/bg3.jpg" alt="Responsive image" style="margin:auto">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		    <!-- <div class="item ">
		      <img src="images/bg2.jpg" alt="">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>-->
		   
		  	    
		  </div>
		
		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
    </section><!--/#main-slider-->

    <section id="services">
        <div class="container">
            <div>
                <div class="row col-md-12" id="ideasList">
                    <?php
                    
					$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit 6");
					
					while ($row=mysqli_fetch_assoc($query)){
						?>
						<div class="col-md-4 col-sm-6">
                        <div class="center"> 
                           <a href="userProfile.php?id=<?php echo $row['UserID'] ?>" ><img src="images/UserImg/<?php echo $row['Image'] ?>" class="icon-md"></a>
                            <a href="ideaDetails.php?ideaId=<?php echo $row['IdeaID'] ?>" style="color:gray !important;"><h4><?php echo $row['Title'] ?></h4>
                            <p><?php echo substr($row['Description'],0,30)?></p></a>
                        </div>
                    </div>
					<?php } ?>
                    
                  
                   
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="portfolio">
        <div class="container">
            <div class="box">
                <div class="center gap">
                    <h2>Portfolio</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac<br>turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
                </div><!--/.center-->
                <ul class="portfolio-filter">
                    <li><a class="btn btn-primary active" href="#" data-filter="*">All</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".bootstrap">Bootstrap</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".html">HTML</a></li>
                    <li><a class="btn btn-primary" href="#" data-filter=".wordpress">Wordpress</a></li>
                </ul><!--/#portfolio-filter-->
                <ul class="portfolio-items col-4">
                    <li class="portfolio-item apps">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item1.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item1.jpg"><i class="icon-eye-open"></i></a>             
                                </div>
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla bootstrap">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item2.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item2.jpg"><i class="icon-eye-open"></i></a>  
                                </div>
                            </div> 
                            <h5>Lorem ipsum dolor sit amet</h5>         
                        </div>
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item bootstrap wordpress">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item3.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item3.jpg"><i class="icon-eye-open"></i></a>        
                                </div> 
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>          
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla wordpress apps">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item4.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item4.jpg"><i class="icon-eye-open"></i></a>          
                                </div>   
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>        
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item5.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item5.jpg"><i class="icon-eye-open"></i></a>          
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>  
                        </div>       
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item wordpress html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item6.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item6.jpg"><i class="icon-eye-open"></i></a>           
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>         
                        </div>           
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item joomla html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item5.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item5.jpg"><i class="icon-eye-open"></i></a>          
                                </div>  
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>  
                        </div>       
                    </li><!--/.portfolio-item-->
                    <li class="portfolio-item wordpress html">
                        <div class="item-inner">
                            <div class="portfolio-image">
                                <img src="images/portfolio/thumb/item6.jpg" alt="">
                                <div class="overlay">
                                    <a class="preview btn btn-danger" title="Lorem ipsum dolor sit amet" href="images/portfolio/full/item6.jpg"><i class="icon-eye-open"></i></a>           
                                </div>   
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>        
                        </div>         
                    </li><!--/.portfolio-item-->
                </ul>   
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#portfolio-->
	<div id="dodajideja">
	    <section >
        <div class="container">
            <div class="box">
               
            </div> 
        </div>
    </section><!--/#pricing-->
   </div>

    <section id="about-us">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Meet the Team</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et<br>malesuada fames ac turpis egestas.</p>
                </div>
                <div class="gap"></div>
                <div id="team-scroller" class="carousel scale">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team1.jpg" alt="" ></p>
                                        <h3>Agnes Smith<small class="designation">CEO &amp; Founder</small></h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team2.jpg" alt="" ></p>
                                        <h3>Donald Ford<small class="designation">Senior Vice President</small></h3>
                                    </div>
                                </div>        
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team3.jpg" alt="" ></p>
                                        <h3>Karen Richardson<small class="designation">Assitant Vice President</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team3.jpg" alt="" ></p>
                                        <h3>David Robbins<small class="designation">Co-Founder</small></h3>
                                    </div>
                                </div>   
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team1.jpg" alt="" ></p>
                                        <h3>Philip Mejia<small class="designation">Marketing Manager</small></h3>
                                    </div>
                                </div>     
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="images/team2.jpg" alt="" ></p>
                                        <h3>Charles Erickson<small class="designation">Support Manager</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left-arrow" href="#team-scroller" data-slide="prev">
                        <i class="icon-angle-left icon-4x"></i>
                    </a>
                    <a class="right-arrow" href="#team-scroller" data-slide="next">
                        <i class="icon-angle-right icon-4x"></i>
                    </a>
                </div><!--/.carousel-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <section id="contact">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Contact Form</h1>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-lg">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h1>Our Address</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                        </div>
                        <h1>Connect with us</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-facebook icon-social"></i> Facebook</a></li>
                                    <li><a href="#"><i class="icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <li><a href="#"><i class="icon-pinterest icon-social"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="#"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <img class="pull-right" src="images/shapebootstrap.png" alt="ShapeBootstrap" title="ShapeBootstrap">
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

   
    
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script> 
    <script>
	  
	  $('li.dropdown.mega-dropdown a').on('click', function (event) {
    	$(this).parent().toggleClass('open');
    
	  });
	  $('body').on('click', function (e) {
    	if (!$('li.dropdown.mega-dropdown').is(e.target) && $('li.dropdown.mega-dropdown').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
        	$('li.dropdown.mega-dropdown').removeClass('open');
    	}
	  });
	  
    </script>
</body>
</html>