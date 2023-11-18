
      <?php
      
      $select_rows = mysqli_query($connect, "SELECT * FROM `bookmark`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>


      <div id="menu-btn" class="fas fa-bars"></div>



