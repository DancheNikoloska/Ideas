<?php

include_once 'database.php';

  $no = $_POST['getresult'];
 $select=mysqli_query($link,"Select * from ideas i inner join users u on u.UserID=i.LeaderID order by i.Date desc limit $no,6");
					 
  while($row = mysqli_fetch_assoc($select))
        {
          	?>
						<div class="col-md-4 col-sm-6">
                        <div class="center"> 
                           <a href="userProfile.php?id=<?php echo $row['UserID'] ?>" ><img src="images/UserImg/<?php echo $row['Image'] ?>" class="icon-lg"></a>
                            <a href="ideaDetails.php?ideaId=<?php echo $row['IdeaID'] ?>" style="color:black !important;"><h4><?php echo $row['Title'] ?></h4>
                            <p><?php 
                            $str = wordwrap($row['Description'], 40);
							$str = explode("\n", $str);
							$str = $str[0] . ' ...';
                            echo $str; ?>
                            </p>
                            </a>
                        </div>
                    </div>
      <?php  }
      ?>