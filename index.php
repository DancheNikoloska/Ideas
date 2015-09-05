  <!-- load more results -->
	<script type="text/javascript">
	
	
	function loadmore()
	{
		//alert(document.getElementById("result_no").value);
	  var val = document.getElementById("result_no").value;
	  
	  $.ajax({
	  type: 'post',
	  url: 'fetch.php',
	  data: {
	  getresult:val,
	  "order": document.getElementById("orderFilter").value
	  },
	  success: function (response) {
	    var content = document.getElementById("result_para");
	    content.innerHTML = content.innerHTML+response;
	
	    // We increase the value by 6 because we limit the results by 6
	    document.getElementById("result_no").value = Number(val)+6;
	  }
	  });
	}
	</script>
	<script>
		function getdata(str,str2){
			$.ajax({
				type:'post',
				url:'search.php',
				data:{"sending":str,"orderIdeas":str2},
				success:function(data){document.getElementById("result_para").innerHTML=data;
				
				}
				
				
			});
		}
	</script>
	
<!-- load more results end -->

<!-- order by -->
<script>
		function orderBy(str,str2){
			$.ajax({
				type:'post',
				url:'search.php',
				data:{"orderIdeas":str,"sending":str2},
				success:function(data){document.getElementById("result_para").innerHTML=data;
				document.getElementById("result_no").value= 6;}
				
				
			});
		}
	</script>

<?php include 'header.php'; 
//echo $_SESSION['user'];
?>
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
		    <div class="item active" style="width: 100%; height: 100%;">
		    
		  
		     <img class="img img-responsive" src="images/final.png" alt="Responsive image" "> 
		    
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		  <!--   <div class="item ">
		      <img src="" alt="">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		       <div class="item ">
		      <img src="" alt="">
		      <div class="carousel-caption">
		        
		      </div>
		    </div> -->
		 
		   
		  	    
		  </div>
		</div>
    </section><!--/#main-slider-->

    <section id="ideas">
        <div class="container">
            <div><br /><br />
            	<div class="row">
            	<div class="col-md-12">
            	<div class="input-group col-md-10 pull-left" >
			      <input type="text" class="form-control" id="textfield" onkeyup="getdata(this.value,document.getElementById('orderFilter').value)" placeholder="Пребарај...">
			      <span class="input-group-btn">
			        <button class="btn btn-default" onclick="getdata(document.getElementById('textfield').value,document.getElementById('orderFilter').value);" type="submit" name="sending"><span class="glyphicon glyphicon-search"></span></button>
			      </span>
			     </div>
			     <div class="col-md-2 pull-right">
			     	
					<!-- Single button -->
				<div class="btn-group">
				<form>
				<select id="orderFilter" name="orderIdeas" onchange="orderBy(this.value,document.getElementById('textfield').value)" class="form-control">
				  <option value="0" selected style='display:none;'>Подреди според</option>
				  <option value="1">Рејтинг</option>
				  <option value="2">Датум</option>
				 
				 
				  
				  </select>
				</form>
			     </div>
			     </div>
			     </div>
			     </div>
			    <br />
                <div class="row col-md-12" id="result_para"><br /> 
                    <?php
                    
					$query=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit 6");
					
					while ($row=mysqli_fetch_assoc($query)){
						?>
						<div class="col-md-4 col-sm-6" style="height: 30%">
                        <div class="center"> 
                           <a href="userProfile.php?id=<?php echo $row['UserID'] ?>" ><img src="<?php echo $row['Image'] ?>" class="icon-lg"></a>
                            <a href="ideaDetails.php?ideaId=<?php echo $row['IdeaID'] ?>" style="color:black !important;"><h4><?php echo $row['Title'] ?></h4>
                            <p><?php 
                            $str = wordwrap($row['Description'], 80);
							$str = explode("\n", $str);
							$str = $str[0] . ' ...';
                            echo $str; ?>
                            </p>
                            </a>
                        </div>
                    </div>
					<?php } ?>
					
                    
                  
                   
                </div><!--/.row-->
                <input type="hidden" id="result_no" value="6">
               <br />
            </div><!--/.box-->
           
            
           
        
         
        </div><!--/.container--><br /><br />
         <!--button More -->
         <div class="center">
         	  <input type="button" id="load" class="btn btn-primary" style="width: 9%" value="Повеќе" onclick="loadmore()" />
         </div><br /><br />
       
    </section><!--/#services-->

  
    <section id="about-us">
        <div class="container">
            <div class="box"><br />
                <div class="center">
                    <span style="font-size:3em">За нас</span><br /><br />
                    <p class="lead">
                    <b>ИмамИдеја</b> е веб апликација наменета за сите оние коишто имаат идеја за софтверска апликација каква што сметаат дека недостига на пазарот или пак 
                    сакаат да учествуваат во остварување на нечија друга. <br /><br />
                 	За предложените идеи може да се дискутира, да се гласа и истите да се споделуваат.<br /><br />
                 	Корисниците кои се заинтересирани за остварување на нечија идеја аплицираат за истата и на тој начин се формира тим.
                    
                    
                   
                    </p>
                    
                    <img class="img-responsive" style="margin-left: 15%"  src="images/aboutImage.gif" width="70%" height="40%" />
                   
                </div>
                <div class="gap"></div>
               
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <section id="contact">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Контакт</h1>
                        
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Име">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Емаил">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="5" placeholder="Порака"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg">Испрати</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h1></h1>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                  
                                    Радика 1, Скопје<br>
                                    Р.Македонија<br>
                                    <abbr title="Phone">Тел:</abbr> (389) 78-555-666
                                </address>
                            </div>
                            <div class="col-md-6">
                                 <address>
                                  
                                    Илинденска бб, Скопје<br>
                                    Р.Македонија<br>
                                    <abbr title="Phone">Тел:</abbr> (389) 78-111-222
                                </address>
                            </div>
                        </div>
                        <h1>Поврзете се со нас</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="https://www.facebook.com/pages/%D0%98%D0%BC%D0%B0%D0%BC-%D0%B8%D0%B4%D0%B5%D1%98%D0%B0/963925187007843?fref=ts"><i class="icon-facebook icon-social"></i> Facebook</a></li>
                                    <li><a href="https://plus.google.com/u/0/113602250126364441762/posts"><i class="icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <li><a href="https://www.pinterest.com/imamideja/"><i class="icon-pinterest icon-social"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAIAABo_ZCgBfYu1leUzDADYL1S_JBU4yEhlkiY&trk=nav_responsive_tab_profile_pic"><i class="icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="https://twitter.com/ImamIdeja"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="https://www.youtube.com/channel/UCTfXMhzHHSdygRXRKj0madg"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->

 <?php include_once 'footer.php'; ?>

   
    
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
	  
	  
	  $(document).ready(function(){
	   	$("#aboutus").removeClass('active');
	   	$("#homeicon").addClass('active');
	   });
	  
    </script>
  
</body>
</html>